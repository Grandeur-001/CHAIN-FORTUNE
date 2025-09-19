<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

require 'connection.php';
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']); 

function sendResponse($status, $message, $redirect = null) {
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'redirect' => $redirect
    ]);
    exit;
}

function generateInvestmentId() {
    return 'IN_' . strtoupper(bin2hex(random_bytes(16)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_SESSION['pending_investment'])){
        sendResponse('error', 'Investment info expired!');
        die();
    }

    $user_id = $_POST['user_id'] ?? '';
    $plan_id = $_POST['plan_id'] ?? '';
    $plan_name = $_POST['plan_name'] ?? '';
    $investment_amount = $_POST['investment_amount'] ?? '';
    $roi = $_POST['roi'] ?? '';
    $crypto_symbol = $_POST['crypto_symbol'] ?? '';

    if (!$user_id || !$plan_id || !$plan_name || !$investment_amount || !$roi || !$crypto_symbol) {
        sendResponse('error', 'All fields are required.');
    }

    if (!is_numeric($investment_amount) || $investment_amount <= 0) {
        sendResponse('error', 'Invalid investment amount.');
    }

    $stmt = $conn->prepare("
        SELECT uw.amount, c.crypto_name 
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ? AND c.crypto_symbol = ?
        LIMIT 1
    ");
    $stmt->bind_param("ss", $user_id, $crypto_symbol);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', "Wallet not found for {$crypto_symbol}");
    }

    $wallet = $result->fetch_assoc();
    $user_balance = $wallet['amount'];
    $crypto_name = $wallet['crypto_name'];

    if ($user_balance < $investment_amount) {
        $formattedAmount = number_format($investment_amount, 2);
        $formattedBalance = number_format($user_balance, 2);
        sendResponse('error', "Insufficient balance in {$crypto_symbol} wallet. You are trying to invest {$formattedAmount} USD, but your current balance is {$formattedBalance} USD.");
    }

    $update = $conn->prepare("
        UPDATE users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        SET uw.amount = uw.amount - ?
        WHERE uw.user_id = ? AND c.crypto_symbol = ?
    ");
    $update->bind_param("dss", $investment_amount, $user_id, $crypto_symbol);

    if (!$update->execute()) {
        sendResponse('error', 'Failed to deduct funds from your wallet. Please try again.');
    }

    $investment_id = generateInvestmentId();
    $status = 'pending';
    $zero_profit = 0.00;

    $insert = $conn->prepare("
        INSERT INTO investments (
            user_id, investment_id, plan_id, plan_name, crypto_symbol,
            amount_invested, roi, status, total_profit, started_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $insert->bind_param(
        "ssissdssd",
        $user_id,
        $investment_id,
        $plan_id,
        $plan_name,
        $crypto_symbol,
        $investment_amount,
        $roi,
        $status,
        $zero_profit
    );

    if ($insert->execute()) {
        $data = [
            'investment_id' => $investment_id,
            'user_id' => $user_id
        ];
        
        $json_data = json_encode($data);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/process_investment');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        $response_data = json_decode($response, true);
    
        if ($http_code === 200 && $response_data['status'] === 'success') {
            $admin_id = $adminUserId;
            $user_name_stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE user_id = ? LIMIT 1");
            $user_name_stmt->bind_param("s", $user_id);
            $user_name_stmt->execute();
            $user_name_result = $user_name_stmt->get_result();

            $full_name = "Unknown User";
            if ($user_name_result && $user_name_result->num_rows > 0) {
                $user_info = $user_name_result->fetch_assoc();
                $full_name = $user_info['firstname'] . ' ' . $user_info['lastname'];
            }
            $user_name_stmt->close();

            $formattedAmount = number_format($investment_amount, 2);
            $notification_symbol = 'https://cdn-icons-png.flaticon.com/512/5858/5858744.png';
            $admin_notification_message = "$full_name made an investment of {$formattedAmount} USD in {$crypto_symbol} under the '{$plan_name}' plan with the investment ID '{$investment_id}'.";
            $admin_notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
            $admin_notification_stmt = mysqli_prepare($conn, $admin_notification_query);

            if ($admin_notification_stmt) {
                mysqli_stmt_bind_param($admin_notification_stmt, "sss", $admin_id, $admin_notification_message, $notification_symbol);
                mysqli_stmt_execute($admin_notification_stmt);
                mysqli_stmt_close($admin_notification_stmt);
            }else{

            }
            unset($_SESSION['pending_investment']);
            $user_role = $_SESSION['user_role'] ?? null;
            $redirect = ($_SESSION['user_id'] === $adminUserId && $_SESSION['user_role'] === 'admin') 
                ? '/chain-fortune/admin/all_investments' 
                : '/chain-fortune/all_investments';
            sendResponse('success', 'Investment started and automation kicked off!', $redirect);
            $_SESSION['RATE_APP'] = "CHAIN-FORTUNE";
        }else {
            $deleteStmt = $conn->prepare("DELETE FROM investments WHERE investment_id = ?");
            $deleteStmt->bind_param("s", $investment_id);
            
            if (!$deleteStmt->execute()) {
                error_log("Database error: " . $deleteStmt->error);
                sendResponse('error', "Database error: " . $deleteStmt->error);
            }else{
                $deleteStmt->close();
                sendResponse('error', 'Error processing investment, please check your internet connection and try again!');
                return;
            }
        }
    }else {
        sendResponse('error', 'Database error: ' . $insert->error);
    }
}else{
    sendResponse('error', 'Invalid request method');
}



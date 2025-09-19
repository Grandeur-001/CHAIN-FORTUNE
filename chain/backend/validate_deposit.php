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

    function sendResponse($status, $message, $redirect = null) {
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'redirect' => $redirect
        ]);
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id        = $_POST['user_id'] ?? null;
        $amount         = $_POST['amount'] ?? null;
        $wallet_address = $_POST['wallet_address'] ?? null;
        $qr_code        = $_POST['qr_code'] ?? null;
        $crypto_symbol  = $_POST['crypto_symbol'] ?? null;
    
        if (!$user_id || !$amount || !$wallet_address || !$qr_code || !$crypto_symbol) {
            sendResponse('error', 'Missing required fields');
        }
    
    
        if (!ctype_digit($amount) || intval($amount) <= 0 || !is_numeric($amount)) {
            sendResponse('error', 'Enter a valid amount.');
        }
        if (floatval($amount) > 20000) {
            sendResponse('error', 'You cannot deposit more than ' .'$'.number_format(20000) . '.');
        }
    
        $query = "
            SELECT c.crypto_name AS name, c.crypto_symbol AS symbol, c.crypto_icon AS iconUrl, 
                c.wallet_address, c.qr_code, uw.amount AS user_wallet_balance
            FROM users_wallet uw
            JOIN currencies c ON uw.currency_id = c.id
            WHERE uw.user_id = ?
        ";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $valid = false;
        while ($row = $result->fetch_assoc()) {
            if (
                strtolower($row['symbol']) === strtolower($crypto_symbol) &&
                $row['wallet_address'] === $wallet_address &&
                $row['qr_code'] === $qr_code
            ) {
                $_SESSION['deposit_crypto_name'] = $row['name'];
                $_SESSION['deposit_crypto_symbol'] = $row['symbol'];
                $_SESSION['deposit_wallet_address'] = $wallet_address;
                $_SESSION['deposit_qr_code'] = $qr_code;
                $_SESSION['deposit_amount'] = $amount;
                $_SESSION['deposit_icon'] = $row['iconUrl'];
    
                $valid = true;
                break;
            }
        }
    
        if (!$valid) {
            sendResponse('error', 'Invalid cryptocurrency details');
        }
    
        $adminUserId = trim($_ENV['ADMIN_USER_ID']);

        $roleQuery = "SELECT role FROM users WHERE user_id = ?";
        $roleStmt = $conn->prepare($roleQuery);
        $roleStmt->bind_param("i", $user_id);
        $roleStmt->execute();
        $roleResult = $roleStmt->get_result();
        $userRole = null;
        
        if ($roleRow = $roleResult->fetch_assoc()) {
            $userRole = $roleRow['role'];
        } else {
            sendResponse('error', 'User not found');
        }
        
    
        $redirect = ($user_id == $adminUserId && $userRole  === 'admin')  
            ? '/chain-fortune/admin/deposit_details'  
            : '/chain-fortune/deposit_details';
    
        sendResponse('success', 'Deposit details processing...', $redirect);
    }else{
        sendResponse('error', 'Invalid request method');
    }

   
?>
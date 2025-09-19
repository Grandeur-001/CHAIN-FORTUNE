<?php
header('Content-Type: application/json');
include 'connection.php'; 
session_start();

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']); 


function sendResponse($status, $message, $redirect = null) {
    $response = ['status' => $status, 'message' => $message];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse('error', "UNAUTHORIZED!");
    }
    
    if (
        !isset($_POST['from_token'], $_POST['to_token'], $_POST['from_amount']) ||
        empty($_POST['from_token']) ||
        empty($_POST['to_token']) ||
        empty($_POST['from_amount'])
    ) {
        sendResponse('error', "All fields are required");
    }
    
    $fromToken = trim($_POST['from_token']);
    $toToken = trim($_POST['to_token']);
    $fromAmount = floatval($_POST['from_amount']);
    $userId = $_SESSION['user_id'] ?? null;
    
    if (!$userId) {
        sendResponse('error', "User not authenticated");
    }
    
    if ($fromToken === $toToken) {
        sendResponse('error', "Cannot swap the same token");
    }
    
    $query = "
        SELECT uw.amount, c.id AS currency_id
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = '$userId' AND c.crypto_symbol = '$fromToken'
    ";
    $result = mysqli_query($conn, $query);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        sendResponse('error', "From wallet not found");
    }
    
    $fromWallet = mysqli_fetch_assoc($result);
    
    $query = "
        SELECT uw.amount, c.id AS currency_id
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = '$userId' AND c.crypto_symbol = '$toToken'
    ";
    $result = mysqli_query($conn, $query);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        sendResponse('error', "To wallet not found");
    }
    
    $toWallet = mysqli_fetch_assoc($result);
    
    if ($fromWallet['amount'] < $fromAmount) {
        sendResponse('error', "Insufficient balance in your $fromToken wallet, your current $fromToken balance is " . number_format($fromWallet['amount'], 2) . " USD");
    }
    
    mysqli_begin_transaction($conn);
    
    $query = "
        UPDATE users_wallet 
        SET amount = amount - '$fromAmount' 
        WHERE user_id = '$userId' AND currency_id = '{$fromWallet['currency_id']}'
    ";
    if (!mysqli_query($conn, $query)) {
        mysqli_rollback($conn);
        sendResponse('error', "Failed to deduct from the FROM wallet");
    }
    
    $query = "
        UPDATE users_wallet 
        SET amount = amount + '$fromAmount' 
        WHERE user_id = '$userId' AND currency_id = '{$toWallet['currency_id']}'
    ";
    if (!mysqli_query($conn, $query)) {
        mysqli_rollback($conn);
        sendResponse('error', "Failed to add to the TO wallet");
    }
    mysqli_commit($conn);
    
    $user_role = $_SESSION['user_role'] ?? null;
    $redirect = ($_SESSION['user_id'] === $adminUserId && $_SESSION['user_role'] === 'admin') 
        ? '/chain-fortune/admin/dashboard' 
        : '/chain-fortune/dashboard';

    
    sendResponse('success', "Swap successful: $fromAmount Dollars from $fromToken → added to $toToken wallet", $redirect);
};

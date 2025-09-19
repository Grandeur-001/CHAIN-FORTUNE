<?php
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

    if (!is_numeric($amount) || floatval($amount) <= 0) {
        sendResponse('error', 'Enter a valid amount.');
    }

    if (floatval($amount) > 20000) {
        sendResponse('error', 'You cannot withdraw more than $' . number_format(20000) . '.');
    }

    // Query the user's wallet for this specific cryptocurrency
    $query = "
        SELECT c.crypto_name AS name, c.crypto_symbol AS symbol, c.crypto_icon AS iconUrl, 
               c.wallet_address, c.qr_code, uw.amount AS user_wallet_balance
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ? AND c.crypto_symbol = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $crypto_symbol);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'Invalid cryptocurrency details');
    }

    $walletData = $result->fetch_assoc();
    $userBalance = floatval($walletData['user_wallet_balance']);

    // Check if user has enough balance
    if (floatval($amount) > $userBalance) {
        sendResponse('error', "Insufficient funds in {$crypto_symbol} wallet.");
    }

    // Save data to session for later use
    $_SESSION['withdrawal_crypto_name']    = $walletData['name'];
    $_SESSION['withdrawal_crypto_symbol']  = $walletData['symbol'];
    $_SESSION['withdrawal_wallet_address'] = $wallet_address;
    $_SESSION['withdrawal_qr_code']        = $qr_code;
    $_SESSION['withdrawal_amount']         = $amount;
    $_SESSION['withdrawal_icon']           = $walletData['iconUrl'];

    // Determine user role
    $adminUserId = trim($_ENV['ADMIN_USER_ID']);
    $roleQuery = "SELECT role FROM users WHERE user_id = ?";
    $roleStmt = $conn->prepare($roleQuery);
    $roleStmt->bind_param("i", $user_id);
    $roleStmt->execute();
    $roleResult = $roleStmt->get_result();

    if ($roleRow = $roleResult->fetch_assoc()) {
        $userRole = $roleRow['role'];
    } else {
        sendResponse('error', 'User not found');
    }

    $redirect = ($user_id == $adminUserId && $userRole === 'admin')  
        ? '/chain-fortune/admin/withdrawal_details'  
        : '/chain-fortune/withdrawal_details';

    sendResponse('success', 'Withdrawal details processing...', $redirect);

} else {
    sendResponse('error', 'Invalid request method');
}
?>

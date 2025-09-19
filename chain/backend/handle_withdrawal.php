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
    $userId = trim($_POST['user_id'] ?? '');
    $cryptoSymbol = strtoupper(trim($_POST['crypto_symbol'] ?? ''));
    $walletAddress = trim($_POST['wallet_address'] ?? '');
    $amount = trim($_POST['amount'] ?? '');

    if (empty($userId) || empty($cryptoSymbol) || empty($walletAddress) || empty($amount)) {
        sendResponse('error', 'All fields are required.');
    }

    if (!is_numeric($amount) || $amount <= 0) {
        sendResponse('error', 'Invalid withdrawal amount.');
    }

    // Begin transaction
    $conn->begin_transaction();

    $stmt = $conn->prepare("
        SELECT c.crypto_name, c.crypto_symbol, c.wallet_address, c.qr_code, uw.amount AS user_wallet_balance, uw.id AS wallet_id
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ? AND c.crypto_symbol = ?
        LIMIT 1
    ");
    $stmt->bind_param("ss", $userId, $cryptoSymbol);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $conn->rollback();
        sendResponse('error', 'Invalid user or cryptocurrency.');
    }

    $data = $result->fetch_assoc();

    if ($data['user_wallet_balance'] < $amount) {
        $conn->rollback();
        sendResponse('error', 'Insufficient wallet balance.');
    }

    $randomHash = bin2hex(random_bytes(16));
    $transactionId = 'WD_' . $randomHash;

    $minerPreference = 'Medium';
    $status = 'Pending';
    $transactionType = 'Debit';

    $insert = $conn->prepare("
        INSERT INTO withdrawal_transactions (
            user_id, transaction_id, wallet_address, crypto_symbol, amount, 
            miner_preference, status, transaction_type
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insert->bind_param(
        "ssssdsss",
        $userId,
        $transactionId,
        $walletAddress,
        $cryptoSymbol,
        $amount,
        $minerPreference,
        $status,
        $transactionType
    );

    if (!$insert->execute()) {
        $conn->rollback();
        sendResponse('error', 'Failed to log withdrawal. Please try again.');
    }

    // Subtract balance
    // $updateWallet = $conn->prepare("
    //     UPDATE users_wallet SET amount = amount - ? 
    //     WHERE user_id = ? AND currency_id = (
    //         SELECT id FROM currencies WHERE crypto_symbol = ? LIMIT 1
    //     )
    // ");
    // $updateWallet->bind_param("dss", $amount, $userId, $cryptoSymbol);

    // if (!$updateWallet->execute()) {
    //     $conn->rollback();
    //     sendResponse('error', 'Failed to update wallet balance.');
    // }

    // Get role and redirect
    $adminUserId = trim($_ENV['ADMIN_USER_ID']);
    $roleStmt = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
    $roleStmt->bind_param("i", $userId);
    $roleStmt->execute();
    $roleResult = $roleStmt->get_result();
    $userRole = $roleResult->fetch_assoc()['role'] ?? null;

    if (!$userRole) {
        $conn->rollback();
        sendResponse('error', 'User not found.');
    }

    $redirect = ($userId == $adminUserId && $userRole === 'admin')  
        ? '/chain-fortune/admin/dashboard'  
        : '/chain-fortune/dashboard';

    // Insert notification
    $notification_message = "Withdrawal of \$" . number_format($amount, 0) ." from $cryptoSymbol is pending approval. Transaction ID: $transactionId.";
    $notification_symbol = "https://cdn-icons-png.flaticon.com/512/10135/10135469.png";

    $notifStmt = $conn->prepare("INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)");
    $notifStmt->bind_param("iss", $userId, $notification_message, $notification_symbol);
    $notifStmt->execute();
    $notifStmt->close();

    // Clear withdrawal session data
    unset(
        $_SESSION['withdrawal_crypto_name'],
        $_SESSION['withdrawal_crypto_symbol'],
        $_SESSION['withdrawal_wallet_address'],
        $_SESSION['withdrawal_amount'],
        $_SESSION['withdrawal_icon']
    );

    $conn->commit();
    sendResponse('success', 'Withdrawal pending, please wait for admin approval.', $redirect);

} else {
    sendResponse('error', 'Invalid request method.');
}
?>

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
    $user_id = trim($_POST['user_id'] ?? '');
    $transaction_id = trim($_POST['transaction_id'] ?? '');

    if (empty($user_id) || empty($transaction_id)) {
        sendResponse('error', 'Missing user or transaction ID.');
    }

    $user_stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
    $user_stmt->bind_param("s", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();

    if ($user_result->num_rows === 0) {
        sendResponse('error', 'User does not exist.');
    }

    $txn_stmt = $conn->prepare("SELECT transaction_id FROM deposit_transactions WHERE transaction_id = ? AND user_id = ?");
    $txn_stmt->bind_param("ss", $transaction_id, $user_id);
    $txn_stmt->execute();
    $txn_result = $txn_stmt->get_result();

    if ($txn_result->num_rows === 0) {
        sendResponse('error', 'Transaction not found for this user.');
    }

    $del_stmt = $conn->prepare("DELETE FROM deposit_transactions WHERE transaction_id = ? AND user_id = ?");
    $del_stmt->bind_param("ss", $transaction_id, $user_id);

    if ($del_stmt->execute()) {
        sendResponse('success', 'Transaction successfully deleted.', '/chain-fortune/admin/deposit_transactions');
    } else {
        sendResponse('error', 'Failed to delete transaction. Please try again.');
    }
}else{
    sendResponse('error', 'Invalid request method.');
}

?>
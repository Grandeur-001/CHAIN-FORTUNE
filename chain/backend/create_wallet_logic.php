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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$crypto_id      = trim($_POST['crypto_id'] ?? '');
$crypto_name    = trim($_POST['crypto_name'] ?? '');
$crypto_symbol  = strtoupper(trim($_POST['crypto_symbol'] ?? ''));
$crypto_icon    = trim($_POST['crypto_icon'] ?? '');

if (!$crypto_id || !$crypto_name || !$crypto_symbol || !$crypto_icon) {
    sendResponse('error', 'All fields are required.');
}

$checkQuery = "SELECT id FROM currencies WHERE crypto_symbol = ? OR crypto_id = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->bind_param("ss", $crypto_symbol, $crypto_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
if ($checkResult->num_rows > 0) {
    sendResponse('error', 'This cryptocurrency already exists (symbol or ID conflict).');
}

$wallet_address = "No address available yet";
$qr_code = "https://thumbs.dreamstime.com/b/qr-code-not-available-icon-quick-responce-matrix-barcode-red-forbidden-sign-isolated-white-background-entry-login-267388812.jpg";

$insertQuery = "
    INSERT INTO currencies (crypto_name, crypto_symbol, crypto_icon, wallet_address, qr_code, crypto_id)
    VALUES (?, ?, ?, ?, ?, ?)
";
$insertStmt = $conn->prepare($insertQuery);
$insertStmt->bind_param("ssssss", $crypto_name, $crypto_symbol, $crypto_icon, $wallet_address, $qr_code, $crypto_id);

if (!$insertStmt->execute()) {
    sendResponse('error', 'Failed to add new currency.');
}

$newCurrencyId = $insertStmt->insert_id;

$userQuery = "SELECT user_id FROM users";
$userResult = $conn->query($userQuery);
if ($userResult->num_rows > 0) {
    $walletInsert = $conn->prepare("INSERT INTO users_wallet (user_id, currency_id, amount) VALUES (?, ?, 0.00000000)");
    while ($user = $userResult->fetch_assoc()) {
        $walletInsert->bind_param("ii", $user['user_id'], $newCurrencyId);
        $walletInsert->execute();
    }
}

sendResponse('success', "$crypto_name Wallet created and initialized for all users.", '/chain-fortune/admin/edit_wallet');
?>

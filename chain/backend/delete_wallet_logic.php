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

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendResponse('error', 'Invalid request method.');
    }

    $crypto_id     = trim($_POST['crypto_id'] ?? '');
    $crypto_symbol = strtoupper(trim($_POST['crypto_symbol'] ?? ''));
    $crypto_name   = trim($_POST['crypto_name'] ?? '');
    $admin_password = $_POST['admin_password'] ?? '';

    if (!$crypto_id || !$crypto_symbol || !$admin_password) {
        sendResponse('error', 'All fields are required including admin password.');
    }

    $adminQuery = "SELECT password FROM users WHERE user_id = ?";
    $adminStmt = $conn->prepare($adminQuery);
    $adminStmt->bind_param("i", $adminUserId);
    $adminStmt->execute();
    $adminResult = $adminStmt->get_result();

    if ($adminResult->num_rows === 0) {
        sendResponse('error', 'Admin credentials not found.');
    }

    $adminData = $adminResult->fetch_assoc();
    $hashedPassword = $adminData['password'];

    if (!password_verify($admin_password, $hashedPassword)) {
        sendResponse('error', 'Invalid admin password.');
    }

    $checkQuery = "SELECT id FROM currencies WHERE crypto_id = ? AND crypto_symbol = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $crypto_id, $crypto_symbol);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows === 0) {
        sendResponse('error', 'This cryptocurrency does not exist.');
    }

    $row = $checkResult->fetch_assoc();
    $currencyId = $row['id'];

    $deleteWalletQuery = "DELETE FROM users_wallet WHERE currency_id = ?";
    $deleteWalletStmt = $conn->prepare($deleteWalletQuery);
    $deleteWalletStmt->bind_param("i", $currencyId);
    $deleteWalletStmt->execute();

    $deleteCurrencyQuery = "DELETE FROM currencies WHERE id = ?";
    $deleteCurrencyStmt = $conn->prepare($deleteCurrencyQuery);
    $deleteCurrencyStmt->bind_param("i", $currencyId);

    if (!$deleteCurrencyStmt->execute()) {
        sendResponse('error', 'Failed to delete the cryptocurrency.');
    }

    sendResponse('success', "$crypto_name ($crypto_symbol) has been successfully deleted.", '/chain-fortune/admin/edit_wallet');
?>

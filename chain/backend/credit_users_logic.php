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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id        = $_POST['user_id'] ?? null;
    $amount         = $_POST['amount'] ?? null;
    $crypto_symbol  = $_POST['crypto_symbol'] ?? null;

    if (!$user_id || !$amount || !$crypto_symbol) {
        sendResponse('error', 'Missing required fields');
    }

    if ($user_id !== $adminUserId) {
        sendResponse('error', 'Unauthorized action');
    }

    if (!is_numeric($amount) || floatval($amount) <= 0) {
        sendResponse('error', 'Enter a valid amount.');
    }
    $amount = floatval($amount);

    // Step 1: Confirm crypto exists
    $checkQuery = "SELECT id FROM currencies WHERE crypto_symbol = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $crypto_symbol);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows <= 0) {
        sendResponse('error', 'Cryptocurrency not found!');
    }

    $currencyData = $checkResult->fetch_assoc();
    $currencyId = $currencyData['id'];

    // Step 2: Get admin's balance for that crypto
    $adminWalletQuery = "SELECT amount FROM users_wallet WHERE user_id = ? AND currency_id = ?";
    $adminWalletStmt = $conn->prepare($adminWalletQuery);
    $adminWalletStmt->bind_param("ii", $adminUserId, $currencyId);
    $adminWalletStmt->execute();
    $adminWalletResult = $adminWalletStmt->get_result();

    if ($adminWalletResult->num_rows <= 0) {
        sendResponse('error', 'Admin wallet not found!');
    }

    $adminWallet = $adminWalletResult->fetch_assoc();
    $adminBalance = floatval($adminWallet['amount']);

    if ($adminBalance < $amount) {
        sendResponse('error', "Insufficient balance. Your current $crypto_symbol balance is " . number_format($adminBalance, 0) . " USD.");
    }
    // Step 3: Count all users (excluding admin)
    $countUsersQuery = "SELECT COUNT(*) AS total FROM users WHERE user_id != ?";
    $countStmt = $conn->prepare($countUsersQuery);
    $countStmt->bind_param("i", $adminUserId);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $userCount = $countResult->fetch_assoc()['total'];

    // Step 2.6: Check if admin has enough to credit ALL users
    $totalRequired = $amount * $userCount;

    if ($adminBalance < $totalRequired) {
        $extraNeeded = $totalRequired - $adminBalance;
        $adminBalanceFormatted = number_format($adminBalance, 0);
        $extraNeededFormatted = number_format($extraNeeded, 0);
        sendResponse('error', "Insufficient Balance! You will need an extra sum of $extraNeededFormatted USD in $crypto_symbol to continue. Your current $crypto_symbol balance is $adminBalanceFormatted USD.");
    }

    // Step 4: Deduct total from admin wallet
    $newAdminBalance = $adminBalance - $totalRequired;
    $updateAdminQuery = "UPDATE users_wallet SET amount = ? WHERE user_id = ? AND currency_id = ?";
    $updateAdminStmt = $conn->prepare($updateAdminQuery);
    $updateAdminStmt->bind_param("dii", $newAdminBalance, $adminUserId, $currencyId);
    if (!$updateAdminStmt->execute()) {
        sendResponse('error', 'Failed to update admin balance.');
    }

    // Step 5: Credit each user
    $getUsersQuery = "SELECT user_id FROM users WHERE user_id != ?";
    $getUsersStmt = $conn->prepare($getUsersQuery);
    $getUsersStmt->bind_param("i", $adminUserId);
    $getUsersStmt->execute();
    $usersResult = $getUsersStmt->get_result();

    $creditQuery = "UPDATE users_wallet SET amount = amount + ? WHERE user_id = ? AND currency_id = ?";
    $creditStmt = $conn->prepare($creditQuery);

    while ($row = $usersResult->fetch_assoc()) {
        $targetUserId = $row['user_id'];

        if ($targetUserId === $adminUserId) {
            continue;
        } 

        // Optional: Ensure wallet exists for user
        $checkWalletQuery = "SELECT amount FROM users_wallet WHERE user_id = ? AND currency_id = ?";
        $checkWalletStmt = $conn->prepare($checkWalletQuery);
        $checkWalletStmt->bind_param("ii", $targetUserId, $currencyId);
        $checkWalletStmt->execute();
        $checkWalletResult = $checkWalletStmt->get_result();

        if ($checkWalletResult->num_rows > 0) {
            $creditStmt->bind_param("dii", $amount, $targetUserId, $currencyId);
            $creditStmt->execute();

            // Step 6: Notify the user
            $notification_message = "Your $crypto_symbol Wallet has been credited with $" . number_format($amount, 0) . ", your new $crypto_symbol balance is updated.";
            $notification_symbol = "https://cdn-icons-png.flaticon.com/512/4957/4957559.png";

            $insert_notification = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insert_notification);
            if ($insertStmt) {
                $insertStmt->bind_param("iss", $targetUserId, $notification_message, $notification_symbol);
                $insertStmt->execute();
            } else {
                error_log("Notification insert prepare failed: " . $conn->error);
            }
        }
    }

    // Step 7: Notify admin
    $admin_id = $adminUserId;
    $message = "Successfully credited $amount USD in $crypto_symbol to all users. Total deducted from admin wallet: $totalRequired USD. Your new $crypto_symbol balance is $newAdminBalance USD.";
    $icon = "https://sbma.comitatensian.com/assets/OTP.b3204a71.png";

    $stmt = $conn->prepare("INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)");
    if (!$stmt) {
        error_log("Notification insert prepare failed: " . $conn->error);
        sendResponse('error', 'Internal error');
    }
    $stmt->bind_param("iss", $admin_id, $message, $icon);
    if (!$stmt->execute()) {
        error_log("Notification insert failed: " . $stmt->error);
        sendResponse('error', 'Internal error');
    }
    $stmt->close();

    sendResponse('success', "Successfully credited $amount USD in $crypto_symbol to all users.");
} else {
    sendResponse('error', 'Invalid request method.');
}
?>

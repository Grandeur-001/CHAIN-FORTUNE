<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
include 'connection.php'; 
header('Content-Type: application/json');

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendResponse($status, $message, $redirect = null) {
    $response = ['status' => $status, 'message' => $message];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    echo json_encode($response); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['user_id'] ?? '');

    if (!$user_id) {
        sendResponse('error', 'User ID is required.');
    }

    $update = $conn->prepare("UPDATE kyc_requests SET status = 'Approved', reviewed_at = NOW() WHERE user_id = ?");
    $update->bind_param("s", $user_id);
    if (!$update->execute()) {
        sendResponse('error', 'Failed to update KYC status.');
    }
    $update->close();

    $stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name);
    if ($stmt->fetch()) {
        $stmt->close();

        $insert = $conn->prepare("INSERT INTO verified_kyc (user_id, first_name, last_name) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $user_id, $first_name, $last_name);
        if ($insert->execute()) {
            $notification_message = "Your KYC request has been approved. You are now fully verified.";
            $notification_symbol = "https://as1.ftcdn.net/v2/jpg/05/71/77/92/1000_F_571779207_0MLLNRS082iZoVVUh8OC93Xoqrz6F4xB.jpg";
            $notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
            $notification_stmt = mysqli_prepare($conn, $notification_query);

            if ($notification_stmt) {
                mysqli_stmt_bind_param($notification_stmt, "iss", $user_id, $notification_message, $notification_symbol);
                mysqli_stmt_execute($notification_stmt);
                mysqli_stmt_close($notification_stmt);
            }
            sendResponse('success', 'KYC approved and user verified.');
        } else {
            sendResponse('error', 'KYC approved but failed to log verification.');
        }
        $insert->close();
    } else {
        sendResponse('error', 'User not found.');
    }
} else {
    sendResponse('error', 'Invalid request method.');
}

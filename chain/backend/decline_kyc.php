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
    $reason = trim($_POST['reason'] ?? '');

    if (empty($user_id) || empty($reason)) {
        sendResponse('error', 'Missing user ID or reason for rejection.');
    }

    if (!preg_match('/^\d+$/', $user_id)) {
        sendResponse('error', 'Invalid user ID.');
    }

    $stmt = $conn->prepare("SELECT * FROM kyc_requests WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        sendResponse('error', 'KYC request not found.');
    }

    $update = $conn->prepare("UPDATE kyc_requests SET status = 'Rejected', rejection_reason = ? WHERE user_id = ?");
    $update->bind_param("si", $reason, $user_id);
    
    if ($update->execute()) {

        $notification_message = "Your KYC request has been declined. Reason: " . htmlspecialchars($reason);
        $notification_symbol = "https://static.vecteezy.com/system/resources/previews/000/495/612/original/vector-cancel-icon-design.jpg";
        $notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
        $notification_stmt = mysqli_prepare($conn, $notification_query);

        if ($notification_stmt) {
            mysqli_stmt_bind_param($notification_stmt, "iss", $user_id, $notification_message, $notification_symbol);
            mysqli_stmt_execute($notification_stmt);
            mysqli_stmt_close($notification_stmt);
        }
        sendResponse('success', 'KYC request has been declined successfully.');
    } else {
        sendResponse('error', 'Failed to update KYC status.');
    }
} else {
    sendResponse('error', 'Invalid request method.');
}

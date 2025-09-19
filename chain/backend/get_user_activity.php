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
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['user_id']) || !isset($data['message'])) {
        sendResponse('error', 'Missing user_id or message');
    }

    $user_id = intval($data['user_id']);
    $activityMessage = trim($data['message']);

    if (!$user_id || !$activityMessage) {
        sendResponse('error', 'Invalid user_id or message');
    }

    // Validate user
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $validUser = $result->fetch_assoc();
    $stmt->close();

    if (!$validUser) {
        sendResponse('error', 'Invalid user');
    }

    // Insert notification for admin
    $admin_id = intval($adminUserId);
    $message = $activityMessage . " from user ID: " . $user_id;
    $icon = "https://cdn-icons-png.flaticon.com/512/8654/8654246.png";

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

    $postData = [
        'message' => $message,
        'user_id' => $user_id
    ];

    $ch = curl_init("http://localhost/chain-fortune/action/activity_email_sender");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);

    if (isset($json['status']) && $json['status'] === 'success') {
        sendResponse('success', $response);
    } else {
        sendResponse('error', 'Activity logged, but email dispatch failed.');
    }
}else{
    sendResponse('error', 'Invalid request method!');
}
 
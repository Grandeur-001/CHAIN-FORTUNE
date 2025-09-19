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
    $user_id = trim($_POST['user_id'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($user_id) || empty($email)) {
        sendResponse('error', 'User ID and Email are required.');
    }

    $stmt = $conn->prepare("SELECT firstname, lastname, ip_address, country FROM users WHERE user_id = ? AND email = ?");
    $stmt->bind_param("ss", $user_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'User not found.');
    }

    $user = $result->fetch_assoc();
    $ip_address = $user['ip_address'];
    $country = $user['country'] ?? 'Unknown';

    if (empty($ip_address)) {
        sendResponse('error', 'User IP address not found.');
    }

    $reason = "Blacklisted by CHAIN FORTUNE";
    $is_permanent = 1;

    $insert = $conn->prepare("INSERT INTO blocked_ip (ip_address, reason, country, is_permanent) VALUES (?, ?, ?, ?)");
    $insert->bind_param("sssi", $ip_address, $reason, $country, $is_permanent);

    if ($insert->execute()) {
        sendResponse('success', "You blacklisted {$user['firstname']} {$user['lastname']}.");
    } else {
        sendResponse('error', 'Failed to blacklist IP.');
    }
} else {
    sendResponse('error', 'Invalid request method.');
}

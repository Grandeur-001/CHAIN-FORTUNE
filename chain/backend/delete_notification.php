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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

if (!isset($_SESSION['user_id'])) {
    sendResponse('error', 'User not authenticated.');
}

$user_id = $_SESSION['user_id'];

if (!isset($_POST['notification_id']) || !is_numeric($_POST['notification_id'])) {
    sendResponse('error', 'Invalid notification ID.');
}

$notification_id = (int) $_POST['notification_id'];

$query = "DELETE FROM notifications WHERE notification_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    sendResponse('error', 'Database error: ' . $conn->error);
}

$stmt->bind_param("is", $notification_id, $user_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    sendResponse('success', 'Notification deleted successfully.', '/chain-fortune/dashboard');
} else {
    sendResponse('error', 'Notification not found or already deleted.');
}

$stmt->close();
$conn->close();

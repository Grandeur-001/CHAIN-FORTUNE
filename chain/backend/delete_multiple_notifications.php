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
    if (!isset($_SESSION['user_id'])) {
        sendResponse('error', 'User not logged in.');
    }

    if (!isset($_POST['notification_ids']) || !is_array($_POST['notification_ids'])) {
        sendResponse('error', 'Invalid notification data.');
    }

    $user_id = $_SESSION['user_id'];
    $notification_ids = array_filter($_POST['notification_ids'], function ($id) {
        return is_numeric($id);
    });

    if (count($notification_ids) === 0) {
        sendResponse('error', 'No valid notifications selected.');
    }

    // Prepare SQL placeholders
    $placeholders = implode(',', array_fill(0, count($notification_ids), '?'));

    // Build the query
    $query = "DELETE FROM notifications WHERE notification_id IN ($placeholders) AND user_id = ?";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        sendResponse('error', 'Database error: ' . $conn->error);
    }

    // Merge the notification_ids with user_id
    $types = str_repeat('i', count($notification_ids)) . 'i';
    $params = array_merge($notification_ids, [$user_id]);

    // Bind parameters dynamically
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $deletedCount = $stmt->affected_rows;
        sendResponse('success', "$deletedCount notification(s) deleted.");
    } else {
        sendResponse('error', 'Failed to delete notifications. Please try again.');
    }

    $stmt->close();
    $conn->close();
} else {
    sendResponse('error', 'Invalid request method.');
}

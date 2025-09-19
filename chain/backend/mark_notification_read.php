<?php
session_start();
require 'connection.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

if (!isset($_POST['notification_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing notification ID']);
    exit();
}

$user_id = $_SESSION['user_id'];
$notification_id = (int)$_POST['notification_id'];

$query = "UPDATE notifications SET is_read = 1 WHERE notification_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $notification_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Update failed']);
}

$stmt->close();
$conn->close();
?>
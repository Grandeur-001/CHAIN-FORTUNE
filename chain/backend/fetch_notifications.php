<?php
session_start();
require 'connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT notification_id, message, notification_symbol, created_at, is_read FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];

while ($row = $result->fetch_assoc()) {
    $notifications[] = [
        'notification_id' => (int)$row['notification_id'],
        'message' => htmlspecialchars($row['message']),
        'notification_symbol' => htmlspecialchars($row['notification_symbol']),
        'created_at' => htmlspecialchars($row['created_at']),
        'is_read' => (int)$row['is_read']
    ];
}

$stmt->close();
$conn->close();

echo json_encode(['status' => 'success', 'notifications' => $notifications]);
exit();
?>

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
        sendResponse('error', 'Unauthorized access.');
    }

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM notifications WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        sendResponse('success', 'All notifications deleted successfully.');
    } else {
        sendResponse('error', 'Failed to delete notifications.');
    }
}
?>

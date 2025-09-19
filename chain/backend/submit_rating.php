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
    if (!isset($_SESSION['user_id'])) {
        sendResponse('error', 'User not authenticated.');
    }

    $user_id = $_SESSION['user_id'];
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;

    if ($rating === null || $rating < 1 || $rating > 5) {
        sendResponse('error', 'Invalid rating value.');
    }

    $stmt = $conn->prepare("SELECT id FROM ratings WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE ratings SET rating = ?, created_at = NOW() WHERE user_id = ?");
        $stmt->bind_param("is", $rating, $user_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO ratings (user_id, rating) VALUES (?, ?)");
        $stmt->bind_param("si", $user_id, $rating);
    }

    if ($stmt->execute()) {
        sendResponse('success', 'Your rating has been submitted!');
    } else {
        sendResponse('error', 'Failed to submit rating.');
    }
}else{
    sendResponse('error', 'Invalid request');
}
?>

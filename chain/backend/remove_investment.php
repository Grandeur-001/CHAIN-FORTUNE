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
    $input = json_decode(file_get_contents("php://input"), true);
    $user_id = $input['user_id'] ?? '';
    $investment_id = $input['investment_id'] ?? '';

    if (empty($user_id) || empty($investment_id)) {
        sendResponse('error', 'User ID and Investment ID are required for this action!');
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows === 0) {
        sendResponse('error', 'User not found.');
    }

    $stmt = $conn->prepare("SELECT investment_id FROM investments WHERE investment_id = ? AND user_id = ?");
    $stmt->bind_param("ss", $investment_id, $user_id);
    $stmt->execute();
    $investmentResult = $stmt->get_result();

    if ($investmentResult->num_rows === 0) {
        sendResponse('error', 'Investment not found for this user.');
    }

    $stmt = $conn->prepare("DELETE FROM investments WHERE investment_id = ?");
    $stmt->bind_param("s", $investment_id);

    if ($stmt->execute()) {
        sendResponse('success', 'Investment removed successfully.');
    } else {
        sendResponse('error', 'Failed to remove investment. Please try again later.');
    }

} else {
    sendResponse('error', 'Invalid request method. POST required.');
}

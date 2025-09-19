<?php
session_start();
header('Content-Type: application/json');

require 'connection.php';
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendResponse($status, $message, $data = null) {
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $investmentId = $_POST['investment_id'] ?? null;

    if (!$investmentId) {
        sendResponse('error', 'Investment ID is required.');
    }

    $investmentId = mysqli_real_escape_string($conn, $investmentId);
    $query = "SELECT change_value FROM investments WHERE investment_id = '$investmentId' AND status = 'Active' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $changeValue = (float) $data['change_value'];
        $formatted = ($changeValue >= 0 ? '+' : '') . number_format($changeValue, 2) . '%';
        sendResponse('success', 'Change value fetched.', ['change_value' => $formatted]);
    } else {
        sendResponse('error', 'Investment not active or not found.');
    }
}

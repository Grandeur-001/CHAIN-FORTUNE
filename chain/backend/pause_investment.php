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
    $investment_id = $input['investment_id'] ?? '';

    if (empty($investment_id)) {
        sendResponse('error', 'Investment ID is required.');
    }

    if (!$investment_id) {
        sendResponse('error', 'Investment ID is required.');
    }

    $stmt = $conn->prepare("SELECT user_id FROM investments WHERE investment_id = ? AND status = 'active' LIMIT 1");
    $stmt->bind_param("s", $investment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'No active investment found with this ID.');
    }

    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    $data = [
        'investment_id' => $investment_id
    ];

    $json_data = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/pause_investment');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $response_data = json_decode($response, true);

    if ($http_code === 200 && $response_data['status'] === 'success') {
        sendResponse('success', $response_data['message']);
    } else {
        $error = $response_data['message'] ?? 'Failed to pause investment. Please try again later.';
        sendResponse('error', $error);
    }
    

}else{
    sendResponse('error', 'Invalid request method.');
}

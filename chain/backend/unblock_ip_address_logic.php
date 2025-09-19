<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    header('Content-Type: application/json');

    require 'connection.php';
    require_once __DIR__ . '/vendor/autoload.php'; 

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
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
        $ip_address = trim($_POST['ip_address'] ?? '');

        if (empty($ip_address)) {
            sendResponse('error', 'IP address is required.');
        }

        $check = $conn->prepare("SELECT id, is_permanent FROM blocked_ip WHERE ip_address = ?");
        $check->bind_param("s", $ip_address);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows === 0) {
            sendResponse('error', 'This IP is not currently blocked.');
        }

        $ip_data = $result->fetch_assoc();

        if ((int)$ip_data['is_permanent'] === 1) {
            sendResponse('error', 'OOPS! The IP is permanently blocked');
        }

        $delete = $conn->prepare("DELETE FROM blocked_ip WHERE ip_address = ?");
        $delete->bind_param("s", $ip_address);

        if ($delete->execute()) {
            sendResponse('success', "IP address $ip_address has been unblocked successfully.", '/chain-fortune/admin/blocked_IPs');
        } else {
            sendResponse('error', 'Failed to unblock the IP address.');
        }

    } else {
        sendResponse('error', 'Invalid request method.');
    }
?>
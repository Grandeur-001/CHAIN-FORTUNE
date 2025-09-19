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

    function getCountryFromIP($ip) {
        $apiUrl = "http://ip-api.com/json/" . urlencode($ip);
        $response = @file_get_contents($apiUrl);

        if ($response === false) return 'UNKNOWN';

        $data = json_decode($response, true);

        if (isset($data['status']) && $data['status'] === 'success' && isset($data['country'])) {
            return $data['country'];
        }

        return 'UNKNOWN';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ip_address = trim($_POST['ip_address'] ?? '');
        $block_type = trim($_POST['block_type'] ?? '');
        $reason = trim($_POST['reason'] ?? '');

        if ($ip_address === '' || $block_type === '' || $reason === '') {
            sendResponse('error', 'All fields are required.');
        }

        if (!in_array($block_type, ['0', '1'])) {
            sendResponse('error', 'Invalid block type.');
        }

        $is_permanent = (int) $block_type;

        $check = $conn->prepare("SELECT id FROM blocked_ip WHERE ip_address = ?");
        $check->bind_param("s", $ip_address);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            sendResponse('error', 'This IP is already blocked.');
        }

        $country = getCountryFromIP($ip_address);

        $insert = $conn->prepare("INSERT INTO blocked_ip (ip_address, country, reason, is_permanent) VALUES (?, ?, ?, ?)");
        $insert->bind_param("sssi", $ip_address, $country, $reason, $is_permanent);

        if ($insert->execute()) {
            $label = $is_permanent ? 'permanently' : 'temporarily';
            sendResponse('success', "The IP address '$ip_address' has been $label blocked successfully!");
        } else {
            sendResponse('error', 'Failed to block IP.');
        }
    } else {
        sendResponse('error', 'Invalid request method.');
    }

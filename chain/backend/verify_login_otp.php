<?php
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
    'cookie_samesite' => 'Strict'
]);

require 'connection.php';
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']); 
header('Content-Type: application/json');

function sendResponse($status, $message, $redirect = null) {
    $response = ['status' => $status, 'message' => $message];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = urldecode(trim($_POST['email']));
    $user_otp = trim($_POST['otp'] ?? '');

    if (!$email || !$user_otp) {
        sendResponse('error', 'Email and OTP required');
    }

    $stmt = $conn->prepare("SELECT code, created_at FROM verification_codes WHERE email = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($code, $created_at);

    if (!$stmt->fetch()) {
        $stmt->close();
        sendResponse('error', 'OTP not found or already expired.');
    }
    $stmt->close();

    $otp_expiry_time = strtotime($created_at) + (5 * 60);
    if (!$code || $user_otp !== $code || $otp_expiry_time < time()) {
        sendResponse('error', 'Invalid or expired OTP');
    }

    $stmt = $conn->prepare("SELECT user_id, firstname, lastname, email, role, session_token FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'User not found');
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    $user_id = $user['user_id'];

    $stmt = $conn->prepare("DELETE FROM verification_codes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();

    $sessionToken = bin2hex(random_bytes(32)); 
    $stmt = $conn->prepare("UPDATE users SET session_token = ? WHERE user_id = ?");
    $stmt->bind_param("ss", $sessionToken, $user_id);
    if (!$stmt->execute()) {
        sendResponse('error', 'Failed to store session token');
    }
    $stmt->close();


    function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; 
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    
    $user_ip = getUserIP();
    $user_ip = '105.116.0.224'; 
    
    $geoData = @file_get_contents("http://ip-api.com/json/{$user_ip}?fields=status,country,regionName,city,timezone");
    
    if ($geoData !== false) {
        $geo = json_decode($geoData, true);
    
        if ($geo && $geo['status'] === 'success') {
            $country = $geo['country'] ?? 'Not Detected';
            $region = $geo['regionName'] ?? 'Not Detected';
            $city = $geo['city'] ?? 'Not Detected';
            $timezone = $geo['timezone'] ?? 'Not Detected';
    
            $stmt = $conn->prepare("UPDATE users SET ip_address = ?, country = ?, region = ?, city = ?, timezone = ? WHERE user_id = ?");
            $stmt->bind_param("ssssss", $user_ip, $country, $region, $city, $timezone, $user_id);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    $_SESSION['session_token'] = $sessionToken;
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_firstname'] = $user['firstname'];
    $_SESSION['user_lastname'] = $user['lastname'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['last_activity'] = time();

    unset($_SESSION['pending_login_email']);

    $user_role = $_SESSION['user_role'] ?? null;
    $redirect = ($_SESSION['user_id'] === $adminUserId && $_SESSION['user_role'] === 'admin') 
        ? '/chain-fortune/admin/dashboard' 
        : '/chain-fortune/dashboard';

    sendResponse('success', 'Login successful! Redirecting...', '/chain-fortune/page/welcome');
} else {
    sendResponse('error', 'Invalid request method.');
}

?>

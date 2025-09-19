<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
session_start();

include "connection.php";
header('Content-Type: application/json');
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);


function sendResponse($status, $message, $redirect = null) {
    ob_clean();
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'redirect' => $redirect
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['user_id'] ?? null;
    if (!$user_id) {
        sendResponse('error', 'Unauthorized request.');
    }
    // Check if user is verified
    $kycCheck = $conn->prepare("SELECT user_id FROM verified_kyc WHERE user_id = ?");
    $kycCheck->bind_param("s", $user_id);
    $kycCheck->execute();
    $kycCheck->store_result();

    if ($kycCheck->num_rows === 0) {
        $user_role = $_SESSION['user_role'] ?? null;
        $redirect = ($_SESSION['user_id'] === $adminUserId && $_SESSION['user_role'] === 'admin') 
            ? '/chain-fortune/admin/dashboard' 
            : '/chain-fortune/dashboard';
        sendResponse('error', 'KYC not found, cannot proceed. Please verify KYC to continue.', $redirect);
    }
    $kycCheck->close();

    $emailQuery = $conn->prepare("SELECT email FROM users WHERE user_id = ?");
    $emailQuery->bind_param("s", $user_id);
    $emailQuery->execute();
    $emailResult = $emailQuery->get_result();

    if ($emailResult->num_rows === 0) {
        sendResponse('error', 'User email not found.');
    }

    $userData = $emailResult->fetch_assoc();
    $email = $userData['email'];
    $emailQuery->close();

    $emailCheck = $conn->prepare("SELECT email FROM verified_emails WHERE email = ?");
    $emailCheck->bind_param("s", $email);
    $emailCheck->execute();
    $emailCheck->store_result();

    if ($emailCheck->num_rows === 0) {
        session_unset();
        session_destroy();
        $redirect = '/chain-fortune/auth/login?error=unverified_email';
        sendResponse('error', 'Unverified email detected, cannot proceed with investment. Please verify your email.', $redirect);
    }
    $emailCheck->close();
    


    // Validate investment plan details
    $plan_id = trim($_POST['plan_id'] ?? '');
    $plan_name = trim($_POST['plan_name'] ?? '');
    $investment_amount = trim($_POST['amount'] ?? '');

    if (!$plan_id || !$plan_name || !$investment_amount) {
        sendResponse('error', 'Invalid request. All fields are required.');
    }

    if (!is_numeric($investment_amount) || $investment_amount <= 0) {
        sendResponse('error', 'Invalid investment amount.');
    }

    $stmt = $conn->prepare("SELECT * FROM investment_plans WHERE plan_id = ? AND plan_name = ?");
    $stmt->bind_param("is", $plan_id, $plan_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'Investment plan not found.');
    }


    $plan = $result->fetch_assoc();
    $min = $plan['minimum'];
    $max = $plan['maximum'];
    $investment_amount = floatval($investment_amount);
    
    if ($investment_amount < $min) {
        $formattedMin = number_format($min, 2) . ' USD';
        sendResponse('error', "Investment amount must be at least {$formattedMin}.");
    }
    
    if ($investment_amount > $max) {
        $formattedMax = number_format($max, 2) . ' USD';
        sendResponse('error', "Investment amount must not exceed {$formattedMax}.");
    }
    

    $_SESSION['pending_investment'] = [
        'plan_id'             => $plan['plan_id'],
        'plan_name'           => $plan['plan_name'],
        'percentage'          => $plan['percentage'],
        'minimum'             => $plan['minimum'],
        'maximum'             => $plan['maximum'],
        'duration'            => $plan['duration'],
        'duration_timeframe'  => $plan['duration_timeframe'],
        'roi'                 => $plan['roi'],
        'commission'          => $plan['commission'],
        'benefit'             => $plan['benefit'],
        'investment_amount'   => $investment_amount
    ];

    $user_role = $_SESSION['user_role'] ?? null;
    $redirect = ($_SESSION['user_id'] === $adminUserId && $_SESSION['user_role'] === 'admin') 
        ? '/chain-fortune/admin/investment_crypto' 
        : '/chain-fortune/investment_crypto';
    sendResponse('success', 'Investment plan validated. Proceed to choose wallet.', $redirect);
} else {
    sendResponse('error', 'Invalid request method.');
}

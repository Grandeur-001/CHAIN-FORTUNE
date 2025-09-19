<?php
session_start();
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

function createUserWalletsBatch($userId, $conn) {
    $currenciesQuery = "SELECT id FROM currencies";
    $currenciesResult = $conn->query($currenciesQuery);

    if ($currenciesResult->num_rows > 0) {
        $values = [];
        $params = [];

        while ($currency = $currenciesResult->fetch_assoc()) {
            $values[] = "(?, ?, 0)";
            $params[] = $userId;
            $params[] = $currency['id'];
        }

        $sql = "INSERT INTO users_wallet (user_id, currency_id, amount) VALUES " . implode(",", $values);

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $types = str_repeat("ii", count($params) / 2);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Batch insert failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
    } else {
        error_log("No currencies found in the database.");
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $user_otp = trim($_POST['otp']);

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
        sendResponse('error', 'Invalid or OTP expired');
    }

    $stmt = $conn->prepare("SELECT * FROM pending_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        sendResponse('error', 'User not found');
    }

    $stmt = $conn->prepare("INSERT INTO users (user_id, firstname, lastname, email, password, role, date, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "isssssss",
        $user['user_id'], $user['firstname'], $user['lastname'], $user['email'],
        $user['password'], $user['role'], $user['date'], $user['ip_address']
    );
  

    if ($stmt->execute()) {
        $stmt->close();
        createUserWalletsBatch($user['user_id'], $conn);
    
        $admin_id = $adminUserId;
        $message = "New user registered (verified): - " . $user['firstname'] . " - " . $user['user_id'];
        $icon = "https://icon-library.com/images/new-user-icon/new-user-icon-26.jpg";
    
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)");
        if (!$stmt) {
            error_log("Notification insert prepare failed: " . $conn->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->bind_param("iss", $admin_id, $message, $icon);
        if (!$stmt->execute()) {
            error_log("Notification insert failed: " . $stmt->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->close();
    
        $stmt = $conn->prepare("DELETE FROM pending_users WHERE email = ?");
        if (!$stmt) {
            error_log("Delete pending prepare failed: " . $conn->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            error_log("Delete pending failed: " . $stmt->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->close();
    
        $stmt = $conn->prepare("DELETE FROM verification_codes WHERE email = ?");
        if (!$stmt) {
            error_log("Delete verification prepare failed: " . $conn->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            error_log("Delete verification failed: " . $stmt->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->close();
    
        $stmt = $conn->prepare("INSERT INTO verified_emails (email) VALUES (?)");
        if (!$stmt) {
            error_log("Insert verified prepare failed: " . $conn->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            error_log("Insert verified failed: " . $stmt->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->close();
    
        unset($_SESSION['pending_signup_email']);
    
        $redirect = '/chain-fortune/auth/login';
        sendResponse('success', 'Account verified successfully. Please log in.', $redirect);
    } else {
        error_log("Main user insert failed: " . $stmt->error);
        $stmt->close();
        sendResponse('error', 'Failed to move user from pending to verified');
    }
}else{
    sendResponse('error', 'Invalid request method.');
    $stmt->close();
}

?>

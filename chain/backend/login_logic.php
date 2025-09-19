<?php
session_start();
include "connection.php";
include "bypass_login.php";



require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$adminUserId = trim($_ENV['ADMIN_USER_ID']);

$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['user_role'] ?? null;

$redirect = ($user_id === $adminUserId && $user_role === 'admin') 
    ? '/chain-fortune/admin/dashboard' 
    : '/chain-fortune/dashboard';

if (isset($_SESSION['user_id'])) {
    header("Location: $redirect");
    exit();
}

$GLOBALS['ERROR'] = '';

if (isset($_POST['signin_btn'])) {
    login();
}

function login()
{
    global $conn;
    global $adminUserId;

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$email || !$password) {
        $GLOBALS['ERROR'] = "All fields are required!";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $GLOBALS['ERROR'] = "Invalid email format.";
        return;
    }

    if(isset($_SESSION['pending_login_email'])) {
        unset($_SESSION['pending_login_email']);
    };;

    $checkDisabled = $conn->prepare("SELECT 1 FROM disabled_users WHERE email = ?");
    $checkDisabled->bind_param("s", $email);
    $checkDisabled->execute();
    $disabledResult = $checkDisabled->get_result();

    if ($disabledResult->num_rows > 0) {
        $GLOBALS['ERROR'] = "This account has been disabled. Please contact support.";
        return;
    };

    $stmt = $conn->prepare("SELECT user_id, password, failed_attempts FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $GLOBALS['ERROR'] = 'No user found with this email';
        return;
    };

    $fetch = $result->fetch_assoc();

    $storedPassword = $fetch['password'];
    $failed_attempts = $fetch['failed_attempts'];
    $user_id = $fetch['user_id'];

    if (!password_verify($password, $storedPassword)) {
        $stmt = $conn->prepare("UPDATE users SET failed_attempts = failed_attempts + 1, last_failed_attempt = NOW() WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT failed_attempts FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $attemptsResult = $stmt->get_result();
        $attempts = $attemptsResult->fetch_assoc()['failed_attempts'];

        if ($attempts >= 4) {
            $reason = "Too many failed login attempts";
            $disabled_by = $adminUserId;

            $insert = $conn->prepare("INSERT INTO disabled_users (user_id, email, reason, disabled_by) VALUES (?, ?, ?, ?)");
            $insert->bind_param("isss", $user_id, $email, $reason, $disabled_by);
            $insert->execute();

            $reset = $conn->prepare("UPDATE users SET failed_attempts = 0 WHERE email = ?");
            $reset->bind_param("s", $email);
            $reset->execute();
        };

        $GLOBALS['ERROR'] = 'Invalid email or password';
        return;
    };

    $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0 WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT 1 FROM verified_emails WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $GLOBALS['ERROR'] = 'Unknown email address. Please verify your email first.';
        return;
    };

    require_once 'otp_blocker.php'; 
    if (hasTooManyRecentOtps($email)) {
        $GLOBALS['ERROR'] = "You have reached the maximum OTP resend attempts. Please try again in 15 minutes.";
        unset($_SESSION['pending_login_email'], $_SESSION['pending_login_email_time']);
        return;
    };

    $ch = curl_init("http://localhost/chain-fortune/action/login_otp_sender"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['email' => $email]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);

    if (isset($json['status']) && $json['status'] === 'success') {
        $_SESSION['pending_login_email'] = $email;
        $_SESSION['pending_login_email_time'] = time(); 
        header("Location: /chain-fortune/auth/login_otp");
        exit();
    } else {
        $GLOBALS['ERROR'] = $json['message'] ?? 'OTP service failed.';
        return;
    }
}

?>

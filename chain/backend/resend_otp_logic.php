<?php 
    require 'connection.php';
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
        $email = trim($_POST['email']);
    
        if (!$email) {
            sendResponse('error', 'Email is required.');
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            sendResponse('error', 'No user found with this email.');
        }

        require_once 'otp_blocker.php'; 
        if (hasTooManyRecentOtps($email)) {
            $GLOBALS['ERROR'] = "You have reached the maximum OTP resend attempts. Please try again in 15 minutes.";
            unset($_SESSION['pending_login_email'], $_SESSION['pending_login_email_time']);
            return;
        }

        $ch = curl_init("http://localhost/chain-fortune/action/login_otp_sender");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['email' => $email]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response, true);

        if (isset($json['status']) && $json['status'] === 'success') {
            $redirect = '../auth/login_otp';
            sendResponse('success', 'New OTP resent successfully, please check your email inbox', $redirect);
        } else {
            sendResponse('error', 'OTP service failed.');
        }
    }
?>

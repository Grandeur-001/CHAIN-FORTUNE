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
    $adminUserId = trim($_ENV['ADMIN_USER_ID']); 

    function sendResponse($status, $message, $redirect = null) {
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'redirect' => $redirect
        ]);
        exit;
    }

    $user_id = $_SESSION['user_id'] ?? null;
    $user_role = $_SESSION['user_role'] ?? null;

    $redirect = ($user_id === $adminUserId && $user_role === 'admin') 
        ? '/chain-fortune/admin/dashboard' 
        : '/chain-fortune/dashboard';

    if (isset($_SESSION['user_id'])) {
        header("Location: $redirect");
        exit();
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        signup();
    }else{
        sendResponse('error', 'Invalid request method!');
    }

    function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; 
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    function signup() {
        global $conn;

        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $conf_pass = $_POST['confirm_password'];
        $checkbox_info = htmlspecialchars(trim($_POST['checkbox_info']));
        $ip_address = getUserIP(); 

        if (!$firstname || !$lastname || !$email || !$password || !$conf_pass) {
            sendResponse('error', 'Invalid request. All fields are required.');
            return;
        }

        if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
            sendResponse('error', 'Invalid request. All fields are required.');
            return;
        }
        if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
            sendResponse('error', 'First name can only contain letters.');
            return;

        }
        if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
            sendResponse('error', 'Last name can only contain letters.');
            return;
        }
        if (strlen($firstname) < 2 || strlen($lastname) < 2) {
            sendResponse('error', 'First name and last name must be at least 2 characters long.');
            return;
        }
    
        if (strlen($firstname) > 20 || strlen($lastname) > 20) {
            sendResponse('error', 'First name and last name must be at most 20 characters long.');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            sendResponse('error', 'Invalid email format.');
            return;
        }

        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            sendResponse('error', 'Email already in use!');
            return;
        }
        $stmt->close();

        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
            sendResponse('error', 'Password must be at least 8 characters long and contain at least one uppercase letter and one number.');
            return;
        }

        if ($conf_pass !== $password) {
            sendResponse('error', 'Passwords do not match!');
            return;
        }


        if ($checkbox_info !== 'AGREED') {
            sendResponse('error', 'You must agree to the terms and conditions!');
            return;
        }

        $options = ['cost' => 12];
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);
        do {
            $user_id = random_int(1000000000000000, 9999999999999999); 
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $stmt->store_result();
        } while ($stmt->num_rows > 0);
        $stmt->close();

        $role = 'user';
        $date = date('Y-m-d H:i:s');


        $deleteStmt = $conn->prepare("DELETE FROM pending_users WHERE email = ?");
        $deleteStmt->bind_param("s", $email);
        if (!$deleteStmt->execute()) {
            error_log("Database error: " . $deleteStmt->error);
            sendResponse('error', 'You must agree to the terms and conditions!');
        }
        $deleteStmt->close();




        $stmt = $conn->prepare("INSERT INTO pending_users 
        (user_id, firstname, lastname, email, password, role, date, ip_address) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $user_id, $firstname, $lastname, $email, $hashedPwd, $role, $date, $ip_address);
    
        if ($stmt->execute()) {
            $data = [
                'email' => $email,
                'user_id' => $user_id
            ];
            $ch = curl_init('http://localhost/chain-fortune/action/signup_otp_sender');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);
            
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if ($response === false) {
                sendResponse('error', 'cURL error: ' . curl_error($ch));
                curl_close($ch);
                return;
            }
            curl_close($ch);
            $responseData = json_decode($response, true);
            if ($httpcode === 200 && isset($responseData['status']) && $responseData['status'] === 'success') {
                $_SESSION['pending_signup_email'] = $email;
                $_SESSION['pending_signup_email_time'] = time(); 
                sendResponse('success', '', '/chain-fortune/auth/signup_otp');
                exit();
            } else {
                $deleteStmt = $conn->prepare("DELETE FROM pending_users WHERE email = ?");
                $deleteStmt->bind_param("s", $email);
                if (!$deleteStmt->execute()) {
                    error_log("Database error: " . $deleteStmt->error);
                    sendResponse('error', 'You must agree to the terms and conditions!');
                }
                $deleteStmt->close();
                sendResponse('error', 'Signup failed, please check your internet connection and try again!');
                return;
            }
            $stmt->close();
            
        } else {
            error_log("Database error: " . $stmt->error);
            sendResponse('error', 'Unexpected error occurred, please try again.');
        }
        $stmt->close();
    }
?>

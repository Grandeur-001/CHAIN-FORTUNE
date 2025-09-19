<?php
    session_start();
    header('Content-Type: application/json');
    include 'connection.php'; 

    function sendResponse($status, $message, $redirect = null) {
        $response = ['status' => $status, 'message' => $message];
        if ($redirect) {
            $response['redirect'] = $redirect;
        }
        echo json_encode($response);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['token'], $_POST['new_password'])) {
            sendResponse('error', 'Invalid request.');
        }

        if (!isset($_SESSION['reset_email'])) {
            sendResponse('error', 'Session expired or email not found.');
        }

        $email = $_SESSION['reset_email'];
        $token = trim($_POST['token']);
        $password = trim($_POST['new_password']);


        $stmt = $conn->prepare("SELECT reset_link, expires_at FROM password_reset_token WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows !== 1) {
            sendResponse('error', 'Invalid or expired password reset link.');
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        if (!preg_match($pattern, $password)) {
            sendResponse('error', 'Password must be at least 8 characters long, include uppercase, lowercase, number, and special character.');
        }


        $row = $result->fetch_assoc();
        $stored_token = $row['reset_link'];
        $expires_at = strtotime($row['expires_at']);
        $current_time = time();

        if ($stored_token !== $token) {
            sendResponse('error', 'Invalid token.');
        }

        if ($current_time > $expires_at) {
            sendResponse('error', 'The link you clicked has expired.');
        }

        $delete_stmt = $conn->prepare("DELETE FROM password_reset_token WHERE email = ? AND reset_link = ?");
        $delete_stmt->bind_param("ss", $email, $token);
        $delete_stmt->execute();

        if ($delete_stmt->affected_rows === 0) {
            sendResponse('error', 'This reset link has already been used or is invalid.');
        }

        $options = ['cost' => 12];
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

        $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $update_stmt->bind_param("ss", $hashedPwd, $email);
        if (!$update_stmt->execute()) {
            sendResponse('error', 'Failed to update password.');
        }

        $redirect = '/chain-fortune/auth/login';
        unset($_SESSION['reset_email']);
        sendResponse('success', 'Password reset successfully, login with your password now!', $redirect);

    }
?>

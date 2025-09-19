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
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($email === '') {
        sendResponse('error', 'Email is required.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendResponse('error', 'Invalid email address.');
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        sendResponse('error', 'No account found with this email.');
    }
    $stmt->close();
    

    // $stmt = $conn->prepare("SELECT * FROM verified_emails WHERE email = ?");
    // $stmt->bind_param("s", $email);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // if ($result->num_rows === 0) {
    //     sendResponse('error', 'The email you provided is not verified');
    // }
    // $stmt->close();

    $ch = curl_init("http://localhost/chain-fortune/action/password_reset_token_sender");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['email' => $email]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);

    if (isset($json['status']) && $json['status'] === 'success') {
        $_SESSION['reset_email'] = $email;
        sendResponse('success', 'Password reset link sent to your email.');
    } else {
        sendResponse('error', 'Failed to send reset link. Try again later.');
    }
} else {
    sendResponse('error', 'Invalid request method.');
}

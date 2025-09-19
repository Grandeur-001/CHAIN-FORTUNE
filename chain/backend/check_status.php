<?php
session_start();
require 'connection.php';
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT status FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    session_destroy();
    header("Location: /chain-fortune/auth/login");
    exit;
}

$row = $result->fetch_assoc();
if (strtolower($row['status']) === 'disabled') {
    session_destroy();
    header("Location: /chain-fortune/auth/login?error=account_disabled");
    exit;
}
?>

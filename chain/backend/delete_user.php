<?php
include 'connection.php'; 

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;

    if ($user_id === null) {
        die("Invalid user ID.");
    }
    if ($user_id === $adminUserId) {
        die("You cannot perform this action.");
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        echo "success"; 
    } else {
        echo "error"; 
    }

    $stmt->close();
}
?>

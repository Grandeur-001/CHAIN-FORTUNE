<?php
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);

include 'connection.php';

$query = "SELECT user_id, firstname, lastname, email, status, date, role, profile_picture FROM users ORDER BY date DESC";
$result = $conn->query($query);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['role'] === 'admin' && $row['user_id'] == $adminUserId) {
            continue;
        }

        $users[] = [
            'user_id' => $row['user_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'status' => $row['status'],
            'profile_picture' => $row['profile_picture'],
            'role' => $row['role'],
            'date' => $row['date'],
        ]; 
    }
} else {
    echo "<p>No users found in the database.</p>";
}
?>

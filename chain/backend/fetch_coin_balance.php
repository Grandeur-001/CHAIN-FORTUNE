
<?php
session_start();
require 'connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT id, user_id, crypto_id, crypto_name, crypto_symbol, crypto_icon, amount FROM users_wallet WHERE user_id = ? ORDER BY id ASC";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$balances = [];

while ($row = $result->fetch_assoc()) {
    $balances[] = [
        'crypto_id' => htmlspecialchars($row['crypto_id']),
        'crypto_name' => htmlspecialchars($row['crypto_name']),
        'crypto_symbol' => htmlspecialchars($row['crypto_symbol']),
        'crypto_icon' => htmlspecialchars($row['crypto_icon']),
        'amount' => htmlspecialchars($row['amount']),
    ];
}

$stmt->close();
$conn->close();

echo json_encode(['status' => 'success', 'balances' => $balances]);
exit();
?>

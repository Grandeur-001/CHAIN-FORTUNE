<?php
include 'connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['found' => false, 'message' => 'Invalid request method.']);
    exit;
}

$user_id = trim($_POST['user_id'] ?? '');

if (empty($user_id)) {
    echo json_encode(['found' => false, 'message' => 'User ID is required.']);
    exit;
}

// Step 1: Check if user exists in verified_kyc
$stmt1 = $conn->prepare("SELECT id FROM verified_kyc WHERE user_id = ?");
$stmt1->bind_param("s", $user_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows === 0) {
    echo json_encode(['found' => false, 'message' => 'User not found in verified KYC.']);
    exit;
}
$stmt1->close();

// Step 2: Check status in kyc_requests
$stmt2 = $conn->prepare("SELECT status FROM kyc_requests WHERE user_id = ?");
$stmt2->bind_param("s", $user_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2->num_rows === 0) {
    echo json_encode(['found' => true, 'status' => 'Unknown', 'message' => 'No KYC request status found.']);
    exit;
}

$row = $result2->fetch_assoc();
$status = $row['status'];
$stmt2->close();

echo json_encode([
    'found' => true,
    'status' => $status
]);
exit;
?>

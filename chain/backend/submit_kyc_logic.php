<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include "connection.php";
header('Content-Type: application/json');
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendResponse($status, $message, $redirect = null) {
    ob_clean();
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'redirect' => $redirect
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id     = trim($_POST['user_id'] ?? '');
    $full_name   = trim($_POST['full_name'] ?? '');
    $dob         = trim($_POST['dob'] ?? '');
    $address     = trim($_POST['address'] ?? '');

    if (!$user_id || !$full_name || !$dob || !$address) {
        sendResponse('error', 'All fields are required.');
    }

    $check = $conn->prepare("SELECT status FROM kyc_requests WHERE user_id = ? LIMIT 1");
    $check->bind_param("s", $user_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $check->bind_result($status);
        $check->fetch();

        if ($status === 'Pending') {
            sendResponse('error', 'KYC already submitted and pending admin approval.');
        } elseif ($status === 'Approved') {
            sendResponse('success', 'KYC Already Verified.');
        } elseif ($status === 'Rejected') {
            $delete = $conn->prepare("DELETE FROM kyc_requests WHERE user_id = ?");
            $delete->bind_param("s", $user_id);
            $delete->execute();
            $delete->close();
        }
    }
    $check->close();

    $govtIdDir = __DIR__ . '/govt_id/';
    $utilityBillDir = __DIR__ . '/utility_bill/';
    if (!is_dir($govtIdDir)) mkdir($govtIdDir, 0755, true);
    if (!is_dir($utilityBillDir)) mkdir($utilityBillDir, 0755, true);

    $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp', 'pdf'];
    $maxFileSize = 5 * 1024 * 1024;

    if (empty($_FILES['gov_id']['tmp_name'])) {
        sendResponse('error', 'Government ID file is required.');
    }
    $govFile = $_FILES['gov_id'];
    $govExt = strtolower(pathinfo($govFile['name'], PATHINFO_EXTENSION));
    if (!in_array($govExt, $allowedExtensions)) {
        sendResponse('error', 'Government ID must be PNG, JPG, JPEG, PDF or WEBP.');
    }
    if ($govFile['size'] > $maxFileSize) {
        sendResponse('error', 'Government ID file exceeds 5MB.');
    }
    $govFilename = "gov_id_{$user_id}_" . time() . ".$govExt";
    if (!move_uploaded_file($govFile['tmp_name'], $govtIdDir . $govFilename)) {
        sendResponse('error', 'Failed to upload Government ID.');
    }

    if (empty($_FILES['utility_bill']['tmp_name'])) {
        sendResponse('error', 'Utility Bill file is required.');
    }
    $billFile = $_FILES['utility_bill'];
    $billExt = strtolower(pathinfo($billFile['name'], PATHINFO_EXTENSION));
    if (!in_array($billExt, $allowedExtensions)) {
        sendResponse('error', 'Utility Bill must be PNG, JPG, JPEG, PDF or WEBP.');
    }
    if ($billFile['size'] > $maxFileSize) {
        sendResponse('error', 'Utility Bill file exceeds 5MB.');
    }
    $billFilename = "utility_bill_{$user_id}_" . time() . ".$billExt";
    if (!move_uploaded_file($billFile['tmp_name'], $utilityBillDir . $billFilename)) {
        sendResponse('error', 'Failed to upload Utility Bill.');
    }

    $stmt = $conn->prepare("INSERT INTO kyc_requests (user_id, full_name, date_of_birth, address, utility_bill, gov_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $user_id, $full_name, $dob, $address, $billFilename, $govFilename);

    if ($stmt->execute()) {
        sendResponse('success', 'KYC submitted successfully!', '/chain-fortune/admin/profile');
    } else {
        sendResponse('error', 'Failed to submit KYC. Please try again.');
    }

    $stmt->close();
} else {
    sendResponse('error', 'Invalid request method.');
}
?>

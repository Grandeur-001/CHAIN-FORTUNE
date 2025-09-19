<?php
require 'connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $email = isset($data['email']) ? trim($data['email']) : '';
    $user_id = isset($data['user_id']) ? trim($data['user_id']) : '';
    $subject = isset($data['subject']) ? trim($data['subject']) : '';

    if (!empty($email) && !empty($user_id) && !empty($subject)) {
        $stmt = $conn->prepare("UPDATE email_tracking 
                                SET checked = checked + 1, 
                                    delivery_status = 'Delivered',
                                    date_checked = NOW()
                                WHERE user_id = ? AND recipient = ? AND subject = ?");
        $stmt->bind_param("sss", $user_id, $email, $subject);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Tracking updated']);
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}
?>

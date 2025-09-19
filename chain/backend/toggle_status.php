<?php
    include 'connection.php'; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
        $currentStatus = isset($_POST['current_status']) ? $_POST['current_status'] : null;

        if (!$userId || !$currentStatus) {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
            exit;
        }

        $newStatus = ($currentStatus === 'Enabled') ? 'Disabled' : 'Enabled';

        $stmt = $conn->prepare("SELECT firstname FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($first_name);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        $stmt->bind_param('si', $newStatus, $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'new_status' => $newStatus, 'first_name' => $first_name]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error.']);
        }

        $stmt->close();
        $conn->close();
        exit;
    }

<?php
include 'connection.php'; 
header('Content-Type: application/json');

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);

function sendResponse($status, $message, $redirect = null) {
    $response = ['status' => $status, 'message' => $message];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['user_id'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($user_id)) {
        sendResponse('error', 'User ID is required.');
    }

    if (empty($email)) {
        sendResponse('error', 'Email is required.');
    }
    if($user_id === $adminUserId){
        sendResponse('error', 'You cannot perform this action.');
    }

    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'User not found.');
    }

    $userData = $result->fetch_assoc();
    $fullName = trim($userData['firstname'] . ' ' . $userData['lastname']);

    $checkDisabled = "SELECT * FROM disabled_users WHERE user_id = ?";
    $stmtCheck = $conn->prepare($checkDisabled);
    $stmtCheck->bind_param('s', $user_id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $deleteQuery = "DELETE FROM disabled_users WHERE user_id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param('s', $user_id);

        if ($deleteStmt->execute()) {
            $updateStatusQuery = "UPDATE users SET status = 'Enabled' WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateStatusQuery);
            $updateStmt->bind_param('s', $user_id);
            
            if ($updateStmt->execute()) {
                sendResponse('success', "$fullName has been enabled.", '/chain-fortune/admin/users');
            } else {
                sendResponse('error', 'Enabled user, but failed to update status.');
            }
        } else {
            sendResponse('error', 'Failed to enable user.');
        }

    } else {
        // Disable the user
        $disabledBy = 'CHAIN FORTUNE';
        $insertQuery = "INSERT INTO disabled_users (user_id, email, disabled_by) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param('sss', $user_id, $email, $disabledBy);

        if ($insertStmt->execute()) {
            $updateStatusQuery = "UPDATE users SET status = 'Disabled' WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateStatusQuery);
            $updateStmt->bind_param('s', $user_id);
            
            if ($updateStmt->execute()) {
                sendResponse('success', "$fullName has been disabled.", '/chain-fortune/admin/users');
            } else {
                sendResponse('error', 'Disabled user, but failed to update status.');
            }
        } else {
            sendResponse('error', 'Failed to disable user.');
        }
    }
} else {
    sendResponse('error', 'Invalid request method.');
}

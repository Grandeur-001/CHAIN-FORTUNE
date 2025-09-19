
<?php
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : null;
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;

    if (!$userId || !$firstname || !$lastname || !$email) {
        $GLOBALS['ERROR'] = "All fields are required";
        sendResponse('error', $GLOBALS['ERROR']);
    }
    if($userId == $adminUserId) {
        $GLOBALS['ERROR'] = "Action denied! You cannot edit the Admin's details.";
        sendResponse('error', $GLOBALS['ERROR']);
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
    $stmt->bind_param("si", $email, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $GLOBALS['SUCCESS'] = "Email already in use!";
        sendResponse('success', $GLOBALS['SUCCESS']);
    }
    
    $token = bin2hex(random_bytes(32));
    $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, session_token = ? WHERE user_id = ?");
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $token, $userId);

    if ($stmt->execute()) {
        $GLOBALS['SUCCESS'] = "User details updated successfully";
        sendResponse('success', $GLOBALS['SUCCESS']);
    } else {
        $GLOBALS['ERROR'] = "Request unsuccessfull, please try again.";
        sendResponse('error', $GLOBALS['ERROR']);
    }

    $stmt->close();
    $conn->close();
    exit;
}


function sendResponse($status, $message){
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

?>

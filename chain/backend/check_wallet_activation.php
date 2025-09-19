
<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    if (!$userId) {
        $GLOBALS['SUCCESS'] = "No user detected for this action";
        sendResponse('error', $GLOBALS['SUCCESS']);
    }

    $stmt = $conn->prepare("SELECT user_id FROM users_wallet WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 12) {
        $GLOBALS['SUCCESS'] = "Wallet already activated";
        sendResponse('success', $GLOBALS['SUCCESS']);
    }else{
        $GLOBALS['ERROR'] = "This wallet needs activation";
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

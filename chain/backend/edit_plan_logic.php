
<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_id = isset($_POST['planId']) ? intval($_POST['planId']) : null;
    $plan_name = htmlspecialchars(trim($_POST['plan_name']));
    $percentage = htmlspecialchars(trim($_POST['percentage']));
    $minimum = htmlspecialchars(trim($_POST['minimum']));
    $maximum = htmlspecialchars(trim($_POST['maximum']));
    $duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
    $duration_timeframe = htmlspecialchars(trim($_POST['duration_timeframe']));
    $roi = htmlspecialchars(trim($_POST['roi']));
    $commission = htmlspecialchars(trim($_POST['commission']));
    $benefit = htmlspecialchars(trim($_POST['benefit']));

    if (!$plan_id || !$plan_name || !$percentage || !$minimum || !$maximum || !$duration || !$duration_timeframe || !$roi || !$commission || !$benefit) {
        $GLOBALS['ERROR'] = "All fields are required!";
        sendResponse('error', $GLOBALS['ERROR']);
    }
    if($percentage !== $roi){
        $GLOBALS['ERROR'] = "Percentage and ROI must be the same!";
        sendResponse('error', $GLOBALS['ERROR']);
    }
    $created_at = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("UPDATE investment_plans SET plan_name = ?, percentage = ?, minimum = ?, maximum = ?, duration = ?, duration_timeframe = ?, roi = ?, commission = ?, benefit = ?, created_at = ? WHERE plan_id = ?");
    $stmt->bind_param("sssssssssss", $plan_name, $percentage, $minimum, $maximum, $duration, $duration_timeframe, $roi, $commission, $benefit, $created_at, $plan_id);

    if ($stmt->execute()) {
        $GLOBALS['SUCCESS'] = "Plan updated successfully";
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

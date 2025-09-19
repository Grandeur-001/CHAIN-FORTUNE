<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_name = htmlspecialchars(trim($_POST['plan_name']));
    $percentage = htmlspecialchars(trim($_POST['percentage']));
    $minimum = htmlspecialchars(trim($_POST['minimum']));
    $maximum = htmlspecialchars(trim($_POST['maximum']));
    $duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
    $duration_timeframe = htmlspecialchars(trim($_POST['duration_timeframe']));
    $roi = htmlspecialchars(trim($_POST['roi']));
    $commission = htmlspecialchars(trim($_POST['commission']));
    $benefit = htmlspecialchars(trim($_POST['benefit']));

    if (!$plan_name || !$percentage || !$minimum || !$maximum || !$duration || !$duration_timeframe || !$roi || !$commission || !$benefit) {
        $GLOBALS['ERROR'] = "All fields are required!";
        sendResponse('error', $GLOBALS['ERROR']);
    }
    if($percentage !== $roi){
        $GLOBALS['ERROR'] = "Percentage and ROI must be the same!";
        sendResponse('error', $GLOBALS['ERROR']);
    }

    $stmt = $conn->prepare("SELECT plan_name FROM investment_plans WHERE plan_name = ?");
    $stmt->bind_param("s", $plan_name);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $GLOBALS['ERROR'] = "Plan Name Already Taken";
        sendResponse('error', $GLOBALS['ERROR']);
    }
    $stmt->close();

    $created_at = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO investment_plans (plan_name, percentage, minimum, maximum, duration, duration_timeframe, roi, commission, benefit, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $plan_name, $percentage, $minimum, $maximum, $duration, $duration_timeframe, $roi, $commission, $benefit, $created_at);

    if ($stmt->execute()) {
        $GLOBALS['SUCCESS'] = "$plan_name plan successfully created!";
        sendResponse('success', $GLOBALS['SUCCESS']);
    } else {
            error_log("Database error: " . $stmt->error);
            $GLOBALS['ERROR'] = "Request unsuccessfull, please try again.";
            sendResponse('error', $GLOBALS['ERROR']);
        $stmt->close();
    }

}

function sendResponse($status, $message){
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}




?>

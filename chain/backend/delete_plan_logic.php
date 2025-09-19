<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_plan'])) {
    $plan_id = isset($_POST['plan_id']) ? intval($_POST['plan_id']) : null;

    if ($plan_id === null) {
        die("Invalid Plan ID.");
    }

    $query = "SELECT plan_id, plan_name, percentage, minimum, maximum, duration, roi, commission, benefit FROM investment_plans ORDER BY created_at ASC";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
      $stmt = $conn->prepare("DELETE FROM investment_plans WHERE plan_id = ?");
      $stmt->bind_param('i', $plan_id);

      if ($stmt->execute()) {
        $GLOBALS['SUCCESS'] = "You deleted the last plan";
        sendResponse('success', $GLOBALS['SUCCESS'], true);
      }
    }


    $stmt = $conn->prepare("DELETE FROM investment_plans WHERE plan_id = ?");
    $stmt->bind_param('i', $plan_id);

    if ($stmt->execute()) {
      $GLOBALS['SUCCESS'] = "Plan successfully deleted!";
      sendResponse('success', $GLOBALS['SUCCESS'], "");

    } else {
      $GLOBALS['ERROR'] = "No Plans Available!";
      sendResponse('error', $GLOBALS['ERROR'], "");
    }

    $stmt->close();
}
function sendResponse($status, $message, $last_plan){
    echo json_encode(['status' => $status, 'message' => $message, 'last_plan' => $last_plan]);
    exit();
}



?>

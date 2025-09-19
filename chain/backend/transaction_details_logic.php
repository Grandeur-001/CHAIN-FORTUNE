<?php
require 'connection.php';

if (!isset($_GET['hash'])) {
    die("Invalid request.");
}

$transaction_id = $_GET['hash'];

$sql = "SELECT * FROM deposit_transactions WHERE transaction_id = '$transaction_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
  $GLOBALS['SUCCESS'] = "Transaction not found";
  sendResponse('success', $GLOBALS['SUCCESS']);
}

$transaction = mysqli_fetch_assoc($result);

mysqli_close($conn);

function sendResponse($status, $message){
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

?>

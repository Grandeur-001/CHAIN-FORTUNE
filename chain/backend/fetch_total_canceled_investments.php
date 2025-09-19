<?php
$status = 'canceled'; 
$stmt = $conn->prepare("SELECT COUNT(*) AS canceled FROM investments WHERE status = ?");
$stmt->bind_param("s", $status);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row_canceled_investments = $result->fetch_assoc();
} else {
    echo "No investments found.";
}

$stmt->close();
?>

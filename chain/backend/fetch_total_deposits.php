<?php

$sql_deposits = "SELECT SUM(amount) AS total_deposits FROM deposit_transactions";
$result_deposits = $conn->query($sql_deposits);
if ($result_deposits->num_rows > 0) {
    $row_deposits = $result_deposits->fetch_assoc();
    $total_deposits = number_format((float)$row_deposits["total_deposits"], 2, '.', ',');
} else {
    echo "No deposits found.<br>";
}

?>
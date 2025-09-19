<?php
    $sql_withdrawals = "SELECT COUNT(*) AS total_withdrawals FROM withdrawal_transactions";
    $result_withdrawals = $conn->query($sql_withdrawals);
    if ($result_withdrawals->num_rows > 0) {
        $row_withdrawals = $result_withdrawals->fetch_assoc();
    } else {
        echo "No withdrawals found.";
    }
?>
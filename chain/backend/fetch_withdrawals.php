<?php
require 'connection.php'; 

$sql = "
    SELECT dt.*, u.firstname, u.lastname
    FROM withdrawal_transactions dt
    JOIN users u ON dt.user_id = u.user_id
    ORDER BY dt.transaction_time DESC
"; 
$result = $conn->query($sql);

$transactions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}else{
    die();
};

?>

<?php 
  $user_id = $_SESSION['user_id'];
        
  $sql_user_deposits = "SELECT SUM(amount) AS user_total_deposits FROM deposit_transactions WHERE user_id = ?";
  $stmt = $conn->prepare($sql_user_deposits);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result_user_deposits = $stmt->get_result();

  if ($result_user_deposits->num_rows > 0) {
      $row_user_deposits = $result_user_deposits->fetch_assoc();
      $user_total_deposits = number_format((float)$row_user_deposits["user_total_deposits"], 2, '.', ',');
  } else {
  }
?>
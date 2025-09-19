<?php 
  $user_id = $_SESSION['user_id'];
        
  $sql_user_profits = "SELECT SUM(total_profit) AS user_total_profits FROM investments WHERE user_id = ?";
  $stmt = $conn->prepare($sql_user_profits);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result_user_profits = $stmt->get_result();

  if($result_user_profits->num_rows > 0) {
      $row_user_profits = $result_user_profits->fetch_assoc();
      $user_total_profits = number_format((float)$row_user_profits["user_total_profits"], 2, '.', ',');

  } else {
  }
?>
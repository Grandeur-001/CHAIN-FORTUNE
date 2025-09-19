<?php
  include 'connection.php';

  $query = "SELECT plan_id, plan_name, percentage, minimum, maximum, duration, duration_timeframe, roi, commission, benefit FROM investment_plans ORDER BY created_at ASC";
  $result = $conn->query($query);

  $plans = [];
  if ($result->num_rows > 0) {
      $plan = true;
      while ($row = $result->fetch_assoc()) {
          $plans[] = [
              'plan_id' => $row['plan_id'],
              'plan_name' => $row['plan_name'],
              'percentage' => $row['percentage'],
              'minimum' => $row['minimum'],
              'maximum' => $row['maximum'],
              'duration' => $row['duration'],
              'duration_timeframe' => $row['duration_timeframe'],
              'roi' => $row['roi'],
              'commission' => $row['commission'],
              'benefit' => $row['benefit'],
          ];
      }
  } else {
        $plan = false;
        $_SESSION['update_message'] = "No Investment Plans Available!";
        $_SESSION['update_type'] = "error";
  }





?>

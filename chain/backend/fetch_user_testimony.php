<?php
  include 'connection.php';

  $query = "SELECT testimony_id,  user_id, firstname, lastname, testimony, rating, profile_picture, created_at FROM clients_testimonials ORDER BY testimony_id ASC";
  $profile_query = "SELECT profile_picture FROM users ORDER BY firstname ASC";
  $result = $conn->query($query);

  $testimonies = [];
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $testimonies[] = [
              'testimony_id' => $row['testimony_id'],
              'user_id' => $row['user_id'],
              'firstname' => $row['firstname'],
              'lastname' => $row['lastname'],
              'testimony' => $row['testimony'],
              'rating' => $row['rating'],
              'profile_picture' => $row['profile_picture'],
              'created_at' => $row['created_at']
          ];
      }
  } else {
      echo "<p>No users found in the database.</p>";
  }

?>

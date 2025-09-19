<?php
    $sql_users = "SELECT COUNT(*) AS total_users FROM users";
    $result_users = $conn->query($sql_users);

    if ($result_users->num_rows > 0) {
        $row_users = $result_users->fetch_assoc();
    } else {
        echo "No users found.";
    }
?>
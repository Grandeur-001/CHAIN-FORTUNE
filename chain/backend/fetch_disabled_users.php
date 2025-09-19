<?php
    $sql_disabled_users = "
        SELECT COUNT(*) AS disabled_user_count
        FROM users u
        INNER JOIN disabled_users d ON u.user_id = d.user_id
    ";

    $result_disabled_users = mysqli_query($conn, $sql_disabled_users);

    if ($result_disabled_users && $row_disabled_users = mysqli_fetch_assoc($result_disabled_users)) {
    } else {
        echo "Error retrieving disabled user count.";
    }

?>
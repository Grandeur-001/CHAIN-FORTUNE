<?php 

    $sql_unverified = "
    SELECT COUNT(*) AS unverified_user_count
    FROM users u
    WHERE u.email NOT IN (SELECT email FROM verified_emails)
    OR u.user_id NOT IN (SELECT user_id FROM verified_kyc)
    ";

    $result_unverified = mysqli_query($conn, $sql_unverified);

    if ($result_unverified && $row_unverified = mysqli_fetch_assoc($result_unverified)) {
    } else {
    echo "Error retrieving unverified user count.";
    }

?>
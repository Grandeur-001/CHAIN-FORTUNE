<?php
$sql_verified = "
SELECT COUNT(*) AS verified_user_count
FROM users u
INNER JOIN verified_emails ve ON u.email = ve.email
INNER JOIN verified_kyc vk ON u.user_id = vk.user_id
";

$result_verified = mysqli_query($conn, $sql_verified);

if ($result_verified && $row_verified = mysqli_fetch_assoc($result_verified)) {
} else {
echo "Error retrieving verified user count.<br>";
}
?>
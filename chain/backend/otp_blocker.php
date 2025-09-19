<?php
function hasTooManyRecentOtps($email, $purpose = 'login', $limit = 3, $minutes = 15) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM verification_codes WHERE email = ? AND purpose = ? AND created_at >= NOW() - INTERVAL ? MINUTE");
    $stmt->bind_param("ssi", $email, $purpose, $minutes);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count >= $limit;
}
?>

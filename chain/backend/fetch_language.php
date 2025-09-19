<?php
include "connection.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT language FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $language = $row['language'];

    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
    }

}
?>

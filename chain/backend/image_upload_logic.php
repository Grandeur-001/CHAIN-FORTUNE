<?php
include "connection.php";

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);

$query = "SELECT profile_picture FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (!empty($row['profile_picture']) && file_exists(__DIR__ . '/uploads/' . $row['profile_picture'])) {
        $profile_picture = htmlspecialchars($row['profile_picture'], ENT_QUOTES, 'UTF-8'); // just filename
    } else {
        $profile_picture = 'default.jpg';
    }
} else {
    $profile_picture = 'default.jpg'; 
}


if (strpos($profile_picture, 'default') !== false) {
    echo '<script>
            setInterval(function() {
                showToast("error", "Please add a profile picture");
            }, 20000);
          </script>';
};
$stmt->close();

$user_role = $_SESSION['user_role'] ?? null;
$redirect = ($_SESSION['user_id'] === $adminUserId && $_SESSION['user_role'] === 'admin') 
    ? '/chain-fortune/admin/profile'
    : '/chain-fortune/profile'; 

if (isset($_POST['upload_photo'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = mime_content_type($fileTmpPath);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];

        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileType, $allowedTypes) && in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = __DIR__ . '/uploads/';
            $uploadFile = $uploadDir . basename($fileName);

            $query = "UPDATE users SET profile_picture = ? WHERE user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $fileName, $user_id);

            if ($stmt->execute()) {
                if (move_uploaded_file($fileTmpPath, $uploadFile)) {
                    $_SESSION['update_message'] = 'Profile picture updated successfully!';
                    $_SESSION['update_type'] = 'success';
                    $_SESSION['redirect'] = $redirect;
                    $_SESSION['redirect_text'] = 'Ok';

                    $admin_id = $adminUserId; 
                    $notification_message = "$user_id updated their profile picture.";
                    $notification_symbol = "https://366icons.com/media/01/profile-avatar-account-icon-16699.svg";
                    $notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
                    $notification_stmt = $conn->prepare($notification_query);

                    if ($notification_stmt) {
                        $notification_stmt->bind_param('iss', $admin_id, $notification_message, $notification_symbol);
                        $notification_stmt->execute();
                        $notification_stmt->close();
                    }
                } else {
                    $_SESSION['update_message'] = 'Failed to save the uploaded file.';
                    $_SESSION['update_type'] = 'error';
                    $_SESSION['redirect'] = '#';
                    $_SESSION['redirect_text'] = 'Retry';
                }
            } else {
                $_SESSION['update_message'] = 'Failed to update the profile picture in the database.';
                $_SESSION['update_type'] = 'error';
                $_SESSION['redirect'] = '#';
                $_SESSION['redirect_text'] = 'Retry';
            }

            $stmt->close();
        } else {
            $_SESSION['update_message'] = 'Only JPG, JPEG, PNG, GIF, or WEBP image files are allowed.';
            $_SESSION['update_type'] = 'error';
            $_SESSION['redirect'] = '#';
            $_SESSION['redirect_text'] = 'Retry';
        }
    } else {
        $_SESSION['update_message'] = 'No file uploaded or there was an upload error.';
        $_SESSION['update_type'] = 'error';
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }
}
$conn->close();
?>
       

<?php
include 'connection.php';

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$adminUserId = trim($_ENV['ADMIN_USER_ID']);

$update_success = '';
$update_error = '';


if (isset($_POST['update_profile'])) {

    $new_firstname = trim($_POST['firstname']);
    $new_lastname = trim($_POST['lastname']);
    $new_email = trim($_POST['email']);
    $new_email = filter_var($new_email, FILTER_SANITIZE_EMAIL);
    $user_id = $_SESSION['user_id'];

    if (empty($new_firstname) || empty($new_lastname) || empty($new_email)) {
        $_SESSION['update_message'] = "All fields are required.";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }
  
    if (!preg_match('/^[a-zA-Z]+$/', $new_firstname)) {
        $_SESSION['update_message'] = "First name can only contain letters.";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }
    if (!preg_match('/^[a-zA-Z]+$/', $new_lastname)) {
        $_SESSION['update_message'] = "Last name can only contain letters.";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }
    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['update_message'] = "Invalid email format.";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ? AND user_id != ?");
    $stmt->bind_param("si", $new_email, $user_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $_SESSION['update_message'] = "Email already in use!";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';

        if ($_SESSION['user_id'] === $adminUserId) {
            header("Location: /chain-fortune/admin/profile");
        } else {
            header("Location: /chain-fortune/profile");
        }
        exit();
    }
    

    $update_query = "UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $new_firstname, $new_lastname, $new_email, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['user_firstname'] = $new_firstname;
            $_SESSION['user_lastname'] = $new_lastname;
            $_SESSION['user_email'] = $new_email;

            $_SESSION['update_message'] = "Profile updated successfully. For security purpose please log in again.";
            $_SESSION['update_type'] = "success";
            $_SESSION['redirect'] = "/chain-fortune/auth/login";
            $_SESSION['redirect_text'] = "Log in again";


            $admin_id = $adminUserId;
            $notification_symbol = "https://icon-library.com/images/change-password-icon/change-password-icon-11.jpg";
            $admin_notification_message = "$user_id Updated their profile info.";
            $admin_notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
            $admin_notification_stmt = mysqli_prepare($conn, $admin_notification_query);

            if ($admin_notification_stmt) {
                mysqli_stmt_bind_param($admin_notification_stmt, "iss", $admin_id, $admin_notification_message, $notification_symbol);
                mysqli_stmt_execute($admin_notification_stmt);
                mysqli_stmt_close($admin_notification_stmt);
            }
            session_destroy();
            session_unset();

        } else {
            $_SESSION['update_message'] = "Error updating profile: " . mysqli_stmt_error($stmt);
            $_SESSION['update_type'] = "error";
            $_SESSION['redirect'] = '#';
            $_SESSION['redirect_text'] = 'Retry';
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['update_message'] = "Error preparing query.";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }

}

if (isset($_POST['change_password_btn'])) {

    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    $query = "SELECT password FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $stored_password);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if (password_verify($current_password, $stored_password)) {
            if ($new_password === $confirm_password) {
                $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
                if (preg_match($pattern, $new_password)) {
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $update_password_query = "UPDATE users SET password = ? WHERE user_id = ?";
                    $stmt = mysqli_prepare($conn, $update_password_query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);
                        if (mysqli_stmt_execute($stmt)) {
                            $_SESSION['update_message'] = "Password updated successfully. For security purpose please log in again.";
                            $_SESSION['update_type'] = "success";
                            $_SESSION['redirect'] = "/chain-fortune/auth/login";

                            $notification_message = "You changed your password.";
                            $notification_symbol = "https://icon-library.com/images/change-password-icon/change-password-icon-11.jpg";
                            $notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
                            $notification_stmt = mysqli_prepare($conn, $notification_query);

                            if ($notification_stmt) {
                                mysqli_stmt_bind_param($notification_stmt, "iss", $user_id, $notification_message, $notification_symbol);
                                mysqli_stmt_execute($notification_stmt);
                                mysqli_stmt_close($notification_stmt);
                            }

                            $admin_id = $adminUserId;
                            $admin_notification_message = "$user_id changed their password.";
                            $admin_notification_query = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
                            $admin_notification_stmt = mysqli_prepare($conn, $admin_notification_query);

                            if ($admin_notification_stmt) {
                                mysqli_stmt_bind_param($admin_notification_stmt, "iss", $admin_id, $admin_notification_message, $notification_symbol);
                                mysqli_stmt_execute($admin_notification_stmt);
                                mysqli_stmt_close($admin_notification_stmt);
                            }
                            session_destroy();
                            session_unset();
                        } else {
                            $_SESSION['update_message'] = "Error updating password.";
                            $_SESSION['update_type'] = "error";
                            $_SESSION['redirect'] = '#';
                            $_SESSION['redirect_text'] = 'Retry';
                        }
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    $_SESSION['update_message'] = "Password: at least 1 uppercase, 1 lowercase, 1 number, 1 symbol and 8 characters long";
                    $_SESSION['update_type'] = "error";
                    $_SESSION['redirect'] = '#';
                    $_SESSION['redirect_text'] = 'Retry';
                }
            } else {
                $_SESSION['update_message'] = "New password and confirm password do not match.";
                $_SESSION['update_type'] = "error";
                $_SESSION['redirect'] = '#';
                $_SESSION['redirect_text'] = 'Retry';
            }
        } else {
            $_SESSION['update_message'] = "Current password is incorrect.";
            $_SESSION['update_type'] = "error";
            $_SESSION['redirect'] = '#';
            $_SESSION['redirect_text'] = 'Retry';
        }
    } else {
        $_SESSION['update_message'] = "Error retrieving user details.";
        $_SESSION['update_type'] = "error";
        $_SESSION['redirect'] = '#';
        $_SESSION['redirect_text'] = 'Retry';
    }

}




















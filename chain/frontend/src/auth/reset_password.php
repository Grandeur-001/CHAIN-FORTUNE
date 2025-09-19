<?php
    session_start();
    include '../../../backend/connection.php';
    if(!isset($_GET['token']) || empty($_GET['token'])) {
        http_response_code(400);
        session_unset();
        session_destroy();
        die( <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>
                        *{
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                        body { margin: 0; background: #000; color: #fff; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;  } 
                        .swal2-popup {
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                    </style>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Request',
                            text: 'Sorry! No reset token was provided.',
                            background: '#1e1e1e',
                            confirmButtonColor: 'red',
                            color: '#ffffff',
                            confirmButtonText: 'Exit',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/chain-fortune/page/home';
                            }
                        });
                    </script>
                </body>
            </html>
        HTML );
        exit();
    }

    if (isset($_GET['token']) && isset($_SESSION['reset_email'])) {
        $token = trim($_GET['token']);
        $email = $_SESSION['reset_email'];

        $stmt = $conn->prepare("SELECT expires_at FROM password_reset_token WHERE email = ? AND reset_link = ?");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $result = $stmt->get_result();


        $row = $result->fetch_assoc();
        $expires_at = strtotime($row['expires_at']);
        $current_time = time();

        if ($current_time > $expires_at) {
            die( <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>
                        *{
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                        body { margin: 0; background: #000; color: #fff; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;  } 
                        .swal2-popup {
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                    </style>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Error!',
                            text: 'The password reset link has expired. Please request a new one.',
                            background: '#1e1e1e',
                            confirmButtonColor: 'red',
                            color: '#ffffff',
                            confirmButtonText: 'Request New Link',
                            customClass: {
                                popup: 'swal2-dark-popup'
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/chain-fortune/auth/forgot_password';
                            }
                        });
                    </script>
                </body>
            </html>
        HTML );
        exit();
        }
    } else {
        session_unset();
        session_destroy();
        die( <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>
                        *{
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                        body { margin: 0; background: #000; color: #fff; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;  } 
                        .swal2-popup {
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                    </style>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Error!',
                            text: 'Expired or Invalid token.',
                            background: '#1e1e1e',
                            confirmButtonColor: 'red',
                            color: '#ffffff',
                            confirmButtonText: 'Request New Link',
                            customClass: {
                                popup: 'swal2-dark-popup'
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/chain-fortune/auth/forgot_password';
                            }
                        });
                    </script>
                </body>
            </html>
        HTML );
        exit();
    }
    $stmt->close();



    $token = isset($_GET['token']) ? htmlspecialchars($_GET['token']) : '';
    if (empty($token)) {
        echo "Invalid or missing token.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune../styles/style.css">
    <link rel="stylesheet" href="../styles/config/config.css">
    <style>
        *{
            font-family: var(--index-font);
        }
    </style>

</head>
<?php
    include "../components/toastify.php";
    include("../components/page_refresh_loader.php");
?>

<body id="auth_bg">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <div>
                    <img onclick="location.href=`/chain-fortune/page/home`" src="/chain-fortune/images/logo/logo_2.png" width="70" style="margin-top: 10px; cursor: pointer;" alt="">
                </div>
                <h1>New password</h1>
                <p>Let’s boost your security – enter a new, strong password below.</p>
            </div>
            
            <div class="auth-form">
                <input type="hidden" id="resetToken" value="<?php echo $token; ?>">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label for="conform_password">Confirm Password</label>
                    <input type="password" id="conform_password" placeholder="Re-enter your password" required>
                </div>
                
                <button type="submit" id="resetPasswordBtn" class="auth-button">Create</button>
                
                <div class="auth-info">
                    <p><b style="color:var(--accent-clr)">Note: </b>This password will be your key to logging in – keep it secure and memorable.</p>
                </div>
            </div>
            
            <p class="auth-switch">
                Remember your password? <a href="/chain-fortune/auth/login">Sign In</a>
            </p>
        </div>
    </div>
</body>
<script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
<script src="/chain-fortune/js/toastify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/chain-fortune/js/sweetalert.min.js"></script>
<script>
    $('#resetPasswordBtn').on('click', function () {
        const password = $('#password').val().trim();
        const confirmPassword = $('#conform_password').val().trim();
        const token = $('#resetToken').val();
        if (password === '' || confirmPassword === '') {
            showToast('error', 'Please fill in all fields.');
            return;
        }
        if (password !== confirmPassword) {
            showToast('error', 'Passwords do not match.');
            return;
        }
        $.ajax({
            url: '/chain-fortune/action/password_reset_logic',
            type: 'POST',
            data: {
                new_password: password,
                token: token
            },
            success: function (response) {
                const data = response;
                if (data.status === 'success') {
                    showToast('success', data.message);
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Reset Successful',
                            text: data.message,
                            background: '#1e1e1e',
                            color: '#ffffff',
                            confirmButtonColor: '#4caf50',
                            customClass: {
                                popup: 'swal2-dark-popup'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect;
                            }
                        });
                } else {
                    showToast('error', data.message);
                }
            },
            error: function () {
                showToast('error', 'An error occurred. Please try again.');
            }
        });
    });
    
</script>
</html>






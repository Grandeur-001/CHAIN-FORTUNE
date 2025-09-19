<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        die( <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>
                        *{
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                        :root {
                            --base-clr: #11121a;
                            --black-clr: #07070a;
                            --line-clr: #42434a;
                            --hover-clr: #222533;
                            --text-clr: #e6e6ef;
                            --accent-clr: #5e63ff;
                            --secondary-text-clr: #b0b3c1;
                            --negative-text-clr: #ff004a;
                            --positive-text-clr: #10B981;
                            --pending-text-clr: rgb(255, 255, 0);
                            --info-clr: rgb(0, 145, 255);

                            --negative-bg-clr: rgba(231, 76, 60, 0.15);
                            --positive-bg-clr: rgba(46, 204, 113, 0.15); 
                            --pending-bg-clr: rgba(255, 255, 0, 0.15); 

                            --input-focus-clr: rgba(94, 99, 255, 0.1);
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
                            icon: 'info',
                            title: 'Page Not Ready',
                            text: 'You must be logged out to continue with this page',
                            background: 'var(--hover-clr)',
                            color: '#ffffff',
                            showCancelButton: true,
                            confirmButtonText: 'Logout',
                            cancelButtonText: 'Back to dashboard',
                            cancelButtonColor: 'var(--info-clr)',
                            allowEscapeKey: false,
                            allowOutsideClick: false

                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you really want to log out?",
                                    icon: 'warning',
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    showCancelButton: true,
                                    confirmButtonColor: 'var(--negative-text-clr)',
                                    cancelButtonColor: 'var(--accent-clr)',
                                    confirmButtonText: 'Yes, log me out',
                                    cancelButtonText: 'Cancel',
                                    allowEscapeKey: false,
                                    allowOutsideClick: false,
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch('/chain-fortune/action/logout', {
                                            method: 'POST',
                                            credentials: 'same-origin'
                                        })
                                        .then(response => response.json())
                                        .then(response => {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Logout Successful',
                                                text: response.message,
                                                allowOutsideClick: false,
                                                background: 'var(--hover-clr)',
                                                color: '#ffffff',
                                                confirmButtonColor: '#4caf50',
                                                customClass: {
                                                    popup: 'swal2-dark-popup'
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = '/chain-fortune/auth/forgot_password';
                                                }
                                            });
                                        })
                                        .catch(error => {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Logout Failed',
                                                text: 'Something went wrong. Please try again.',
                                                background: '#1e1e1e',
                                                color: '#ffffff',
                                                confirmButtonColor: '#ff4d4d'
                                            });
                                        });
                                    }
                                    else if (result.isDismissed) {
                                        window.location.href = '/chain-fortune/page/home';
                                    }
                                });
                            }
                            else if (result.isDismissed) {
                                window.location.href = '/chain-fortune/page/home';
                            }
                        })
                        
                    </script>
                </body>
            </html>
        HTML );
        exit();
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
                <h1>Forgot Password?</h1>
                <p>Enter your email address below</p>
            </div>
            
            <div class="auth-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email" required>
                </div>
                
                <button type="submit" class="auth-button" id="sendResetLinkBtn">Send Reset Link</button>
                
                <div class="auth-info">
                    <p>We'll send you an email with a link to reset your password.</p>
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
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<script>
    $('#sendResetLinkBtn').on('click', function () {
        let email = $('#email').val().trim();
        if (email === '') {
            showToast('error', 'Please enter your email address.');
            return;
        }
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }
        if (!validateEmail(email)) {
            showToast('error', 'Please enter a valid email address.');
            return;
        } 
        $('#sendResetLinkBtn').prop('disabled', true);
        $('#email').prop('disabled', true);
        Swal.fire({
            title: 'Please wait...',
            text: 'Processing your request',
            allowOutsideClick: false,
            showConfirmButton: false,
            background: 'var(--hover-clr)',
            color: '#ffffff',
            customClass: {
                popup: 'swal2-dark-popup'
            },
            didOpen: () => {
                Swal.showLoading();
            }
        });
        setTimeout(() => {
            $.ajax({
                url: '/chain-fortune/action/forgot_password_logic',
                type: 'POST',
                data: { email: email },
                success: function (response) {
                    $('#email').val('');
                    $('#email').prop('disabled', false);
                    $('#sendResetLinkBtn').prop('disabled', false);
                    const data = response;
                    if (data.status === 'success') {
                        showToast('success', data.message);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            background: 'var(--hover-clr)',
                            color: '#ffffff',
                            confirmButtonColor: 'var(--positive-text-clr)',
                            customClass: {
                                popup: 'swal2-dark-popup'
                            }
                        })
                    } else {
                        showToast('error', data.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            background: 'var(--hover-clr)',
                            color: '#ffffff',
                            confirmButtonColor: 'var(--negative-text-clr)',
                            customClass: {
                                popup: 'swal2-dark-popup'
                            }
                        });
                    }
                },
                error: function () {
                    showToast('error', 'An error occurred. Please try again.');
                }
            });
        }, 2000);

    });
</script>
</html>
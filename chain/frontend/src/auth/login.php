<?php 
    // include("../../../backend/section_handler.php");
    include ("../../../backend/login_logic.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Chain Fortune</title>
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
    <link rel="stylesheet" href="/chain-fortune/styles/config/config.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>


    <style>
        *{
            font-family: var(--index-font);
        }
    </style>

</head>


<?php
    include ("../components/toastify.php");
    include ("../components/page_refresh_loader.php");
?>


<body id="auth_bg">
    <div class="container">
        <div class="welcome-text">
            <img src="/chain-fortune/images/sign-in-illustration.png" width="700" style="transform: translateY(-200px);" alt="">
        </div>
        <div class="auth-container">
            <div class="auth-header">
                <div>
                    <img onclick="location.href=`/chain-fortune/page/home`" src="/chain-fortune/images/logo/logo_2.png" width="70" style="margin-top: 10px; cursor: pointer;" alt="">
                </div>
                <h1>Welcome Back</h1>
                <p>Sign in to continue</p>
            </div>
            
            <form class="auth-form" id="loginForm" action="" method="POST">
                <?php if (!empty($GLOBALS['ERROR']) || !empty($GLOBALS['SUCCESS'])): ?> 
                    <script>
                         document.addEventListener("DOMContentLoaded", () => {
                            <?php if (!empty($GLOBALS['ERROR'])): ?>
                                showToast('error', <?= json_encode($GLOBALS['ERROR']) ?>);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'An Error Occurred',
                                    text: <?= json_encode($GLOBALS['ERROR']) ?>,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: 'var(--negative-text-clr)',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                    <?php 
                        unset($GLOBALS['SUCCESS'], $GLOBALS['ERROR']); 
                    ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input required type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input required type="password" id="password" name="password" placeholder="Enter your password" >
                    <span id="eye_icon" style="position: absolute; top:40%; right:20px; cursor:pointer;">
                        <img src="/chain-fortune/images/svg/eye-off-svgrepo-com.svg" id="hide_password" alt="" style="display:flex;">
                        <img src="/chain-fortune/images/svg/eye-svgrepo-com.svg" id="show_password" alt="" style="display:none;">
                    </span>
                    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
                    <script src="/chain-fortune/js/toggle_password_visibility.js"></script>
                    <a href="/chain-fortune/auth/forgot_password" class="forgot-password">Forgot Password?</a>
                </div>
                
                <button required type="submit" name="signin_btn" id="signInBtn" class="auth-button">Sign In</button>
                
                <div class="social-auth">
                    <div class="divider">
                        <span>or continue with</span>
                    </div>
                    <div class="social-buttons">
                        <button type="button" class="social-button">
                            <img src="/chain-fortune/images/pngwing.com.png" alt="Google">
                            <span>Google</span>
                        </button>
                    </div>
                </div>
            </form>
            
            <p class="auth-switch">
                Don't have an account? <a href="/chain-fortune/auth/signup">Sign Up</a>
            </p>
        </div>
    </div>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#loginForm').on('submit', function () {
            Swal.fire({
                title: 'Please wait...',
                text: 'Processing your request',
                allowOutsideClick: false,
                showConfirmButton: false,
                background: 'var(--hover-clr)',
                color: '#ffffff',
                didOpen: () => {
                Swal.showLoading();
                }
            });
        });
    </script>
</body>

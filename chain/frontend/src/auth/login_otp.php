

<?php
    session_start();
    if (isset($_SESSION['pending_login_email'], $_SESSION['pending_login_email_time']) && time() - $_SESSION['pending_login_email_time'] <= 60) {
        $email = htmlspecialchars($_SESSION['pending_login_email']);
    } else{
        unset($_SESSION['pending_login_email'], $_SESSION['pending_login_email_time']);
    };



    if (!isset($_SESSION['pending_login_email'])) {
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
                            icon: 'warning',
                            title: 'Invalid Request',
                            text: 'No OTP request found!',
                            background: '#1e1e1e',
                            confirmButtonColor: '#4caf50',
                            color: '#ffffff',
                            confirmButtonText: 'Login',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/chain-fortune/auth/login';
                            }
                        });
                    </script>
                </body>
            </html>
        HTML);
        exit();
    }
?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Verification Code - Chain Fortune</title>
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
    <div class="container" style="justify-content: center;">
        <div class="auth-container">
            <div class="auth-header">
                <div>
                    <img onclick="location.href=`/chain-fortune/page/home`" src="/chain-fortune/images/logo/logo_2.png" width="70" style="margin-top: 10px; cursor: pointer;" alt="">
                </div>
                <h1>Enter OTP</h1>
                <p> We've sent a verification code to your email address. Please enter it below.</p>
            </div>
            
            <div class="auth-form" method="POST" action="" id="verifyForm" novalidate>
                <div class="form-group">
                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                        <input type="hidden" id="email" value="<?= $email ?>">
                        <input type="text" class="form-control" style="width: 3rem; text-align: center;" maxlength="1" required>
                        <input type="text" class="form-control" style="width: 3rem; text-align: center;" maxlength="1" required>
                        <input type="text" class="form-control" style="width: 3rem; text-align: center;" maxlength="1" required>
                        <input type="text" class="form-control" style="width: 3rem; text-align: center;" maxlength="1" required>
                        <input type="text" class="form-control" style="width: 3rem; text-align: center;" maxlength="1" required>
                        <input type="text" class="form-control" style="width: 3rem; text-align: center;" maxlength="1" required>
                    </div>
                </div>
                <button name="verify_btn" id="verifyBtn" type="button" class="verifyBtn auth-button">Verify OTP</button>
            </div>
            
            <p class="auth-switch">
                Didn't receive the code? <button class="resend-btn" style="border:none; outline:none; background:transparent; color:var(--accent-clr); cursor: pointer;" id="resend_otp_btn">Resend</button>
            </p>
        </div>
    </div>
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script>

        const inputs = document.querySelectorAll('input[type="text"]');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                const allFilled = Array.from(inputs).every(inp => inp.value.length === 1);
                if (allFilled) {
                    inputs.forEach(inp => inp.disabled = true);
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });


        $('.verifyBtn').on('click', function () {
            let otp = '';
            inputs.forEach(input => {
                otp += input.value;
            });

            if (otp.length !== 6) {
                alert("Please enter the complete 6-digit OTP.");
                return;
            }

            const email = $('#email').val(); 
            $('#verifyBtn').prop('disabled', true).text('Verifying...');
            Swal.fire({
                title: 'Please wait...',
                text: 'Processing your request',
                allowOutsideClick: false,
                allowEscapeKey: false,
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
                    type: 'POST',
                    url: '/chain-fortune/action/verify_login_otp',
                    data: {
                        otp: otp,
                        email: email
                    },
                    dataType: 'json',
                    success: function(response) {
                        inputs.forEach(input => {
                            input.value = '';
                            input.disabled = false;
                        });
                        const data = response;
                        if (data.status === 'success') {
                            showToast('success', data.message);
                            Swal.fire({
                                icon: 'success',
                                title: 'Email Verified',
                                text: data.message,
                                background: 'var(--hover-clr)',
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                                background: 'var(--hover-clr)',
                                color: '#ffffff',
                                confirmButtonColor: '#4caf50',
                                customClass: {
                                    popup: 'swal2-dark-popup'
                                }
                            });
                            setTimeout(() => {
                                inputs.forEach(input => {
                                    input.value = '';
                                    input.disabled = false;
                                });
                                $('#verifyBtn').prop('disabled', false).text('Verify');
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        showToast('error', 'Server error. Please try again.');
                        $('#verifyBtn').prop('disabled', false).text('Verify');
                    }
                });
            }, 2000);
            
        });

        $('#resend_otp_btn').on('click', function () {
            const email = $('#email').val(); 
            Swal.fire({
                title: 'Please wait...',
                text: 'Processing your request',
                allowOutsideClick: false,
                showConfirmButton: false,
                allowEscapeKey: false,
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
                    type: 'POST',
                    url: '/chain-fortune/action/resend_otp_logic',
                    data: {
                        email: email
                    },
                    dataType: 'json',
                    success: function(response) {
                        const data = response;
                        if (data.status === 'success') {
                            showToast('success', data.message);
                            Swal.fire({
                                icon: 'success',
                                title: 'OTP Resent',
                                text: data.message,
                                background: '#1e1e1e',
                                color: '#ffffff',
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK',
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
                            Swal.fire({
                                icon: 'error',  
                                title: 'Error',
                                text: data.message,
                                background: '#1e1e1e',
                                color: '#ffffff',
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK',
                                customClass: {
                                    popup: 'swal2-dark-popup'
                                }
                            })
                        }
                    },
                });
            }, 2000);
            
        });
    </script>
</body>
</html>

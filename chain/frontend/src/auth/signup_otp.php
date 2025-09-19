

<?php
    session_start();
    if (isset($_SESSION['pending_signup_email'], $_SESSION['pending_signup_email_time']) && time() - $_SESSION['pending_signup_email_time'] <= 60) {
        $email = htmlspecialchars($_SESSION['pending_signup_email']);
    } else{
        unset($_SESSION['pending_signup_email'], $_SESSION['pending_signup_email_time']);
    };



    if (!isset($_SESSION['pending_signup_email'])) {
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
                            text: 'Not a valid request. Please signup to continue.',
                            background: '#1e1e1e',
                            confirmButtonColor: '#4caf50',
                            color: '#ffffff',
                            confirmButtonText: 'Signup',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/chain-fortune/auth/signup';
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
                <h1>Verify Email</h1>
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
                <button name="verify_btn" id="verifyBtn" type="button" class="verifyBtn auth-button">Verify</button>
            </div>
            
            <p class="auth-switch">
                Didn't receive the code? <a href="verify_email.php">Resend</a>
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

        $('#verifyBtn').on('click', function () {
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
                    url: '/chain-fortune/action/verify_signup_otp',
                    data: {
                        otp: otp,
                        email: email
                    },
                    dataType: 'json',
                    success: function(response) {
                        const data = response;
                        if (data.status === 'success') {
                            showToast('success', data.message);
                            Swal.fire({
                                icon: 'success',
                                title: 'Email Verified',
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
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", status, error);
                        console.log("Server response:", xhr.responseText);
                        Swal.close();
                        showToast('error', 'An unexpected error occurred.');
                        $('#verifyBtn').prop('disabled', false).text('Verify');
                    }
                });
            }, 2000);
        });


    </script>
</body>
</html>

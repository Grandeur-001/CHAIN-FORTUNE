
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Chain Fortune</title>
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <link rel="stylesheet" href="/chain-fortune../styles/style.css">
    <link rel="stylesheet" href="../styles/config/config.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>


    <style>
        *{
            font-family: var(--index-font);
        }

         .password-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            display: none;
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .password-card {
            background: var(--black-clr);
            border: 1px solid var(--line-clr);
            border-radius: 16px;
            width: 100%;
            max-width: 450px;
            margin: auto;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease-out;
            min-height: fit-content;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--line-clr);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header h3 {
            color: var(--text-clr);
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-header i {
            color: var(--accent-clr);
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .password-input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .password-input {
            width: 100%;
            padding: 12px 16px;
            background: var(--base-clr);
            border: 2px solid var(--line-clr);
            border-radius: 8px;
            color: var(--text-clr);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .password-input:focus {
            outline: none;
            border-color: var(--accent-clr);
            background: var(--input-focus-clr);
        }

        .password-input.weak {
            border-color: var(--negative-text-clr);
            background: var(--negative-bg-clr);
        }

        .password-input.strong {
            border-color: var(--positive-text-clr);
            background: var(--positive-bg-clr);
        }

        .generator-dropdown {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 8px;
            margin-top: 8px;
            overflow: hidden;
            max-height: 0;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .generator-dropdown.active {
            max-height: 400px;
            opacity: 1;
        }

        .generator-content {
            padding: 1rem;
        }

        .generator-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .option-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .option-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent-clr);
        }

        .option-group label {
            color: var(--secondary-text-clr);
            font-size: 14px;
            cursor: pointer;
        }

        .length-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .length-group label {
            color: var(--secondary-text-clr);
            font-size: 14px;
            min-width: 60px;
        }

        .length-input {
            flex: 1;
            padding: 8px 12px;
            background: var(--hover-clr);
            border: 1px solid var(--line-clr);
            border-radius: 6px;
            color: var(--text-clr);
            font-size: 14px;
        }

        .generated-password {
            background: var(--hover-clr);
            border: 1px solid var(--line-clr);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 1rem;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            color: var(--text-clr);
            min-height: 44px;
            display: flex;
            align-items: center;
        }

        .generator-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
            min-width: 80px;
        }

        .btn-primary {
            background: var(--accent-clr);
            color: white;
        }

        .btn-primary:hover {
            background: #4c51e6;
        }

        .btn-secondary {
            background: var(--hover-clr);
            color: var(--text-clr);
            border: 1px solid var(--line-clr);
        }

        .btn-secondary:hover {
            background: var(--line-clr);
        }

        .btn-success {
            background: var(--positive-text-clr);
            color: white;
        }

        .btn-success:hover {
            background: #0d9668;
        }

        .strength-indicator {
            margin: 1rem 0;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--line-clr);
            background: var(--base-clr);
        }

        .strength-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .strength-weak {
            color: var(--negative-text-clr);
        }

        .strength-medium {
            color: var(--pending-text-clr);
        }

        .strength-strong {
            color: var(--positive-text-clr);
        }

        .strength-requirements {
            font-size: 12px;
            color: var(--secondary-text-clr);
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }

        .requirement.met {
            color: var(--positive-text-clr);
        }

        .requirement.unmet {
            color: var(--negative-text-clr);
        }

        .card-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--line-clr);
            display: flex;
            justify-content: flex-end;
        }

        .btn-ok {
            padding: 12px 24px;
            background: var(--accent-clr);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            opacity: 0.5;
            pointer-events: none;
        }

        .btn-ok.enabled {
            opacity: 1;
            pointer-events: auto;
        }

        .btn-ok.enabled:hover {
            background: #4c51e6;
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .password-card {
                margin: 10px auto;
                max-width: calc(100vw - 20px);
            }
            
            .generator-options {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            
            .generator-actions {
                flex-direction: column;
            }
            
            .btn {
                flex: none;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            
            
            .card-header,
            .card-body,
            .card-footer {
                padding: 1rem;
            }
            
            .password-overlay {
                padding: 10px;
            }
        }

        @media (max-width: 320px) {
           
            
            .card-header,
            .card-body,
            .card-footer {
                padding: 0.75rem;
            }
            
            .form-input,
            .password-input {
                font-size: 14px;
                padding: 10px 12px;
            }
            
            .btn {
                padding: 10px 12px;
                font-size: 13px;
            }
        }

        @media (max-height: 600px) {
            .password-overlay {
                align-items: flex-start;
                padding-top: 10px;
            }
            
            .password-card {
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<?php
    include ("../components/toastify.php");
    include ("../components/page_refresh_loader.php");
?>
<body id="auth_bg">
    <div class="container">
        <div class="welcome-text">
            <img src="/chain-fortune/images/svg/undraw_mobile_login_re_9ntv.svg" width="700" style="transform: translateY(-200px);" alt="">
        </div>
        <div class="auth-container">
            <div class="auth-header">
                <div>
                    <img onclick="location.href=`/chain-fortune/page/home`" src="/chain-fortune/images/logo/logo_5.png" width="70" style="margin-top: 10px; cursor: pointer;" alt="">
                </div>
                <h1>Create Account</h1>
                <p>Sign up to get started</p>
            </div>

            <div class="auth-form" id="signupForm" method="POST" action="">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Enter your first name">
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter your last name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" readonly style="cursor: pointer;">
                    <span id="eye_icon" style="position:absolute; top:55%; right:20px; cursor:pointer;">
                        <img src="/chain-fortune/images/svg/eye-off-svgrepo-com.svg" id="hide_password" alt="" style="display:flex;">
                        <img src="/chain-fortune/images/svg/eye-svgrepo-com.svg" id="show_password" alt="" style="display:none;">
                    </span>
                    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
                    <script src="/chain-fortune/js/toggle_password_visibility.js"></script>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password">
                </div>

                <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="check-box">
                    <span class="checkbox-tile">
                        <span class="checkbox-icon"></span>
                    </span>
                    <span class="checkbox-label">
                        I agree to the <a href="/chain-fortune/page/term_condtions" class="terms-link">Terms and Conditions</a>
                    </span>
                </label>
                <input type="hidden" name="checkbox_info" id="checkbox-info">


                <button type="submit" id="signUpBtn" class="auth-button" name="signup_btn">Create Account</button>
                
                <div class="social-auth">
                    <div class="divider">
                        <span>or sign up with</span>
                    </div>
                    <div class="social-buttons">
                        <button type="button" class="social-button">
                            <img src="/chain-fortune/images/pngwing.com.png" alt="Google">
                            <span>Google</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <p class="auth-switch">
                Already have an account? <a href="/chain-fortune/auth/login" >Sign In</a>
            </p>
        </div>

        <!-- Password Generator Overlay -->
        <div class="password-overlay" id="passwordOverlay">
            <div class="password-card">
                <div class="card-header">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Secure Password Generator</h3>
                </div>
                
                <div class="card-body">
                    <div class="password-input-group">
                        <input type="text" id="passwordCardInput" class="password-input" placeholder="Enter or generate a secure password">
                        
                        <div class="generator-dropdown" id="generatorDropdown">
                            <div class="generator-content">
                                <div class="generator-options">
                                    <div class="option-group">
                                        <input type="checkbox" id="includeUppercase" checked>
                                        <label for="includeUppercase">Uppercase (A-Z)</label>
                                    </div>
                                    <div class="option-group">
                                        <input type="checkbox" id="includeLowercase" checked>
                                        <label for="includeLowercase">Lowercase (a-z)</label>
                                    </div>
                                    <div class="option-group">
                                        <input type="checkbox" id="includeNumbers" checked>
                                        <label for="includeNumbers">Numbers (0-9)</label>
                                    </div>
                                    <div class="option-group">
                                        <input type="checkbox" id="includeSymbols" checked>
                                        <label for="includeSymbols">Symbols (!@#$)</label>
                                    </div>
                                </div>
                                
                                <div class="length-group">
                                    <label for="passwordLength">Length:</label>
                                    <input type="number" id="passwordLength" class="length-input" value="12" min="8" max="50">
                                </div>
                                
                                <div class="generated-password" id="generatedPassword">
                                    Click "Generate" to create a secure password
                                </div>
                                
                                <div class="generator-actions">
                                    <button class="btn btn-primary" id="generateBtn">
                                        <i class="fas fa-sync-alt"></i>
                                        Generate
                                    </button>
                                    <button class="btn btn-secondary" id="copyBtn">
                                        <i class="fas fa-copy"></i>
                                        Copy
                                    </button>
                                    <button class="btn btn-success" id="useBtn">
                                        <i class="fas fa-check"></i>
                                        Use
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="strength-indicator">
                        <div class="strength-label" id="strengthLabel">
                            <i class="fas fa-exclamation-triangle strength-weak"></i>
                            <span>Password Strength: Weak</span>
                        </div>
                        <div class="strength-requirements">
                            <div class="requirement unmet" id="req-length">
                                <i class="fas fa-times"></i>
                                <span>At least 8 characters</span>
                            </div>
                            <div class="requirement unmet" id="req-uppercase">
                                <i class="fas fa-times"></i>
                                <span>At least one uppercase letter</span>
                            </div>
                            <div class="requirement unmet" id="req-lowercase">
                                <i class="fas fa-times"></i>
                                <span>At least one lowercase letter</span>
                            </div>
                            <div class="requirement unmet" id="req-number">
                                <i class="fas fa-times"></i>
                                <span>At least one number</span>
                            </div>
                            <div class="requirement unmet" id="req-special">
                                <i class="fas fa-times"></i>
                                <span>At least one special character</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button class="btn-ok" id="okBtn">
                        <i class="fas fa-check"></i>
                        OK
                    </button>
                </div>
            </div>
        </div>
        
    </div>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script>
        const checkBox = document.getElementById("check-box");
        const checkBoxInfo = document.getElementById("checkbox-info");

        window.onclick = function () { 
            if (checkBox.checked) {
                checkBoxInfo.value = "AGREED";
            }
            else if (!checkBox.checked) {
                checkBoxInfo.value = "DISAGREED";
            }
        } 
        
        $(document).ready(function() {
            let isPasswordStrong = false;
            let currentGeneratedPassword = '';

            $('#password').on('click', function() {
                $('#passwordOverlay').fadeIn(300);
                $('#passwordCardInput').focus();
            });

            $('#passwordCardInput').on('click', function() {
                $('#generatorDropdown').addClass('active');
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.password-input-group').length) {
                    $('#generatorDropdown').removeClass('active');
                }
            });

            function validatePassword(password) {
                const requirements = {
                    length: password.length >= 12,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
                };

                Object.keys(requirements).forEach(req => {
                    const element = $(`#req-${req}`);
                    if (requirements[req]) {
                        element.removeClass('unmet').addClass('met');
                        element.find('i').removeClass('fa-times').addClass('fa-check');
                    } else {
                        element.removeClass('met').addClass('unmet');
                        element.find('i').removeClass('fa-check').addClass('fa-times');
                    }
                });

                const metRequirements = Object.values(requirements).filter(Boolean).length;
                let strength = 'weak';
                let strengthClass = 'strength-weak';
                let strengthIcon = 'fa-exclamation-triangle';

                if (metRequirements >= 5) {
                    strength = 'strong';
                    strengthClass = 'strength-strong';
                    strengthIcon = 'fa-shield-alt';
                    isPasswordStrong = true;
                } else if (metRequirements >= 3) {
                    strength = 'medium';
                    strengthClass = 'strength-medium';
                    strengthIcon = 'fa-exclamation-circle';
                    isPasswordStrong = false;
                } else {
                    isPasswordStrong = false;
                }

                // Update strength indicator
                $('#strengthLabel').html(`
                    <i class="fas ${strengthIcon} ${strengthClass}"></i>
                    <span>Password Strength: ${strength.charAt(0).toUpperCase() + strength.slice(1)}</span>
                `);

                const input = $('#passwordCardInput');
                input.removeClass('weak strong');
                if (isPasswordStrong) {
                    input.addClass('strong');
                } else if (password.length > 0) {
                    input.addClass('weak');
                }

                const okBtn = $('#okBtn');
                if (isPasswordStrong) {
                    okBtn.addClass('enabled');
                } else {
                    okBtn.removeClass('enabled');
                }

                return isPasswordStrong;
            }

            $('#passwordCardInput').on('input', function() {
                validatePassword($(this).val());
            });

            function generatePassword() {
                const length = parseInt($('#passwordLength').val());
                const includeUppercase = $('#includeUppercase').is(':checked');
                const includeLowercase = $('#includeLowercase').is(':checked');
                const includeNumbers = $('#includeNumbers').is(':checked');
                const includeSymbols = $('#includeSymbols').is(':checked');

                let charset = '';
                if (includeUppercase) charset += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                if (includeLowercase) charset += 'abcdefghijklmnopqrstuvwxyz';
                if (includeNumbers) charset += '0123456789';
                if (includeSymbols) charset += '!@#$%^&*()_+-=[]{}|;:,.<>?';

                if (charset === '') {
                    window.alert('Please select at least one character type!');
                    return '';
                }

                let password = '';
                
                if (includeUppercase) password += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[Math.floor(Math.random() * 26)];
                if (includeLowercase) password += 'abcdefghijklmnopqrstuvwxyz'[Math.floor(Math.random() * 26)];
                if (includeNumbers) password += '0123456789'[Math.floor(Math.random() * 10)];
                if (includeSymbols) password += '!@#$%^&*()_+-=[]{}|;:,.<>?'[Math.floor(Math.random() * 32)];

                for (let i = password.length; i < length; i++) {
                    password += charset[Math.floor(Math.random() * charset.length)];
                }

                password = password.split('').sort(() => Math.random() - 0.5).join('');
                
                return password;
            }

            $('#generateBtn').on('click', function() {
                const password = generatePassword();
                if (password) {
                    currentGeneratedPassword = password;
                    $('#generatedPassword').text(password);
                }
            });

            $('#copyBtn').on('click', function() {
                const password = $('#generatedPassword').text();
                if (password && password !== 'Click "Generate" to create a secure password') {
                    navigator.clipboard.writeText(password).then(() => {
                        showToast('info','Password copied to clipboard!');
                    }).catch(() => {
                        const textArea = document.createElement('textarea');
                        textArea.value = password;
                        document.body.appendChild(textArea);
                        textArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                        showToast('info','Password copied to clipboard!');
                    });
                } else {
                    showToast('info','Please generate a password first!');
                }
            });

            $('#useBtn').on('click', function() {
                const password = $('#generatedPassword').text();
                if (password && password !== 'Click "Generate" to create a secure password') {
                    $('#passwordCardInput').val(password);
                    validatePassword(password);
                } else {
                    showToast('info','Please generate a password first!');
                }
            });

            $('#okBtn').on('click', function() {
                if (isPasswordStrong) {
                    const password = $('#passwordCardInput').val();
                    $('#password').val(password);
                    $('#confirm-password').val(password);
                    $('#passwordOverlay').fadeOut(300);
                    
                    setTimeout(() => {
                        $('#passwordCardInput').val('');
                        $('#generatedPassword').text('Click "Generate" to create a secure password');
                        validatePassword('');
                        $('#generatorDropdown').removeClass('active');
                    }, 300);
                }
            });

            $('.password-card').on('click', function(e) {
                e.stopPropagation();
            });

            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && isPasswordStrong) {
                    $('#okBtn').click();
                }
            });

            validatePassword('');

            setTimeout(() => {
                if ($('#generatedPassword').text() === 'Click "Generate" to create a secure password') {
                    $('#generateBtn').click();
                }
            }, 500);
        });

        $('#signUpBtn').on('click', function () {

            function validateEmail(email) {
                var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                return emailRegex.test(email);
            }
            function validatePassword(password) {
                const lengthRegex = /^.{12,}$/; 
                const uppercaseRegex = /[A-Z]/; 
                const lowercaseRegex = /[a-z]/; 
                const numberRegex = /[0-9]/; 
                const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/; 
                const forbiddenSequencesRegex = /(123|abc|password|qwerty|letmein)/i; 

                if (!lengthRegex.test(password)) {
                    return 'Password must be at least 12 characters long.';
                }
                if (!uppercaseRegex.test(password)) {
                    return 'Password must contain at least one uppercase letter.';
                }
                if (!lowercaseRegex.test(password)) {
                    return 'Password must contain at least one lowercase letter.';
                }
                if (!numberRegex.test(password)) {
                    return 'Password must contain at least one number.';
                }
                if (!specialCharRegex.test(password)) {
                    return 'Password must contain at least one special character.';
                }
                if (forbiddenSequencesRegex.test(password)) {
                    return 'Password cannot contain common sequences like "123", "abc", "password", etc.';
                }

                return 'valid';
            }

            const firstname = $('#firstname').val().trim();
            const lastname = $('#lastname').val().trim();
            const email = $('#email').val().trim();
            const password = $('#password').val().trim();
            const confirmPassword = $('#confirm-password').val().trim();
            const checkBoxInfo = $('#checkbox-info').val().trim();
            const passwordValidationMessage = validatePassword(password);





            if (!firstname || !lastname || !email || !password || !confirmPassword) {
                showToast('error', 'All fields are required');
            }else if(!validateEmail(email)){
                showToast('error', 'Invalid email address');
                return false;
            }else if (passwordValidationMessage !== 'valid') {
                showToast('error', passwordValidationMessage);
            } else if (password !== confirmPassword) {
                showToast('error', 'Passwords do not match');
            }else if(checkBoxInfo === 'DISAGREED'){
                showToast('error', 'You must agree to the terms and conditions');
            }else{
                Swal.fire({
                    title: 'Please wait...',
                    text: 'Processing your request',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    background: 'var(--hover-clr)',
                    color: '#ffffff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                setTimeout(() => {
                    $.ajax({
                        url: '/chain-fortune/action/signup_logic',
                        method: 'POST',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            password: password,
                            confirm_password: confirmPassword,
                            checkbox_info: checkBoxInfo
                        },
                        dataType: 'json',
                        success: function(response) {
                            const data = response;
                            if (data.status === 'success') {
                                window.location.href = response.redirect;
                            } else {
                                showToast('error', data.message);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            console.error("Server Response:", xhr.responseText);
                            showToast('error', 'Server error. Please try again.');
                        }
                    });
                }, 2000);
            }
        });

    </script>
</body>
</html>
 
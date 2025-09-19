<?php
    include("../../../backend/section_handler.php");
    include("../../../backend/profile_logic.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[0]
            sideBarItem.classList.add("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[1];
            navItem.classList.add("active");
        });
    </script>


    <style>
       
        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;

        }
        .app-container {
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            text-align: center;
            padding: 32px 0;
            position: relative;
        }

        .profile-picture_section {
            margin-bottom: 16px;
        }

        .profile_photo {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            border: 1.3px solid var(--accent-clr);
            box-shadow: 0 0 0 7px var(--input-focus-clr);
            position: relative;

        }
        .profile_photo::after{
            background: url(/chain-fortune/images/VIEW.png);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 50%;
            content: "";
            height: 100%;
            width: 100%;
            position: absolute;
            transition: all 0.2s ease;
            right: 0;
            left: 0;
            bottom: 0;
            top: 0;
            transform: scale(0);
            visibility: hidden;
            overflow: hidden;
        }
        .profile_photo:hover::after{
            visibility: visible;
            transform: scale(1);

        }

        .avatar span {
            margin: 0 2px;
        }
        .open-profile-modal{
            transform: translateX(60px) translateY(40px);
            position: absolute;
            background: var(--accent-clr);
            border-radius: 50%;
            display: grid;
            place-content: center;
            place-items: center;
            padding: 10px;
            cursor: pointer;
            border: none;
            outline: none;
            z-index: 2;
        }

        .button {
            background-color: var(--accent-clr);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .button:active {
            transform: scale(0.98);
            background-color: var(--hover-clr);
        }
        @media (hover: hover) {
            .button:hover:not([disabled]) {
                background-color: var(--hover-clr);
            }

            #closePopup:hover {
                color: var(--text-clr);
            }
        }
        
        .popup {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: rgba(17, 18, 26, 0.8);    
            backdrop-filter: blur(8px); 
            align-items: center;
            justify-content: center;
            transition: all 0.6s ease;
            visibility: hidden;
            opacity: 0;
        }
        .popup-inner {
            background-color: var(--base-clr);
            width: 90%;
            max-width: 480px;
            border-radius: 20px;
            border: 1px solid var(--line-clr);
        }

        @keyframes bounce-in {
            from,
            20%,
            40%,
            60%,
            80%,
            to {
                -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }

            0% {
                opacity: 0;
                -webkit-transform: scale3d(0.3, 0.3, 0.3);
                transform: scale3d(0.3, 0.3, 0.3);
            }

            20% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }

            40% {
                -webkit-transform: scale3d(0.9, 0.9, 0.9);
                transform: scale3d(0.9, 0.9, 0.9);
            }

            60% {
                opacity: 1;
                -webkit-transform: scale3d(1.03, 1.03, 1.03);
                transform: scale3d(1.03, 1.03, 1.03);
            }

            80% {
                -webkit-transform: scale3d(0.97, 0.97, 0.97);
                transform: scale3d(0.97, 0.97, 0.97);
            }

            to {
                opacity: 1;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
            }
        }



        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 16px;
            background-color: var(--base-clr);
            border-bottom: 1px solid var(--line-clr);
        }

        .popup-header h2 {
            font-size: 1.25rem;
        }


        .popup-content form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px;
            gap: 24px;
        }

        #imagePreview {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: var(--hover-clr);
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--secondary-text-clr);
            font-size: 0.875rem;
            border: 2px dashed var(--line-clr);
            overflow: hidden;
        }

        #imagePreview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #fileInput {
            display: none;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 280px;
        }

        .button-group .button {
            margin: 0;
        }

        #close-profile-modal {
            background-color: var(--hover-clr);
            color: white;
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-align: center;
            &:hover{
                background-color: var(--accent-clr);

            }
        }

        #closePopup:active {
            color: var(--text-clr);
        }

        .button[disabled] {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: var(--line-clr);
        }












        .profile-header h1 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .profile-header .email {
            color: var(--secondary-text-clr);
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 4px;
        }

        .profile-header .location {
            color: var(--secondary-text-clr);
            font-size: 14px;
        }


                
        .fullscreen-preview {
            background-color: rgba(17, 18, 26, 0.8);    
            backdrop-filter: blur(8px); 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1rem;
            z-index: 300;
        }

        .fullscreen-preview.active {
            opacity: 1;
            visibility: visible;
        }


        .preview-content {
            position: relative;
            transform: scale(0.2);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);

        }

        .fullscreen-preview.active .preview-content {
            transform: scale(0.7);
        }

        .preview-content img {
            max-width: 100%;
            border-radius: 8px;
            object-fit: contain;
        }

        .close-preview {
            position: absolute;
            top: -57px;  
            right: -57px;    
            width: 56px;
            height: 56px;
            border: none;
            background: var(--accent-clr);
            color: var(--text-clr);
            border-radius: 50%;
            cursor: pointer;
            font-size: 40px;
            justify-content: center;
            transition: background-color 0.3s ease;
            display: none;
        }





        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            padding: 24px 0;
            border-bottom: 1px solid var(--line-clr);
            margin-bottom: 24px;
        }

        .action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-clr);
            padding: 12px;
            border-radius: 12px;
            transition: background-color 0.2s;
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .action-item:hover {
            background-color: var(--hover-clr);
        }

        .action-item .icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .action-item span:last-child {
            font-size: 12px;
            color: var(--secondary-text-clr);
        }

        .profile-section {
            border: 1px solid var(--line-clr);
            /* background: var(--hover-clr); */
            border-radius: 7px;
            padding: 24px;
            margin-bottom: 24px;

            &:hover{
                /* border-color: var(--text-clr); */
            }
        }

        .profile-section h2 {
            font-size: 20px;
            margin-bottom: 24px;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            color: var(--secondary-text-clr);
        }

        .form-group input {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 12px;
            color: var(--text-clr);
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-clr);
        }

        .btn-primary {
            background-color: var(--accent-clr);
            color: var(--text-clr);
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100px;
            background: var(--base-clr);
        }

        .spinner {
            width: 3rem;
            height: 3rem;
            border: 3px solid var(--line-clr);
            border-top-color: var(--accent-clr);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }


        @media(max-width: 800px){
            #main{
                margin-left: 0;
            }

            @keyframes zoomIn {
                from {
                    transform: scale(0.95);
                    opacity: 0;
                }
                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }
            .popup-header h2 {
                font-size: 1rem;
            }

            #close-profile-modal {
                padding: 0.4rem 1.2rem;
                border-radius: 7px;
                font-size: 0.7rem;
            }

        }
        @media (max-width: 480px) {
            .profile-image-wrapper {
                width: 120px;
                height: 120px;
            }
            .close-preview {
                display: flex;
                scale: 0.77;
            }

        }

        @media (max-width: 320px) {
            .profile-image-wrapper {
                width: 100px;
                height: 100px;
            }
        }

    </style>
</head>


<body>
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <main class="main" id="main">
        <div class="app-container">
            <img src="" alt="">
            <div class="profile-header">
                <div class="profile-picture_section">
                    <div class="profile_photo">
                        <img src="/chain-fortune/img/<?php echo $profile_picture?>" style="object-fit: cover;" alt="Profile Picture" class="profile_photo" id="profile_img">
                        <button class="open-profile-modal" id="open-profile-modal">
                            <img src="/chain-fortune/images/svg/photocameraoutline_80020.svg" width="28" alt="">
                        </button>
                    </div>
                    <div id="profile-picture-modal" class="popup">
                        <div class="popup-inner">
                            <div class="popup-header">
                                <h2>Change Profile Picture</h2>
                                <div class="cancel" id="close-profile-modal">Cancel</div>
                            </div>
                            <div class="popup-content">
                                <form action="" method="POST" id="upload_form" enctype="multipart/form-data">
                                    <div id="imagePreview">
                                        <span>No image selected</span>
                                    </div>
                                    <div class="button-group">
                                        <label for="image_input" class="button">Choose Photo</label>
                                        <input type="file" name="image" id="image_input" accept=".jpg, .jpeg, .png" style="display: none;">
                                        <button type="submit" id="upload_button" name="upload_photo" disabled class="button" >Upload Photo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <h1><?php echo htmlspecialchars(strtoupper(sprintf('%s %s', $_SESSION['user_firstname'], $_SESSION['user_lastname']))); ?></h1>
                <h5 class="" id="user_id">ID: USR-<?php echo htmlspecialchars($user_id); ?></h5>
                <div class="fullscreen-preview close_preview">
                    <div class="preview-content">
                        <img class="close_preview" src="/chain-fortune/img/<?php echo $profile_picture?>" alt="Profile Preview" />
                        <button class="close-preview close_preview">&times;</button>
                    </div>
                </div>
            </div>

            

            <nav class="quick-actions">
                <button class="action-item">
                    <span class="icon">💰</span>
                    <span>Testify</span>
                </button>

                



                <button class="action-item">
                    <span class="icon">👛</span>
                    <span>Wallet</span>
                </button>
                <button class="action-item">
                    <span class="icon">⬇️</span>
                    <span>Receive</span>
                </button>
                <button class="action-item">
                    <span class="icon">⬆️</span>
                    <span>Send</span>
                </button>
            </nav>

            <!-- profile details section -->
            <section class="profile-section">
                <h2>Personal Details</h2>
                <?php
                    if (isset($_SESSION['update_message']) && isset($_SESSION['update_type'])) {
                        $update_message = htmlspecialchars($_SESSION['update_message'], ENT_QUOTES);
                        $update_type = $_SESSION['update_type'] === "success" ? "success" : "error";
                        $capitalized_type = ucfirst($update_type);
                        $confirmButtonColor = $_SESSION['update_type'] === "success" ? "var(--positive-text-clr)" : "var(--negative-text-clr)";
                        $redirectUrl = $_SESSION['redirect'];
                        $redirectText = $_SESSION['redirect_text'];

                        echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                    
                        echo(<<<HTML
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    showToast('$update_type', "$update_message");
                                    Swal.fire({
                                        icon: '$update_type',
                                        title: '$capitalized_type',
                                        text: "$update_message",
                                        showCancelButton: false,
                                        background: 'var(--hover-clr)',
                                        color: '#ffffff',
                                        confirmButtonColor: '$confirmButtonColor',
                                        confirmButtonText: '$redirectText',
                                        customClass: {
                                            popup: 'swal2-dark-popup'
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = '$redirectUrl';
                                        }
                                    });
                                });
                            </script>
                            HTML
                        );
                        unset($_SESSION['update_message']);
                        unset($_SESSION['update_type']);
                        unset($_SESSION['redirect']);
                        unset($_SESSION['redirect_text']);
                    } else {
                        echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                        echo(<<<HTML
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        showToast('info', "No updates available");
                                    });
                                </script>
                            HTML
                        );
                    }
                ?>


                <form class="profile-form" method="POST" action="">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($_SESSION['user_firstname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_SESSION['user_lastname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
                    </div>
                    <button type="submit" name="update_profile" class="btn-primary">Update Profile</button>
                </form>
            </section>
            <!-- profile details section end -->

            <!-- change password section -->
            <section class="profile-section">
                <h2>Change Password</h2>
               
                <form class="profile-form" method="POST" action="">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" name="change_password_btn" class="btn-primary">Change Password</button>
                </form>
            </section>
            <!-- change password section end -->
            
            
            
            
        </div>
    </main>
    


    
   



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>



    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script src="/chain-fortune/js/profile-picture-modal.js"></script>
    <script src="/chain-fortune/js/profile_picture_preview.js"></script>

</body>
</html>
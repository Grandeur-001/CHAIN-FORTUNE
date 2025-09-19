<?php
    include("../../../backend/section_handler.php");
    include("../../../backend/check_role.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Chain Fortune</title>
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
    <script src="/chain-fortune/js/toastify.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[14]
            sideBarItem.classList.add("active");
        });
    </script>
    <style>
     
        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;

        }
        .app_container {
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .add-user-btn {
            background-color: var(--base-clr);
            color: var(--text-clr);
            border: none;
            padding: 0.9rem 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            box-shadow: inset 0 0 0 1px var(--line-clr);
            display: flex;
            align-items: center;
            justify-content: center;
            
        }
        .add-user-btn:hover{
            background-color: var(--accent-clr);
            box-shadow: none;

        }

        .search-bar {
            margin-bottom: 2rem;
            width: 100%;
            position: relative;
        }

        .search-input {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .search-input:focus{
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }
        .search_icon{
            position: absolute;
            top: 23%;
            right: 20px;
            scale: 0.88;
            cursor: pointer;
        }
  
          
        .user-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            cursor:progress;
        }

        .user-table td {
            padding: 15px;
            border-bottom: 1px solid var(--line-clr);
            color: var(--secondary-text-clr);
            vertical-align: middle;
        }



        .user-table tr:hover td {
            background-color: var(--hover-clr);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile_photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
        .profile_photo:active{
            scale: 0.88;
        }


        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            color: var(--text-clr);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-id {
            color: lime;
            font-size: 0.575rem;
            padding: 3px 9px;
            border-radius: 4px;
            background: var(--positive-bg-clr);
        }

        .email {
            color: var(--secondary-text-clr);
            font-size: 0.875rem;
        }

        .location {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .balance {
            color: var(--amount-color);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
     
        }
        .status-badge.enabled {
            background-color: var(--positive-bg-clr);
            color: var(--positive-text-clr);
        }

        .status-badge.disabled {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }


        .action-button:hover {
            background-color: var(--hover-clr);
        }

        @media screen and (max-width: 768px) {

        }

        @media screen and (max-width: 320px) {
            .user-table tr {
                padding: 8px;
            }

            .status-badge {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .action-button {
                width: 32px;
                height: 32px;
            }
        }


        .btn-group {
            position: relative;
            border-radius: 50%;
        }



        
        .dropdown-toggle {
            background: var(--hover-clr);
            border-radius: 50%;
            border: none;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--secondary-text);
        }
        .user-table tr:hover .dropdown-toggle{
            background: var(--base-clr);
        }

        

        .action-dropdown-menu {
            position: absolute;
            right: 20%;
            top: 100%;
            background: var(--hover-clr);
            border-radius: 12px;
            padding: 8px 10px;
            margin-top: 8px;
            min-width: 180px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 200;
        
        }
        
        .action-dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            padding: 12px 16px;
            display: block;
            color: var(--secondary-text);
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease;
            border-radius: 10px;
            border: none;
            background: transparent;
            width: 100%;
            display: flex;
            cursor: pointer;
        
        }
        
        .dropdown-item:hover {
            background-color: var(--hover-color);
            color: var(--text-color);
        }


        .fullscreen-preview {
            /* background-color: rgba(17, 18, 26, 0.8);     */
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
            z-index: 500;
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












  

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.8rem;
            margin-top: 2rem;
        }

        .pagination button {
            padding: 0.5rem 1rem;
            background-color: var(--hover-clr);
            border: 1px solid var(--line-clr);
            color: var(--text-clr);
            cursor: pointer;
            border-radius: 4px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination button.active {
            background-color: var(--accent-clr);
            border-color: var(--accent-clr);
        }

        .pagination .prev-next {
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .arrow-icon {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        
        .action-modal.overlay {
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
            z-index: 400;
        }
        .action-modal-content {
            padding: 1rem;
            background-color: var(--hover-clr);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-modal-header {
            padding: 14px;
            border-bottom: 1px solid var(--line-clr);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-modal-title {
            color: var(--text-clr);
            margin: 0;
            font-size: 1.25rem;
        }

        .action-modal-close {
            background: transparent;            
            border: none;
            color: var(--secondary-text-clr);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
        }

        .action-modal-body {
            padding: 10px;
            color: var(--secondary-text-clr);
        }

        .action-modal-body strong {
            color: var(--text-clr);
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
        .action-modal-body input,
        .action-modal-body select,
        .action-modal-body textarea{
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 10px;
            margin-top: 5px;
        }
        .action-modal-body textarea{
            max-width: 100%;
            min-width: 100%;
            max-height: 200px;
            min-height: 200px;
        }
        .action-modal-body label{
            font-size: 13px;
            margin-left: 3px;
        }

        .action-modal-body input:focus,
        .action-modal-body select:focus,
        .action-modal-body textarea:focus{
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }


        .action-modal-footer {
            padding: 20px;
            border-top: 1px solid var(--line-clr);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-secondary {
            background-color: var(--base-clr);
            color: var(--text-clr);
        }

        .btn-primary {
            background-color: var(--accent-clr);
            color: var(--text-clr);
        }

        .btn:hover {
            opacity: 0.9;
        }


        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100px;
            background: var(--base-clr);
            width: 100%;
        }

        .spinner {
            width: 3rem;
            height: 3rem;
            margin: auto;
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



        @media (max-width: 950px) {
            .user-table, 
            .user-table tbody, 
            .user-table tr {
                display: block;
            }

            .user-table tr {
                margin-bottom: 15px;
                background-color: var(--base-clr);
                border-radius: 8px;
                padding: 12px 0;
            }

            .user-table td {
                display: flex;
                padding: 8px 9px;
                border-bottom: 1px solid var(--line-clr);
                align-items: center;
                justify-content: space-between;
            }

            .user-table td:before {
                content: attr(data-label);
                font-weight: 500;
                color: var(--text-clr);
                padding-right: 10px;
            }

            .user-table td:last-child {
                border-bottom: none;
            }

            .user-info {
                width: 100%;
                justify-content: space-between;

            }

            .action-button {
                margin-left: auto;
            }
            .user-table td:nth-of-type(1){
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;

            }
            .user-table td:nth-of-type(5){
                border-bottom-left-radius: 13px;
                border-bottom-right-radius: 13px;

            }

        }

        @media (max-width: 800px) {

            #main{
                margin-left: 0;
            }
 

        }

        @media (max-width: 576px) {
            .action-modal-content{
                scale: 0.88;
            }
            .container {
                margin: 1rem auto;
            }

            .header {
                gap: 1rem;
                align-items: flex-start;
            }

            .pagination {
                gap: 0.25rem;
            }

            .pagination button {
                padding: 0.5rem;
                min-width: 36px;
            }

        }
        @media (max-width: 480px) {
            .action-modal-content{
                scale: 0.77;
            }
            .close-preview {
                display: flex;
                scale: 0.77;
            }
            .action-modal-content {
                max-width: 100%;
            }

            .action-modal-title {
                font-size: 1.1rem;
            }

            .action-modal-body {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
            

        }

        @media (max-width: 320px) {
           
            .user-card {
                font-size: 0.875rem;
                padding: 0.75rem;
                gap: 0.75rem;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
            }
            .action-modal-content{
                scale: 0.87;
            }
            .action-modal-header,
            .action-modal-body,
            .action-modal-footer {
                padding: 15px;
            }

            .action-modal-footer {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>


<body>
    
    <?php include "../../../backend/fetch_user_info.php"; ?>
    <?php include "../../../backend/create_user.php"; ?>
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <?php include "../components/toastify.php"; ?>


    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app_container">
            <div class="header">
                <h1>User List</h1>
                <button class="add-user-btn" id="show-create-user" onclick="openCreateUser('create-user-modal')">
                    <svg style="margin-right: 4px;" fill="#e6e6ef" width="23px" height="23px" viewBox="64 64 896 896" focusable="false">
                        <path d="M678.3 642.4c24.2-13 51.9-20.4 81.4-20.4h.1c3 0 4.4-3.6 2.2-5.6a371.67 371.67 0 00-103.7-65.8c-.4-.2-.8-.3-1.2-.5C719.2 505 759.6 431.7 759.6 349c0-137-110.8-248-247.5-248S264.7 212 264.7 349c0 82.7 40.4 156 102.6 201.1-.4.2-.8.3-1.2.5-44.7 18.9-84.8 46-119.3 80.6a373.42 373.42 0 00-80.4 119.5A373.6 373.6 0 00137 888.8a8 8 0 008 8.2h59.9c4.3 0 7.9-3.5 8-7.8 2-77.2 32.9-149.5 87.6-204.3C357 628.2 432.2 597 512.2 597c56.7 0 111.1 15.7 158 45.1a8.1 8.1 0 008.1.3zM512.2 521c-45.8 0-88.9-17.9-121.4-50.4A171.2 171.2 0 01340.5 349c0-45.9 17.9-89.1 50.3-121.6S466.3 177 512.2 177s88.9 17.9 121.4 50.4A171.2 171.2 0 01683.9 349c0 45.9-17.9 89.1-50.3 121.6C601.1 503.1 558 521 512.2 521zM880 759h-84v-84c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v84h-84c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h84v84c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-84h84c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z"/>
                    </svg>
                    Create User
                </button>


                <div class="side-modal create-user-modal" id="create-user-modal">
                    <div class="side-modal-overlay">
                        <div class="side-modal-dialog">
                            <div class="side-modal-content">
                                <div class="side-modal-header">
                                    <div class="side-modal-title">
                                        <h5>Create New User</h5>
                                    </div>

                                    <div class="close-side-modal-btn close-side-modal">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="side-modal-body">
                                    <div class="side-modal-body-wrapper">
                                        <label for="new_firstname">First name*</label>
                                        <input id="new_firstname" name="firstname" type="text" placeholder="Enter first name" style="width: 100%;">
                                        
                                        <label for="new_lastname">Last name*</label>
                                        <input id="new_lastname" name="lastname" type="text" placeholder="Enter last name" style="width: 100%;">
                                        
                                        <label for="new_email">Email*</label>
                                        <input id="new_email" name="email" type="email" placeholder="Enter Email" style="width: 100%;">
                                        
                                        <label for="new_password">Password*</label>
                                        <input id="new_password" name="password" type="password" placeholder="Create a password" style="width: 100%;">
                                        
                                        <label for="new_confirm_password">Confirm Password*</label>
                                        <input id="new_confirm_password" name="confirm_password" type="password" placeholder="Re-enter Password" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="side-modal-footer">
                                    <div class="side-modal-footer-wrapper">
                                        <button class="btn btn-danger close-side-modal">Close</button>
                                        <button class="btn btn-primary create-user-btn" id="create-user-btn">Create user</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function openCreateUser(sectionId) {
                        const $section = $(`#${sectionId}`);
                        const $sideModalOverlay = $section.find('.side-modal-overlay');

                        if ($section.length === 0) return;

                        $section.css({
                            visibility: 'visible',
                        });

                        $(".side-modal-dialog").css({
                            transform: "translateX(0)",
                        });
                    };

                    $('.close-side-modal').on('click', function () {
                        $('.side-modal').each(function () {
                            $(this).css('visibility', 'hidden');
                        });

                        $(".side-modal-dialog").each(function () {
                            $(this).css('transform', 'translateX(-100%)');
                        });
                    });

                    $('#create-user-btn').click(function() {
                        const modal = $('#create-user-modal');
                        const firstname = modal.find('input[name="firstname"]').val().trim();
                        const lastname = modal.find('input[name="lastname"]').val().trim();
                        const email = modal.find('input[name="email"]').val().trim();
                        const password = modal.find('input[name="password"]').val().trim();
                        const confirm_password = modal.find('input[name="confirm_password"]').val().trim();

                        if (!firstname || !lastname || !email || !password || !confirm_password) {
                            showToast('error', 'Please fill in all fields.');
                            return;
                        };
                        if (password !== confirm_password) {
                            showToast('error', 'Passwords do not match.');
                            return;
                        };
                        function validateEmail(email) {
                            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            return re.test(String(email).toLowerCase());
                        }
                        if (!validateEmail(email)) {
                            showToast('error', 'Please enter a valid email address.');
                            return;
                        }
                        $.ajax({
                            url: '/chain-fortune/action/create_user',
                            type: 'POST',
                         
                            data: {
                                firstname,
                                lastname,
                                email,
                                password,
                                confirm_password,
                            },
                            success: function(response) {
                                try {
                                    const data = JSON.parse(response);
                                    if (data.status === 'success') {
                                        
                                        $('.side-modal').each(function () {
                                            $(this).css('visibility', 'hidden');
                                        });
                                        
                                        $(".side-modal-dialog").each(function () {
                                            $(this).css('transform', 'translateX(-100%)');
                                        });
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
                                        setTimeout(() => {
                                            showToast('success', data.message);
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'New User Added',
                                                text: data.message,
                                                background: 'var(--hover-clr)',
                                                color: '#ffffff',
                                                confirmButtonColor: '#4caf50',
                                                customClass: {
                                                    popup: 'swal2-dark-popup'
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    location.reload();
                                                }
                                            });
                                        }, 3000);
                                    } else {
                                        showToast('error', data.message);
                                    }
                                } catch (error) {
                                    console.error('Invalid JSON response:', response);
                                    showToast('error', 'An unexpected error occurred.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                showToast('error', 'An unexpected error occurred. Please try again later.');
                            }
                        });
                    });


                </script>


            </div>


            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search users..." id="searchInput">
                <img class="search_icon" src="/chain-fortune/images/svg/search-alt-svgrepo-com.svg" alt="">
            </div>

            <table class="user-table">
                <div id="loading" style="display: none;">
                    <div class="spinner"></div>
                </div>
                <?php foreach ($users as $user): ?>
                    <tbody class="users-list" id="user-row-<?= htmlspecialchars($user['user_id']) ?>">
                        <tr>
                            <td>
                                <div class="user-info">
                                    <input type="hidden" name="userID" value="<?= htmlspecialchars($user['user_id']) ?>"/>
                                    <input type="hidden" name="userEmail" value="<?= htmlspecialchars($user['email']) ?>"/>
                                    <style>
                                        .profile_photo_wrapper{
                                            position: relative;
                                        }
                                        .profile_photo_wrapper::after{
                                            content: '';
                                            position: absolute;
                                            right: 0;
                                            bottom: 6px;
                                            display: inline-block;
                                            width: 8px;
                                            height: 8px;
                                            border-radius: 100%;
                                            border: 2px solid var(--text-clr);
                                            background: var(--accent-clr);
                                        }
                                    </style>
                                    <div class="profile_photo_wrapper">
                                        <img class="profile_photo" src="/chain-fortune/img/<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default.jpg'; ?>"  alt="<?= htmlspecialchars($user['firstname']) ?>"  style="object-fit: cover; border-radius:50%; border: 2px solid var(--line-clr);">
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name">
                                            <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?> 
                                            <span class="user-id">#<?= htmlspecialchars($user['user_id']) ?></span>
                                        </div>
                                        <span class="email"><?= htmlspecialchars($user['email']) ?></span>
                                    </div>
                                    <div class="fullscreen-preview ">
                                        <div class="profile-overlay overlay " id="profile-overlay">
                                            <div class="profile-card">
                                            <button class="close-btn close_preview" id="close-profile">&times;</button>
                                            
                                            <div class="profile-left">
                                                <div class="profile-image-container" id="zoom-image-<?= htmlspecialchars($user['user_id']) ?>">
                                                <img src="/chain-fortune/img/<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default.jpg'; ?>" alt="Profile Image" class="profile-image">
                                                </div>
                                                <div class="social-links">
                                                    <a href="#" class="social-link"><svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="64 64 896 896" focusable="false"><path d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32zM349.3 793.7H230.6V411.9h118.7v381.8zm-59.3-434a68.8 68.8 0 1168.8-68.8c-.1 38-30.9 68.8-68.8 68.8zm503.7 434H675.1V608c0-44.3-.8-101.2-61.7-101.2-61.7 0-71.2 48.2-71.2 98v188.9H423.7V411.9h113.8v52.2h1.6c15.8-30 54.5-61.7 112.3-61.7 120.2 0 142.3 79.1 142.3 181.9v209.4z"/></svg></a>
                                                    <a href="#" class="social-link"><svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="64 64 896 896" focusable="false"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm215.3 337.7c.3 4.7.3 9.6.3 14.4 0 146.8-111.8 315.9-316.1 315.9-63 0-121.4-18.3-170.6-49.8 9 1 17.6 1.4 26.8 1.4 52 0 99.8-17.6 137.9-47.4-48.8-1-89.8-33-103.8-77 17.1 2.5 32.5 2.5 50.1-2a111 111 0 01-88.9-109v-1.4c14.7 8.3 32 13.4 50.1 14.1a111.13 111.13 0 01-49.5-92.4c0-20.7 5.4-39.6 15.1-56a315.28 315.28 0 00229 116.1C492 353.1 548.4 292 616.2 292c32 0 60.8 13.4 81.1 35 25.1-4.7 49.1-14.1 70.5-26.7-8.3 25.7-25.7 47.4-48.8 61.1 22.4-2.4 44-8.6 64-17.3-15.1 22.2-34 41.9-55.7 57.6z"/></svg></a>
                                                    <a href="#" class="social-link"><svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="64 64 896 896" focusable="false"><path d="M512 378.7c-73.4 0-133.3 59.9-133.3 133.3S438.6 645.3 512 645.3 645.3 585.4 645.3 512 585.4 378.7 512 378.7zM911.8 512c0-55.2.5-109.9-2.6-165-3.1-64-17.7-120.8-64.5-167.6-46.9-46.9-103.6-61.4-167.6-64.5-55.2-3.1-109.9-2.6-165-2.6-55.2 0-109.9-.5-165 2.6-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6 46.9 46.9 103.6 61.4 167.6 64.5 55.2 3.1 109.9 2.6 165 2.6 55.2 0 109.9.5 165-2.6 64-3.1 120.8-17.7 167.6-64.5 46.9-46.9 61.4-103.6 64.5-167.6 3.2-55.1 2.6-109.8 2.6-165zM512 717.1c-113.5 0-205.1-91.6-205.1-205.1S398.5 306.9 512 306.9 717.1 398.5 717.1 512 625.5 717.1 512 717.1zm213.5-370.7c-26.5 0-47.9-21.4-47.9-47.9s21.4-47.9 47.9-47.9 47.9 21.4 47.9 47.9a47.84 47.84 0 01-47.9 47.9z"/></svg></a>
                                                </div>
                                            </div>

                                            <div class="profile-right">
                                                <h2 class="profile-name"><?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?> </h2>
                                                <p class="profile-title"><?= strtoupper(htmlspecialchars($user['role'])) ?></p>
                                                
                                                <div class="profile-info">
                                                <div class="info-item">
                                                    <span class="info-label">User ID</span>
                                                    <span class="info-value">USR-<?= htmlspecialchars($user['user_id']) ?></span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Email</span>
                                                    <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Phone</span>
                                                    <span class="info-value">+1 (555) 123-4567</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Location</span>
                                                    <span class="info-value">San Francisco, CA</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Status</span>
                                                    <span class="info-value"><span class="status <?= $user['status'] === 'Enabled' ? 'enabled' : 'disabled' ?>"><?= htmlspecialchars($user['status']) ?></span></span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Joined</span>
                                                    <span class="info-value"><?= htmlspecialchars($user['date']) ?></span>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="image-zoom-overlay" id="image-zoom-overlay-<?= htmlspecialchars($user['user_id']) ?>">
                                            <img src="/chain-fortune/img/<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default.jpg'; ?>" alt="Zoomed Profile Image" class="zoomed-image">
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#zoom-image-<?= htmlspecialchars($user['user_id']) ?>").click(function() {
                                                    $("#image-zoom-overlay-<?= htmlspecialchars($user['user_id']) ?>").addClass("active");
                                                    $("body").css("overflow", "hidden");
                                                });

                                                $("#image-zoom-overlay-<?= htmlspecialchars($user['user_id']) ?>").click(function() {
                                                    $(this).removeClass("active");
                                                    if (!$("#profile-overlay").hasClass("active")) {
                                                        $("body").css("overflow", "auto");
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Location">
                                <div class="location">
                                    <span>🌎</span>
                                    United States
                                </div>
                            </td>
                            <td data-label="Amount">
                                <div class="balance">
                                    <div>
                                        <span>💰</span>
                                        <span id="total_balance"></span>
                                    </div>
                                </div>
                                <script></script>
                            </td>
                            <td data-label="Status">
                                <span class="status-badge <?= $user['status'] === 'Enabled' ? 'enabled' : 'disabled' ?>"><?= htmlspecialchars($user['status']) ?></span>
                            </td>
                            <td data-label="Actions">
                                <div class="btn-group">
                                    <button class="action-button dropdown-toggle" onclick="toggleDropdown(this)">⋮</button>
                                    <div class="action-dropdown-menu">
                                        <button class="dropdown-item edit__user" name="edit" onclick="openEditUser('edit_user_<?= htmlspecialchars($user['user_id']) ?>')">Edit</button>
                                        <button 
                                            class="dropdown-item disable-btn" 
                                            data-user-id="<?= htmlspecialchars($user['user_id']) ?>" 
                                            data-status="<?= $user['status'] === 'Enabled' ? 'Enabled' : 'Disabled'; ?>">
                                            <?= $user['status'] === 'Enabled' ? 'Disable' : 'Enable'; ?>
                                        </button>
                                    
                                    
                                        <button class="dropdown-item add__balance" name="add_balance" onclick="openAddBalance('add_balance_<?= htmlspecialchars($user['user_id']) ?>')">Add Balance</button>
                                        <button class="dropdown-item send__email" name="send_email"  onclick="openSendEmail('send-email-modal-<?= htmlspecialchars($user['user_id']) ?>')">Send email</button>
                                        <button class="dropdown-item verify__kyc" name="verify_kyc"  onclick="openVerifyKyc('verify_kyc_<?= htmlspecialchars($user['user_id']) ?>')">Verify KYC</button>
                                        <button class="dropdown-item delete" name="delete" onclick="openDeleteUser('delete_user_<?= htmlspecialchars($user['user_id']) ?>')">Delete</button>
                                        <button class="dropdown-item blacklist" name="blacklist" onclick="openBlacklistIp('blacklist-ip-modal-<?= htmlspecialchars($user['user_id']) ?>')" style="color:red;">Add to Blacklist</button>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        <div class="action-modal overlay edit_section" id="edit_user_<?= htmlspecialchars($user['user_id']) ?>" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                            <div class="action-modal-content">
                                <div class="action-modal-header">
                                    <h5 class="action-modal-title" id="modalTitle">Edit <?= htmlspecialchars($user['firstname']) ?>'s Details</h5>
                                    <button class="action-modal-close close_action" aria-label="Close">&times;</button>
                                </div>
                                <div class="action-modal-body">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                    <label for="firstname_<?= htmlspecialchars($user['user_id']) ?>">First name*</label>
                                    <input id="firstname_<?= htmlspecialchars($user['user_id']) ?>" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" type="text" placeholder="Name*" style="width: 100%;">
                                    <label for="lastname_<?= htmlspecialchars($user['user_id']) ?>">Last name*</label>
                                    <input id="lastname_<?= htmlspecialchars($user['user_id']) ?>" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" type="text" placeholder="Name*" style="width: 100%;">
                                    <label for="email_<?= htmlspecialchars($user['user_id']) ?>">Email*</label>
                                    <input id="email_<?= htmlspecialchars($user['user_id']) ?>" name="email" value="<?= htmlspecialchars($user['email']) ?>" type="text" placeholder="Email*" style="width: 100%;">
                                </div>
                                <div class="action-modal-footer">
                                    <button class="btn btn-secondary close_action" id="closeModal">Close</button>
                                    <button 
                                        style="background: var(--accent-clr)" 
                                        class="btn btn-primary edit_btn" 
                                        name="edit_user" 
                                        id="edit_user" 
                                        data-user-id="<?= htmlspecialchars($user['user_id']) ?>">
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="action-modal overlay delete_section" id="delete_user_<?= htmlspecialchars($user['user_id']) ?>" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                            <div class="action-modal-content">
                                <div class="action-modal-header">
                                    <h5 class="action-modal-title" id="modalTitle">Delete Account</h5>
                                    <button class="action-modal-close close_action" aria-label="Close">&times;</button>
                                </div>
                                <div class="action-modal-body">
                                    <span style="margin-block: 10px; display: flex; align-items:center; gap:12px; color: var(--negative-text-clr); background:var(--negative-bg-clr);border: 1px solid var(--negative-text-clr); padding: 10px; display: flex; align-items:center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width='7rem' fill="var(--negative-text-clr)" viewBox="64 64 896 896" focusable="false"><path d="M464 720a48 48 0 1096 0 48 48 0 10-96 0zm16-304v184c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V416c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8zm475.7 440l-416-720c-6.2-10.7-16.9-16-27.7-16s-21.6 5.3-27.7 16l-416 720C56 877.4 71.4 904 96 904h832c24.6 0 40-26.6 27.7-48zm-783.5-27.9L512 239.9l339.8 588.2H172.2z"/></svg>
                                        <samp>After you have deleted an Account, it will be permanently deleted, Accounts cannot be recovered.</samp>
                                    </span>
                                    <p style="display: block;">User Account:
                                        <br>
                                        <div style="margin-block: 10px;"></div>
                                        <strong style="color: var(--text-clr);">
                                            <?= htmlspecialchars($user['email']) ?> 
                                        </strong> 
                                        
                                    </p>
                                </div>
                                <div class="action-modal-footer">
                                    <button class="btn btn-secondary close_action" id="closeModal">Close</button>
                                    <button 
                                        style="background: #ff3001;" 
                                        class="btn btn-primary delete-btn" 
                                        name="delete_user" 
                                        id="delete_user" 
                                        data-user-id="<?= htmlspecialchars($user['user_id']) ?>">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="action-modal overlay add_balance_section" id="add_balance_<?= htmlspecialchars($user['user_id']) ?>" role="dialog">
                            <div class="action-modal-content">
                                <div class="action-modal-header">
                                    <h5 class="action-modal-title" id="modalTitle">Credit <?= htmlspecialchars($user['firstname']) ?>'s account ?</h5>
                                    <button class="action-modal-close close_action" aria-label="Close">&times;</button>
                                </div>
                                <div class="action-modal-body">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">

                                    <label for="enter_amount">Enter Amount*</label>
                                    <input id="enter_amount_<?= htmlspecialchars($user['user_id']) ?>" class="enter_amount" name="enter_amount" type="number" placeholder="Enter amount in dollars" style="width: 100%;">

                                    <label for="select_wallet">Select Wallet*</label>
                                    <select name="select_wallet" id="select_wallet_<?= htmlspecialchars($user['user_id']) ?>" required>
                                        <option value="">Select Wallet</option>
                                        <?php
                                            include('../../../backend/connection.php');
                                            $user_id = $user['user_id'];

                                            $query = "
                                                SELECT c.crypto_name AS crypto_name, c.crypto_symbol AS crypto_symbol
                                                FROM users_wallet uw
                                                JOIN currencies c ON uw.currency_id = c.id
                                                WHERE uw.user_id = ?
                                            ";

                                            $stmt = $conn->prepare($query);
                                            $stmt->bind_param("s", $user_id);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            while ($row = $result->fetch_assoc()) {
                                                $symbol = htmlspecialchars($row['crypto_symbol']);
                                                $name = htmlspecialchars($row['crypto_name']);
                                                echo "<option value=\"$symbol\">$name ($symbol)</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="action-modal-footer">
                                    <button class="btn btn-secondary close_action" id="closeModal">Close</button>
                                    <button 
                                        style="background: var(--accent-clr)" 
                                        class="btn btn-primary add_balance_btn" 
                                        name="add_balance" 
                                        id="add__balance" 
                                        data-user-id="<?= htmlspecialchars($user['user_id']) ?>">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="side-modal send-email-modal" id="send-email-modal-<?= htmlspecialchars($user['user_id']) ?>">
                            <div class="side-modal-overlay">
                                <div class="side-modal-dialog">
                                    <div class="side-modal-content">
                                        <div class="side-modal-header">
                                            <div class="side-modal-title">
                                                <h5>Send <?= htmlspecialchars($user['firstname']) ?> an Email ?</h5>
                                            </div>

                                            <div class="close-side-modal-btn close-side-modal">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="side-modal-body">
                                            <div class="side-modal-body-wrapper">
                                                
                                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                                                <label for="email__<?= htmlspecialchars($user['user_id']) ?>">Email Address*</label>
                                                <div class="email-div"><?= htmlspecialchars($user['email']) ?></div>

                                                <label for="subject__<?= htmlspecialchars($user['user_id']) ?>">Subject*</label>
                                                <input id="subject__<?= htmlspecialchars($user['user_id']) ?>" name="subject" value="A Message From Chain Fortune" type="text" placeholder="Subject" style="width: 100%;">
                                                
                                                <label for="message__<?= htmlspecialchars($user['user_id']) ?>">Your Message*</label>
                                                <textarea id="message__<?= htmlspecialchars($user['user_id']) ?>" name="message" placeholder="Message*"></textarea>
                                            </div>
                                        </div>
                                        <div class="side-modal-footer">
                                            <div class="side-modal-footer-wrapper">
                                                <button class="btn btn-danger close-side-modal">Close</button>
                                                <button class="btn btn-primary send-email-btn" id="send-email-btn" data-user-id="<?= htmlspecialchars($user['user_id']) ?>">Send email</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="action-modal overlay blacklist-ip-modal" id="blacklist-ip-modal-<?= htmlspecialchars($user['user_id']) ?>" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                            <div class="action-modal-content">
                                <div class="action-modal-header">
                                    <h5 class="action-modal-title" id="modalTitle">Add <?= htmlspecialchars($user['firstname']) ?> to blacklist</h5>
                                    <button class="action-modal-close close_action" aria-label="Close">&times;</button>
                                </div>
                                <div class="action-modal-body">
                                    <span style="margin-block: 10px; display: flex; align-items:center; gap:12px; color: var(--negative-text-clr); background:var(--negative-bg-clr);border: 1px solid var(--negative-text-clr); padding: 10px; display: flex; align-items:center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width='7rem' fill="var(--negative-text-clr)" viewBox="64 64 896 896" focusable="false"><path d="M464 720a48 48 0 1096 0 48 48 0 10-96 0zm16-304v184c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V416c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8zm475.7 440l-416-720c-6.2-10.7-16.9-16-27.7-16s-21.6 5.3-27.7 16l-416 720C56 877.4 71.4 904 96 904h832c24.6 0 40-26.6 27.7-48zm-783.5-27.9L512 239.9l339.8 588.2H172.2z"/></svg>
                                        <samp>After blacklisting this user, him or her will not be able to access this platform again!</samp>
                                    </span>
                                    <p style="display: block;">User Account:
                                        <br>
                                        <div style="margin-block: 10px;"></div>
                                        <strong style="color: var(--text-clr);">
                                            <?= htmlspecialchars($user['email']) ?> 
                                        </strong> 
                                        
                                    </p>
                                </div>
                                <div class="action-modal-footer">
                                    <button class="btn btn-secondary close_action" id="closeModal">Close</button>
                                    <button 
                                        style="background: #ff3001;" 
                                        class="btn btn-primary blacklist-ip-btn" 
                                        name="blacklist-ip" 
                                        id="blacklist-ip" 
                                        data-user-id="<?= htmlspecialchars($user['user_id']) ?>">
                                        Blacklist
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        
                    </tbody>
                <?php endforeach; ?>
            </table>

            <div class="pagination" id="pagination">
                <button class="prev-next" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="arrow-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Prev
                </button>
                <button class="active">1</button>
                <button disabled>2</button>
                <button disabled>3</button>
                <button class="prev-next" disabled>
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="arrow-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>

    </main>
    
    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>




    <style>
        .side-modal{
            overflow-x: hidden;
            overflow-y: auto;
            position: fixed;
            visibility: hidden;
            top: 0;
            left: 0;
            z-index: 980000;
            /* display: none; */
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;


            .side-modal-overlay{
                height: 100%;
                width:100%;
                background-color: #11121ac4; 
                /* backdrop-filter: blur(8px);  */
            }

            .side-modal-dialog{
                top: 0;
                left: 0;
                background: red;
                bottom: 0;
                width: 360px;
                max-width: 100%;
                margin: 0;
                transform: translateX(-100%);
                -webkit-transition: all 1s cubic-bezier(0.19, 0.8, 0.22, 1);
                transition: all 0.8s cubic-bezier(0.19, 0.8, 0.22, 1);
                height: 100%;

                .side-modal-content{
                    height: 100%;
                    background: var(--hover-clr);
                    width: 100%;
                    overflow-y: scroll;

                    &::-webkit-scrollbar {
                        width: 6px;
                    }

                    &::-webkit-scrollbar-track {
                        background: var(--black-clr);
                        border-radius: 4px;
                    }

                    &::-webkit-scrollbar-thumb {
                        background: var(--line-clr);
                        border-radius: 4px;
                    }

                    &::-webkit-scrollbar-thumb:hover {
                        background: var(--accent-clr);
                    }



                    .side-modal-header{
                        display: flex;
                        flex-shrink: 0;
                        align-items: center;
                        justify-content: space-between;
                        padding: 1rem 1rem;
                        border-bottom: 1px solid var(--line-clr);
                        border-top-left-radius: calc(0.3rem - 1px);
                        border-top-right-radius: calc(0.3rem - 1px);

                        .side-modal-title{
                            font-size: 1.3rem;
                        }
                    }

                    .side-modal-body{
                        position: relative;
                        flex: 1 1 auto;
                        padding: 1rem;

                        .side-modal-body-wrapper{
                            height: 100%;
                            strong {
                                color: var(--text-clr);
                            }
                            input[type=number] {
                                -moz-appearance: textfield;
                            }
                            input,
                            select,
                            .email-div,
                            textarea{
                                background-color: var(--base-clr);
                                border: 1px solid var(--line-clr);
                                padding: 0.75rem 1rem;
                                border-radius: 8px;
                                color: var(--text-clr);
                                font-size: 1rem;
                                transition: all 0.3s ease;
                                width: 100%;
                                margin-bottom: 10px;
                                margin-top: 5px;
                            }
                            textarea{
                                max-width: 100%;
                                min-width: 100%;
                                max-height: 200px;
                                min-height: 200px;
                            }
                            label{
                                font-size: 13px;
                                margin-left: 3px;
                            }

                            input:focus,
                            select:focus,
                            textarea:focus{
                                outline: none;
                                border-color: var(--accent-clr);
                                box-shadow: 0 0 0 4px var(--input-focus-clr);
                            }

                        }
                    }

                    .side-modal-footer{
                        flex-wrap: wrap;
                        flex-shrink: 0;
                        border-top: 1px solid var(--line-clr);
                        border-bottom-right-radius: calc(0.3rem - 1px);
                        border-bottom-left-radius: calc(0.3rem - 1px);
                        padding: 0.75rem;

                        .side-modal-footer-wrapper{
                            padding: 0.75rem;
                            display: flex;
                            justify-content: space-between;
                            width: 100%;

                            @media screen and (max-width: 324px) {
                                flex-direction: column;
                                gap: 13px;
                            }

                        }
                    }
                }
            }

            .side-modal-dialog.show{
                -webkit-transform: translate(0) !important;
                transform: translate(0) !important;
            }
        }

        .side-modal.show{
            display: block;
        }
    </style>
    <style>
           .profile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(7, 7, 10, 0.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            overflow-y: auto;
            padding: 10px;
            }

            .overlay.active {
            opacity: 1;
            visibility: visible;
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


            .profile-card {
            border-radius: 7px;
            width: 100%;
            max-width: 800px;
            padding: 40px;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.3);
            position: relative;
            transform: scale(0.95) translateY(20px);
            display: flex;
            gap: 40px;
            margin: auto;
            border: 1px solid var(--line-clr);
            background: var(--base-clr);
            }

            .overlay.active .profile-card {
            transform: scale(1) translateY(0);
            opacity: 1;
            animation: "bounce-in 0.7s ease-out forwards"
            }

            .profile-left {
            flex: 0 0 auto;
            text-align: center;
            }

            .profile-right {
            flex: 1;
            min-width: 0;
            }

            .close-btn {
            position: absolute;
            top: 24px;
            right: 24px;
            border: 1px solid var(--line-clr);
            color: var(--secondary-text-clr);
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background:transparent;
            }

            .close-btn:hover {
            color: var(--text-clr);
            background-color: var(--line-clr);
            transform: rotate(90deg);
            }

            .profile-image-container {
            position: relative;
            cursor: pointer;
            margin-bottom: 24px;
            }

            .profile-image {
            width: 160px;
            height: 160px;
            border-radius: 7px;
            object-fit: cover;
            border: 1px solid var(--accent-clr);
            box-shadow: 0 8px 24px rgba(94, 99, 255, 0.2);
            transition: all 0.3s ease;
            }

            .profile-image-container:hover .profile-image {
            transform: scale(1.05);
            box-shadow: 0 12px 32px rgba(94, 99, 255, 0.3);
            }

            .profile-image-container::after {
            content: '👁';
            position: absolute;
            bottom: -8px;
            right: -8px;
            background: var(--accent-clr);
            padding: 8px;
            border-radius: 12px;
            font-size: 14px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            display: none;
            }

            .profile-image-container:hover::after {
            opacity: 1;
            transform: translateY(0);
            }

            .profile-name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-clr);
            }

            .profile-title {
            font-size: 18px;
            color: var(--accent-clr);
            margin-bottom: 32px;
            font-weight: 500;
            letter-spacing: 0.5px;
            }

            .profile-info {
            border-top: 2px solid var(--line-clr);
            padding-top: 32px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            }

            .info-item {
            /* background: var(--hover-clr); */
            padding: 16px;
            border-radius: 7px;
            transition: all 0.3s ease;
            border: 1px solid var(--line-clr);
            }

            .info-item:hover {
            transform: translateY(-2px);
            background: var(--hover-clr);
            }

            .info-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--secondary-text-clr);
            margin-bottom: 8px;
            display: block;
            }

            .info-value {
            font-size: 16px;
            color: var(--text-clr);
            font-weight: 500;
            word-break: break-word;
            }

            .status {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            }

            .status.enabled {
            background-color: var(--positive-bg-clr);
            color: var(--positive-text-clr);
            }
            .status.disabled {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
            }

            .social-links {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
            display: none;
            }

            .social-link {
            width: 44px;
            height: 44px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-clr);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            /* border: 1px solid var(--line-clr); */

            }

            .social-link:hover {
            background-color: var(--accent-clr);
            transform: translateY(-3px) rotate(8deg);
            }

            .image-zoom-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(7, 7, 10, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 20px;
            overflow-y: auto;
            }

            .image-zoom-overlay.active {
            opacity: 1;
            visibility: visible;
            }

            .zoomed-image {
            max-width: 90%;
            max-height: 90vh;
            border-radius: 24px;
            transform: scale(0.9);
            transition: all 0.3s ease;
            object-fit: contain;
            }

            .image-zoom-overlay.active .zoomed-image {
            transform: scale(1);
            }

            @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                align-items: center;
                gap: 24px;
                padding: 32px 24px;
                margin: 20px auto;
                width: calc(100% + 40px);
                min-height: min-content;
            }
            .profile-right{
                width: 100%;
            }

            .profile-info {
                grid-template-columns: 1fr;
            }

            .profile-name {
                font-size: 24px;
            }

            .profile-title {
                font-size: 16px;
                margin-bottom: 24px;
            }

            .overlay, .image-zoom-overlay {
                align-items: flex-start;
            }
            }

            @media (max-width: 480px) {
            .profile-card {
                padding: 24px 16px;
                width: calc(100% - 20px);
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .info-item {
                padding: 12px;
            }

            .close-btn {
                top: 16px;
                right: 16px;
                width: 36px;
                height: 36px;
            }

        
            }

            @media (max-width: 320px) {
            .profile-card {
                padding: 20px 12px;
                width: calc(100% - 10px);
            }

            .profile-image {
                width: 100px;
                height: 100px;
            }

            .social-link {
                width: 36px;
                height: 36px;
            }

            .profile-name {
                font-size: 20px;
            }

        }
    </style>
   

    
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script src="/chain-fortune/js/crypto_wallet.js"></script>
    <!-- <script src="/chain-fortune/js/users_search_pagination.js"></script> -->
    <script src="/chain-fortune/js/toggle_action_dropdown.js"></script>
    <!-- <script src="/chain-fortune/js/show_action_modal.js"></script> -->
    <script src="/chain-fortune/js/show_create_user_modal.js"></script>
    <!-- <script src="/chain-fortune/js/action_modal.js"></script> -->
    <script src="/chain-fortune/js/users_profile_picture_preview.js" defer></script>

    
    <script>
        // search and pagination
        $(document).ready(function() {
            const $loading = $('#loading');

            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                var found = false;

                $(".users-list").each(function() {
                    var text = $(this).find(".user-name").text().toLowerCase();
                    var match = text.indexOf(value) > -1;
                    $(this).toggle(match);
                    if (match) found = true; 
                });
                
                if (!found && value.trim() !== "") {
                    $loading.show();
                    showToast('error', 'User not found');
                    $(".pagination .prev-next").prop("disabled", true);
                    $(".pagination button").prop("disabled", true); 
                } else {
                    $loading.hide();
                    $(".pagination .prev-next").prop("disabled", true);
                    $(".pagination button").prop("disabled", true); 
                }
                if(value.trim() === ""){
                    $(".pagination .prev-next").prop("disabled", false);
                    $(".pagination button").prop("disabled", false); 
                }
            });

            const itemsPerPage = 10;
            let currentPage = 1;
            const $userList = $(".users-list");
            const totalPages = Math.ceil($userList.length / itemsPerPage);

            function showPage(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                $userList.hide().slice(start, end).show();

                updatePaginationButtons();
            }

            function updatePaginationButtons() {
                $(".pagination button").removeClass("active");
                $(`.pagination button:contains(${currentPage})`).addClass("active");

                $(".pagination .prev-next").prop("disabled", false);
                if (currentPage === 1) {
                    $(".pagination .prev-next:contains(Prev)").prop("disabled", true);
                }
                if (currentPage === totalPages) {
                    $(".pagination .prev-next:contains(Next)").prop("disabled", true);
                }
            }

            function initializePagination() {
                const $pagination = $("#pagination");
                $pagination.empty();

                $pagination.append(`
                    <button class="prev-next" ${currentPage === 1 ? 'disabled' : ''}>
                        Prev
                    </button>
                `);

                for (let i = 1; i <= totalPages; i++) {
                    $pagination.append(`<button ${i === currentPage ? 'class="active"' : ''}>${i}</button>`);
                }

                $pagination.append(`
                    <button class="prev-next" ${currentPage === totalPages ? 'disabled' : ''}>
                        Next
                    </button>
                `);

                $(".pagination button").not('.prev-next').click(function() {
                    if (!$(this).hasClass('active')) {
                        currentPage = parseInt($(this).text());
                        showPage(currentPage);
                    }
                });

                $(".pagination .prev-next").click(function() {
                    if (!$(this).prop('disabled')) {
                        if ($(this).text().includes("Prev")) {
                            currentPage--;
                        } else {
                            currentPage++;
                        }
                        showPage(currentPage);
                    }
                });
            }

            initializePagination();
            showPage(currentPage);
        });

        // edit user details
        function openEditUser(sectionId) {
            const $section = $(`#${sectionId}`);
            if ($section.length === 0) return;

            $('.edit_section').css({
                visibility: 'hidden',
                opacity: '0'
            });

            $(".action-modal-content").css({
                animation: "bounce-in 0.7s ease-out forwards"
            });

            $section.css({
                visibility: 'visible',
                opacity: '1'
            });
        }
        $('.edit_btn').each(function() {
            $(this).on('click', function() {
                const userId = $(this).data('user-id');
                const modal = $('#edit_user_' + userId);
                
                const firstname = modal.find('input[name="firstname"]').val().trim();
                const lastname = modal.find('input[name="lastname"]').val().trim();
                const email = modal.find('input[name="email"]').val().trim();
                
                if (!firstname || !lastname || !email) {
                    showToast('error', 'All fields are required.');
                    return;
                }

                $.ajax({
                    url: '/chain-fortune/action/edit_user',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        firstname,
                        lastname,
                        email
                    },
                    success: function(response) {

                        try {
                            const data = JSON.parse(response);
                            if (data.status === 'success') {
                                $('.edit_btn').attr('disabled',true);
                                showToast('success', data.message);
                                setTimeout(() =>{
                                    location.reload();
                                },2000);
                            } else {
                                // showToast('error', data.message);
                            }
                        } catch (error) {
                            console.error('Invalid JSON response:', response);
                            showToast('error', 'An unexpected error occurred.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        showToast('error', 'An unexpected error occurred. Please try again later.');
                    }
                });
            });
        });


        // disable user
        $('.disable-btn').off('click').on('click', function() {
            const userId = $(this).data('user-id');
            const userInfoTable = $('#user-row-' + userId);
            const email = userInfoTable.find('input[name="userEmail"]').val().trim();

            if(!userId || !email){
                showToast('error', 'User ID or email is missing.');
                return;
            }
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
            setTimeout(() => {
                $.ajax({
                    type: 'POST',
                    url: '/chain-fortune/action/disable_user',
                    data: {
                        user_id: userId,
                        email: email,
                    },
                    dataType: 'json',
                    success: function(response) {
                        const data = response;
                        if (data.status === 'success') {
                            const isDisabled = data.message.toLowerCase().includes('disabled');
                            const title = isDisabled ? 'User Disabled' : 'User Enabled';

                            const badge = $('#user-row-' + userId).find('.status-badge');
                            const disableBtn = $('#user-row-' + userId).find('.disable-btn');

                            badge.text(isDisabled ? 'Disabled' : 'Enabled');
                            badge.removeClass('enabled disabled').addClass(isDisabled ? 'disabled' : 'enabled');
                            disableBtn.text(isDisabled ? 'Enable' : 'Disable');

                            showToast('info', data.message);
                            Swal.fire({
                                icon: 'info',
                                title: title,
                                text: data.message,
                                background: 'var(--hover-clr)',
                                color: '#ffffff',
                                confirmButtonColor: 'var(--info-clr)',
                                customClass: {
                                    popup: 'swal2-dark-popup'
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
                                confirmButtonColor: '#f44336',
                                customClass: {
                                    popup: 'swal2-dark-popup'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        showToast('error', 'Server error. Please try again.');
                    }
                });
            }, 2000);
        });

        // add balance
        function openAddBalance(sectionId) {
            const $section = $(`#${sectionId}`);
            if ($section.length === 0) return;

            $('.add_balance_section').css({
                visibility: 'hidden',
                opacity: '0'
            });

            $(".action-modal-content").css({
                animation: "bounce-in 0.7s ease-out forwards"
            });

            $section.css({
                visibility: 'visible',
                opacity: '1'
            });
        };
        $('.add_balance_btn').off('click').on('click', function() {
            const userId = $(this).data('user-id');
            const modal = $('#add_balance_' + userId);
            const amount = modal.find('input[name="enter_amount"]').val().trim();
            const wallet = modal.find('select[name="select_wallet"]').val();

            if (!amount || !wallet) {
                showToast('error', 'Please fill in all fields.');
                return;
            };

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
            setTimeout(() => {
                $.ajax({
                    url: '/chain-fortune/action/add_balance_logic',
                    type: 'POST',
                    data: {
                        userId,
                        amount,
                        wallet
                    },
                    success: function(response) {
                        const data = response;
                        if (data.status === 'success') {
                            const $actionOverlay = $(this).closest('.action-modal');
                            if ($actionOverlay.length) {
                                $actionOverlay.css({
                                    visibility: 'hidden',
                                    opacity: '0'
                                });

                                $(".action-modal-content").each(function () {
                                    $(this).css('animation', 'none');
                                    this.offsetWidth; 
                                });
                            }
                            showToast('success', data.message);
                            Swal.fire({
                                icon: 'success',
                                title: 'User credited',
                                text: data.message,
                                background: 'var(--hover-clr)',
                                color: '#ffffff',
                                confirmButtonColor: '#4caf50',
                                customClass: {
                                    popup: 'swal2-dark-popup'
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
                                confirmButtonColor: '#f44336',
                                customClass: {
                                    popup: 'swal2-dark-popup'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        showToast('error', 'An unexpected error occurred. Please try again later.');
                    }
                });
            }, 2000);
        });

        // send user emails
        function openSendEmail(sectionId) {
            const $section = $(`#${sectionId}`);

            if ($section.length === 0) return;

            $section.css({
                visibility: 'visible',
            });

            $section.find(".side-modal-dialog").css({
                transform: "translateX(0)",
            });
        }
        $('.send-email-btn').off('click').on('click', function() {
            const userId = $(this).data('user-id');
            const modal = $('#send-email-modal-' + userId);
            const email = modal.find('input[name="email"]').val().trim();
            const subject = modal.find('input[name="subject"]').val().trim();
            const message = modal.find('textarea[name="message"]').val().trim();

            if (!email || !subject || !message) {
                showToast('error', 'Please fill in all fields.');
                return;
            };

            $('.side-modal').each(function () {
                $(this).css('visibility', 'hidden');
            });

            $(".side-modal-dialog").each(function () {
                $(this).css('transform', 'translateX(-100%)');
            });

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
            $.ajax({
                url: '/chain-fortune/action/send_user_emails',
                type: 'POST',
                data: {
                    userId,
                    email,
                    subject,
                    message
                },
                success: function(response) {
                    const data = response;
                    if (data.status === 'success') {
                        showToast('success', data.message);
                        Swal.fire({
                            icon: 'success',
                            title: 'Email Sent',
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
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    showToast('error', 'An unexpected error occurred. Please try again later.');
                }
            });

        });

        // blacklist user
        function openBlacklistIp(sectionId) {
            const $section = $(`#${sectionId}`);
            if ($section.length === 0) return;

            $('.blacklist-ip-modal').css({
                visibility: 'hidden',
                opacity: '0'
            });

            $(".action-modal-content").css({
                animation: "bounce-in 0.7s ease-out forwards"
            });

            $section.css({
                visibility: 'visible',
                opacity: '1'
            });
        }
        $('.blacklist-ip-btn').off('click').on('click', function() {
            const userId = $(this).data('user-id');
            const modal = $('#blacklist-ip-modal-' + userId);
            const email = modal.find('input[name="email"]').val().trim();

            if (!email) {
                showToast('error', 'Email is required.');
                return;
            }
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
            setTimeout(() => {
                $.ajax({
                    url: '/chain-fortune/action/blacklist_user_ip_address',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        email
                    },
                    success: function(response) {
                        const data = response;
                        if (data.status === 'success') {
                            const $actionOverlay = $(this).closest('.action-modal');
                            if ($actionOverlay.length) {
                                $actionOverlay.css({
                                    visibility: 'hidden',
                                    opacity: '0'
                                });

                                $(".action-modal-content").each(function () {
                                    $(this).css('animation', 'none');
                                    this.offsetWidth; 
                                });
                            }
                            showToast('success', data.message);
                            Swal.fire({
                                icon: 'success',
                                title: 'User Blacklisted',
                                text: data.message,
                                background: '#1e1e1e',
                                color: '#ffffff',
                                confirmButtonColor: '#4caf50',
                                customClass: {
                                    popup: 'swal2-dark-popup'
                                }
                            }).then(() => {
                                const userRow = $('#user-row-' + userId);
                                if (userRow.length) {
                                    userRow.remove();
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
        });



                           


   


    











        // delete user
        function openDeleteUser(sectionId) {
            const $section = $(`#${sectionId}`);
            if ($section.length === 0) return;

            $('.delete_section').css({
                visibility: 'hidden',
                opacity: '0'
            });

            $(".action-modal-content").css({
                animation: "bounce-in 0.7s ease-out forwards"
            });

            $section.css({
                visibility: 'visible',
                opacity: '1'
            });
        }
        $('.delete-btn').each(function() {
            $(this).on('click', function() {
                const userId = $(this).data('user-id'); 

                $.ajax({
                    url: '/chain-fortune/action/delete_user',
                    type: 'POST',
                    data: { delete_user: true, user_id: userId },
                    success: function(response) {
                        showToast('info', 'User deleted successfully!');

                        const userRow = $('#user-row-' + userId);
                        if (userRow.length) {
                            userRow.remove();
                        }

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function() { 
                        showToast('error', 'Error deleting user. Please try again.');
                    }
                });
            });
        });


        
        // close side-modal
        $('.close-side-modal').on('click', function () {
            $('.side-modal').each(function () {
                $(this).css('visibility', 'hidden');
            });

            $(".side-modal-dialog").each(function () {
                $(this).css('transform', 'translateX(-100%)');
            });
        });

        $('.close_action').on('click', function () {
            const $actionOverlay = $(this).closest('.action-modal');
            if ($actionOverlay.length) {
                $actionOverlay.css({
                    visibility: 'hidden',
                    opacity: '0'
                });

                $(".action-modal-content").each(function () {
                    $(this).css('animation', 'none');
                    this.offsetWidth; 
                });
            }
        });

    </script>



</body>
</html>

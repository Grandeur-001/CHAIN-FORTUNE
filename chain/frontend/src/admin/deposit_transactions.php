<?php
    include("../../../backend/section_handler.php");
    include("../../../backend/check_role.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune../styles/style.css">
    <script src="/chain-fortune/js/toastify.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[10]
            sideBarItem.classList.add("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[0];
            navItem.classList.add("active");
        });
    </script>
    <style>
        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;
            padding-right: 20px;
            

        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;

            @media (max-width: 650px) {
                flex-direction: column;
                align-items: start;
                justify-content: start;
                gap: 20px;
            }




        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-left: 14px;
            @media (max-width: 650px) {
                margin-left: 0;
            }

        }

        .create_transaction_btn {
            background-color: var(--base-clr);
            color: var(--text-clr);
            border: none;
            padding: 0.9rem 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.775rem;
            box-shadow: inset 0 0 0 1px var(--line-clr);
        }
        .create_transaction_btn:hover{
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
        .transaction-table-wrapper{
            overflow-x: scroll;
            overflow-y: hidden;
            padding-bottom: 20px;

            &::-webkit-scrollbar {
                height: 6px;
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
        }
        .transaction-table {
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            width: 200%;

            > div{
            }
        }

        .transaction-table th {
            text-align: left;
            padding: 15px;
            color: var(--text-clr);
            font-weight: 500;
            border-bottom: 1px solid var(--line-clr);
        }

        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100px;
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


        .transaction-table td {
            padding: 15px;
            border-bottom: 1px solid var(--line-clr);
            color: var(--secondary-text-clr);

        }

        .transaction-table tr:hover td {
            background-color: var(--hover-clr);
        }

        .hash-link {
            color: var(--accent-clr);
            text-decoration: none;
            word-break: break-all;
        }

        .hash-link:hover {
            text-decoration: underline;
        }

        .status-badge,
        .type-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .status-badge.pending {
            background-color: var(--pending-bg-clr);
            color: var(--pending-text-clr);
        }
        
        .status-badge.approved {
            background-color: var(--positive-bg-clr);
            color: var(--positive-text-clr);
        }

        .status-badge.declined {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }

        .type-badge.credit {
            background-color: var(--positive-bg-clr);
            color: var(--positive-text-clr);
        }
        .type-badge.debit {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
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

   
        .transaction-table tr:hover .action-button{
            background: var(--base-clr);
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
        
        .action-dropdown-menu {
            position: absolute;
            right: 50%;
            top: 100%;
            background: var(--hover-clr);
            border-radius: 12px;
            padding: 8px 10px;
            margin-top: 13px;
            min-width: 120px;
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

        .high-priority {
            color: var(--text-clr);
        }
























        @media (max-width: 800px) {
            #main{
                margin-left: 0;
                padding-right: 0px;

            }
            .app-container {
                padding: 0.7rem;
            }
        }

        @media screen and (max-width: 968px) {
            body {
                padding: 8px;
            }

            .transaction-table {
                margin-top: 10px;
            }

            .transaction-table, 
            .transaction-table tbody, 
            .transaction-table tr {
                display: block;
                
            }
            .transaction-table-wrapper{
                overflow: visible;
            }
            .transaction-table {
                width: 100%;
            }
            
            .transaction-table thead {
                display: none;
            }
            
            .transaction-table tr {
                margin-bottom: 15px;
                background-color: var(--base-clr);
                border-radius: 8px;
                border-radius: 8px;
            }
            
            .transaction-table td {
                display: flex;
                padding: 8px 13px;
                border-bottom: 1px solid var(--line-clr);
                align-items: center;
                justify-content: space-between;
            }

            .transaction-table td:before {
                content: attr(data-label);
                font-weight: 500;
                color: var(--text-clr);
                padding-right: 10px;
            }

            .transaction-table td:last-child {
                border-bottom: none;
            }

            .action-button {
                margin-left: auto;
            }
        }
        @media (max-width: 576px) {
            .pagination {
                gap: 0.25rem;
            }

            .pagination button {
                padding: 0.5rem;
                min-width: 36px;
            }
        }

        @media screen and (max-width: 320px) {
            body {
                padding: 4px;
            }

            .transaction-table tr {
                padding: 8px;
            }

            .status-badge {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .hash-link {
                font-size: 0.875rem;
            }

            .action-button {
                width: 32px;
                height: 32px;
            }
        }
    </style>
</head>


<body>
    
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <?php include "../components/toastify.php"; ?>

    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <div class="header">
                <h1>Deposit Transaction Records</h1>
                <button class="create_transaction_btn" id="show_create_transaction">Create Transaction</button>

                <div class="action-modal overlay create_transaction_section" id="create_transaction_section" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="action-modal-content create_transaction_section_content">
                        <div class="action-modal-header">
                            <h5 class="action-modal-title" id="modalTitle">Create Transaction</h5>
                            <button class="action-modal-close close_action" aria-label="Close">&times;</button>
                        </div>
                        <div class="action-modal-body">
                            <label for="transaction_hash">Transaction Hash*</label>
                            <input id="transaction_hash" name="transaction_hash" type="text" placeholder="Enter Transaction Hash" style="width: 100%;">
                            
                            <label for="crypto">Crypto Amount*</label>
                            <input id="crypto" name="crypto" type="text" placeholder="Enter Crypto Amount" style="width: 100%;">
                            
                            <label for="time">Time*</label>
                            <input id="time" name="time" type="date" placeholder="" style="width: 100%;">
                            
                            <label for="miner_preference">Miner Preference*</label>
                            <input id="miner_preference" name="miner_preference" type="text" placeholder="Enter Miner Preference" style="width: 100%;">
                            
                            <select name="select_status" id="">
                                <option value="Select Status">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Declined">Declined</option>
                                <option value="Approved">Approved</option>
                            </select>

                            <select name="select_type" id="">
                                <option value="Select Type">Select Type</option>
                                <option value="Withdraw">Withdraw</option>
                                <option value="Type">Type</option>
                            </select>
                            <div class="action-modal-footer">
                                <div class="btn btn-secondary close_action" id="closeModal">Close</div>
                                <button 
                                    id="create_user_btn"
                                    style="background: var(--accent-clr)" 
                                    class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                        <script src="/chain-fortune/js/create_transaction_handler.js"></script>
                        <script>
                            const $showCreateTransaction = $('#show_create_transaction');
                            const $createTransactionSection = $('.create_transaction_section');
                            const $createTransactionSectionContent = $('.create_transaction_section_content');

                            $showCreateTransaction.on('click', function() {
                                $createTransactionSection.css({
                                    visibility: 'visible',
                                    opacity: '1'
                                });
                                $createTransactionSectionContent.css('animation', 'bounce-in 0.7s ease-out forwards');
                            });

                        </script>
                    </div>
                </div>
            </div>



            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search transactions . . ." id="searchInput">
                <img class="search_icon" src="/chain-fortune/images/svg/search-alt-svgrepo-com.svg" alt="">
            </div>



            <div class="transaction-table-wrapper">
                <table class="transaction-table">
                   <div>
                        <thead>
                            <tr>
                                <!-- <th>Select</th> -->
                                <th>User ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Transaction ID</th>
                                <th>Amount Deposited</th>
                                <th>Crypto</th>
                                <th>Time</th>
                                <th>Miner Preference</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php include("../../../backend/fetch_deposits.php") ?>
                        <tbody>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr class="transactions-list" id="transactions-row-<?= htmlspecialchars($transaction['user_id']) ?>">
                                    
                                    <td data-label="User ID">
                                        <a href="/chain-fortune/admin/users" class="hash-link"><?= htmlspecialchars($transaction['user_id']) ?></a>
                                    </td> 
                                    <td data-label="Firstname">
                                        <b class="" id="firstname"><?= htmlspecialchars($transaction['firstname']) ?></b>
                                    </td> 
                                    <td data-label="Lastname">
                                        <b class="" id="lastname"><?= htmlspecialchars($transaction['lastname']) ?></b>
                                    </td>    
                                    <td data-label="Transaction ID">
                                        <a href="/chain-fortune/admin/transaction_details?hash=<?= htmlspecialchars($transaction['transaction_id']) ?>" class="hash-link"><?= htmlspecialchars($transaction['transaction_id']) ?></a>
                                    </td>
                                    <td data-label="Amount Deposited"><b><?= htmlspecialchars($transaction['amount']) ?> USD</b></td>
                                    <td data-label="Crypto"><b><?= htmlspecialchars($transaction['crypto_symbol']) ?> </b></td>

                                    <td data-label="Time"><?= htmlspecialchars($transaction['transaction_time']) ?></td>
                                    <td data-label="Miner Preference" class="high-priority"><?= htmlspecialchars($transaction['miner_preference']) ?></td>
                                    <td data-label="Status">
                                        <span class="status-badge <?= strtolower($transaction['status']) ?>"><?= htmlspecialchars($transaction['status']) ?></span>
                                    </td>
                                    <td data-label="Type">
                                        <span class="type-badge <?= strtolower($transaction['transaction_type']) ?>"><?= htmlspecialchars($transaction['transaction_type']) ?></span>
                                    </td>
                                    <td data-label="Actions">
                                        <div class="btn-group">
                                            <button class="action-button dropdown-toggle" onclick="toggleDropdown(this)">⋮</button>
                                            <div class="action-dropdown-menu">
                                                <button class="dropdown-item update-transaction-btn" name="update">

                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($transaction['user_id']) ?>">
                                                    <input type="hidden" name="transaction_id" value="<?= htmlspecialchars($transaction['transaction_id']) ?>">
                                                    <input type="hidden" name="amount" value="<?= htmlspecialchars($transaction['amount']) ?>">
                                                    <input type="hidden" name="crypto_symbol" value="<?= htmlspecialchars($transaction['crypto_symbol']) ?>">
                                                    <input type="hidden" name="status" value="<?= htmlspecialchars($transaction['status']) ?>">
                                                    
                                                    Update
                                                </button>
                                                <button class="dropdown-item view_transaction" name="view" onclick="location.href='/chain-fortune/admin/transaction_details?hash=<?= htmlspecialchars($transaction['transaction_id']) ?>'">View</button>
                                                <button class="dropdown-item delete-transaction-btn" name="delete">

                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($transaction['user_id']) ?>">
                                                    <input type="hidden" name="transaction_id" value="<?= htmlspecialchars($transaction['transaction_id']) ?>">
                                                    <input type="hidden" name="amount" value="<?= htmlspecialchars($transaction['amount']) ?>">
                                                    <input type="hidden" name="crypto_symbol" value="<?= htmlspecialchars($transaction['crypto_symbol']) ?>">
                                                    <input type="hidden" name="status" value="<?= htmlspecialchars($transaction['status']) ?>">

                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                   </div>
                </table>
            </div>
          

            <div class="loading">
                <div class="spinner"></div>
            </div>

            <div class="pagination" id="pagination">
                <button class="prev-next" disabled>
                    
                    Prev
                </button>
                <button class="active">1</button>
                <button disabled>2</button>
                <button disabled>3</button>
                <button class="prev-next" disabled>
                    Next
                    
                </button>
            </div>
        </div>
    </main>

    

    <!-- modal styling included here -->
    <?php include "../components/modal_style.php"; ?>

    <script>
        $(document).on('click', '.update-transaction-btn', function(e) {
            e.preventDefault();
            // Retrieve the values from hidden inputs
            const userId = $(this).find('input[name="user_id"]').val();
            const transactionId = $(this).find('input[name="transaction_id"]').val();
            const amount = $(this).find('input[name="amount"]').val();
            const cryptoSymbol = $(this).find('input[name="crypto_symbol"]').val();
            const status = $(this).find('input[name="status"]').val();

            // Validation
            if (!userId || !transactionId || !amount || !cryptoSymbol || !status) {
                showToast('error', 'Invalid data. Please try again.');
                return;
            }
            if(status !== 'Pending'){
                showToast('error', 'Invalid Action');
            }

            // Confirm with SweetAlert first
            Swal.fire({ 
                icon: 'question',
                title: 'Confirm Transaction',
                text: 'You can confirm or decline this transaction',
                background: 'var(--hover-clr)', // your custom color
                color: '#ffffff',
                showConfirmButton: true,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                denyButtonText: 'Decline',
                cancelButtonText: 'Close',
                customClass: {
                    popup: 'swal2-dark-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Loading state while proceeding
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
                    });

                    // Perform AJAX after a short delay
                    setTimeout(() => {
                        $.ajax({ 
                            url: '/chain-fortune/action/confirm_deposit_logic',
                            type: 'POST',
                            data: {
                                user_id: userId,
                                transaction_id: transactionId,
                                amount: amount,
                                crypto_symbol: cryptoSymbol,
                                status: status
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    showToast('success', response.message);
                                    Swal.fire({ 
                                        icon: 'success',
                                        title: 'Confirmed',
                                        text: response.message,
                                        background: 'var(--hover-clr)', 
                                        color: '#ffffff',
                                        confirmButtonColor: '#4caf50',
                                        allowOutsideClick: false,
                                        customClass: {
                                        popup: 'swal2-dark-popup'
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = response.redirect;
                                        }
                                    });
                                } else {
                                    showToast('error', response.message);
                                    console.log(response.message);
                                    Swal.fire({ 
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message,
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
                                console.error("AJAX Error.", status, error);
                                showToast('error', 'Server error. Please try again.');
                                Swal.fire({ 
                                    icon: 'error',
                                    title: 'Server Error',
                                    text: 'Server error. Please try again.',
                                    background: 'var(--hover-clr)', 
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                            }
                        });
                    }, 2000);
                } 
                else if (result.isDenied) {
                    // Handle decline here
                    Swal.fire({ 
                        icon: 'warning',
                        title: 'Declining',
                        text: 'Are you sure you want to decline this transaction?',
                        background: 'var(--hover-clr)', 
                        color: '#ffffff',
                        showConfirmButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Yes, decline',
                        cancelButtonText: 'No, cancel',
                        customClass: {
                            popup: 'swal2-dark-popup'
                        }
                    }).then((declineResult) => {
                        if (declineResult.isConfirmed) {
                            // Perform decline action here
                            setTimeout(() => {
                                $.ajax({ 
                                    url: '/chain-fortune/action/decline_deposit_logic',
                                    type: 'POST',
                                    data: {
                                        user_id: userId,
                                        transaction_id: transactionId,
                                        status: 'Declined'
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            showToast('success', response.message);
                                            Swal.fire({ 
                                            icon: 'success',
                                            title: 'Declined',
                                            text: response.message,
                                            background: 'var(--hover-clr)', 
                                            color: '#ffffff',
                                            confirmButtonColor: '#4caf50',
                                            customClass: {
                                                popup: 'swal2-dark-popup'
                                            }
                                            });
                                        } else {
                                            showToast('error', response.message);
                                            Swal.fire({ 
                                            icon: 'error',
                                            title: 'Error',
                                            text: response.message,
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
                                        console.error("AJAX Error.", status, error);
                                        console.error("Server Response:", xhr.responseText);
                                        showToast('error', 'Server error. Please try again.');
                                    }
                                });
                            }, 2000);
                        }
                    });
                }
                // If isDismissed, we do noting, just close.
            });
        });

        $(document).on('click', '.delete-transaction-btn', function(e) {
            e.preventDefault();

            // Get required values
            const userId = $(this).find('input[name="user_id"]').val();
            const transactionId = $(this).find('input[name="transaction_id"]').val();

            // Basic validation
            if (!userId || !transactionId) {
                showToast('error', 'Invalid transaction data.');
                return;
            }

            // Show delete confirmation alert
            Swal.fire({
                icon: 'warning',
                title: 'Delete Transaction',
                text: 'Are you sure you want to delete this transaction?',
                background: 'var(--hover-clr)',
                color: '#ffffff',
                showConfirmButton: true,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                denyButtonText: 'Cancel Delete',
                cancelButtonText: 'Close',
                customClass: {
                    popup: 'swal2-dark-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Deleting transaction...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        background: 'var(--hover-clr)',
                        color: '#ffffff',
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        $.ajax({
                            url: '/chain-fortune/action/delete_deposit_logic',
                            type: 'POST',
                            data: {
                                user_id: userId,
                                transaction_id: transactionId
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    showToast('success', response.message);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted',
                                        text: response.message,
                                        background: 'var(--hover-clr)',
                                        color: '#ffffff',
                                        confirmButtonColor: '#4caf50',
                                        customClass: {
                                            popup: 'swal2-dark-popup'
                                        }
                                    }).then((res) => {
                                        if (res.isConfirmed && response.redirect) {
                                            window.location.href = response.redirect;
                                        }
                                    });
                                } else {
                                    showToast('error', response.message);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed',
                                        text: response.message,
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
                                console.error("Delete AJAX Error:", status, error);
                                showToast('error', 'Server error. Please try again.');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Server Error',
                                    text: 'Unable to delete transaction.',
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                            }
                        });
                    }, 1000);
                }
            });
        });


    </script>


    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>



    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script src="/chain-fortune/js/toggle_action_dropdown.js"></script>
    <script src="/chain-fortune/js/show_action_modal.js"></script>
    <!-- <script src="/chain-fortune/js/delete_transaction_handler.js"></script> -->
    <script src="/chain-fortune/js/transaction_search_pagination.js"></script>
    
</body>
</html>
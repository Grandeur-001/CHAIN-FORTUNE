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
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[5]
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

        }

        .app-container {
            padding: 20px;
        }
        @media (max-width: 800px) {
            #main{
                margin-left: 0;
            }
            .app-container {
                padding: 0.7rem;
            }
        }
        .payment-container{
            color: var(--text-clr);
            line-height: 1.5;
            min-height: 100vh;
            /* display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; */
            padding: 16px;
            width: 100%;
            /* max-width: 780px; */
            animation: fadeIn 0.5s ease-out;
            border: 1px solid var(--line-clr);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background-color: var(--base-clr);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            margin-bottom: 16px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            gap: 12px;
        }

        .crypto-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: var(--hover-clr);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .crypto-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .crypto-name {
            flex: 1;
        }

        .crypto-name h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .crypto-name p {
            color: var(--secondary-text-clr);
            font-size: 0.9rem;
        }

        .qr-container {
            display: flex;
            justify-content: center;
            padding: 16px 0;
            margin-bottom: 24px;
        }

        .qr-code {
            background-color: white;
            padding: 16px;
            border-radius: 8px;
            width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .info-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 16px;
            border-bottom: 1px solid var(--line-clr);
            padding-bottom: 16px;
        }

        .info-row:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            color: var(--secondary-text-clr);
            font-size: 0.875rem;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 500;
            word-break: break-all;
        }

        .address-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .address-container .info-value {
            flex: 1;
        }

        .copy-btn {
            background-color: var(--hover-clr);
            border: none;
            color: var(--secondary-text-clr);
            width: 36px;
            height: 36px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background-color: var(--accent-clr);
            color: var(--text-clr);
        }

        .amount-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--positive-text-clr);
        }

        .btn {
            width: 100%;
            background-color: var(--accent-clr);
            color: var(--text-clr);
            border: none;
            border-radius: 7px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            &:hover{
                background-color: #4a4fff;
            }
        }
        .btn.back {
            background-color: transparent;
            color: var(--text-clr);
            border: 1px solid var(--line-clr);
            margin-top: 16px;
            &:hover{
                background-color: var(--hover-clr);
                color: var(--text-clr);
            }
            &:active{
                scale: 0.95;
            }
        }

        .warning {
            text-align: center;
            margin-top: 16px;
            font-size: 0.875rem;
            color: var(--secondary-text-clr);
        }

        .warning span {
            color: var(--pending-text-clr);
            font-weight: 500;
        }
        .warning-asset {
            text-align: center;
            margin-top: 8px;
            font-size: 0.875rem;
            color: var(--negative-text-clr);
            background: var(--negative-bg-clr);
            border-radius: 7px;
            padding: 1rem;
        }

        .warning-asset samp {
            font-weight: 600;
            color: var(--text-clr);
            background-color: var(--hover-clr);
            padding: 2px 6px;
            border-radius: 4px;
        }


        @media screen and (max-width: 480px) {
            .card {
                padding: 16px;
            }

            .header {
                margin-bottom: 16px;
            }

            .crypto-icon {
                width: 40px;
                height: 40px;
            }

            .crypto-name h1 {
                font-size: 1.25rem;
            }

            .qr-code {
                width: 180px;
                height: 180px;
                padding: 12px;
            }

            .amount-value {
                font-size: 1.25rem;
            }
        }

        @media screen and (max-width: 360px) {
            .card {
                padding: 12px;
            }

            .qr-code {
                width: 160px;
                height: 160px;
                padding: 8px;
            }

            .btn {
                padding: 14px;
                font-size: 0.95rem;
            }
        }

        /* Animation for copy button */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 0.3s ease-in-out;
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
        
        <?php
            require_once '../../../backend/connection.php'; 

            if (
                !isset($_SESSION['withdrawal_crypto_name']) ||
                !isset($_SESSION['withdrawal_crypto_symbol']) ||
                !isset($_SESSION['withdrawal_wallet_address']) ||
                !isset($_SESSION['withdrawal_qr_code']) ||
                !isset($_SESSION['withdrawal_amount']) ||
                !isset($_SESSION['withdrawal_icon'])
            ) {
                $userId = $_SESSION['user_id'] ?? null;
                $redirectUrl = '/chain-fortune/dashboard';

                if ($userId) {
                    $stmt = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($row = $result->fetch_assoc()) {
                        $redirectUrl = ($row['role'] === 'admin')
                            ? '/chain-fortune/admin/dashboard'
                            : '/chain-fortune/dashboard';
                    }
                }

                die(<<<HTML
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>
                        *{
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                        body { margin: 0; background: #000; color: #fff; } 
                        .swal2-popup {
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                        }
                    </style>
                    <body>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Request',
                                text: 'Sorry! No deposit found', 
                                background: '#1e1e1e',
                                confirmButtonColor: 'red',
                                color: '#ffffff',
                                confirmButtonText: 'Exit',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(() => {
                                window.location.href = '$redirectUrl';
                            });
                        </script>
                    </body>
                HTML);
            }
            $userId = $_SESSION['user_id'];
            $name = htmlspecialchars($_SESSION['withdrawal_crypto_name']);
            $symbol = htmlspecialchars($_SESSION['withdrawal_crypto_symbol']);
            $walletAddress = htmlspecialchars($_SESSION['withdrawal_wallet_address']);
            $qrCode = htmlspecialchars($_SESSION['withdrawal_qr_code']);
            $icon = htmlspecialchars($_SESSION['withdrawal_icon']);
            $amount = $_SESSION['withdrawal_amount'];
            $formattedAmount = number_format($amount, 2);

            echo(<<<HTML
               <div style="text-align: center; margin-bottom: 30px;">
                    <h1>Withdraw from Your $name Wallet</h1>
                    <p>To complete your withdrawal, please send the specified amount to the wallet address below.</p>
                    <p>Once the withdrwal is confirmed, your wallet will be credited with the amount you withdrawed</p>
               </div>
                <div class="payment-container">
                    <div class="card">
                        <div class="header">
                            <div class="crypto-icon">
                                <img src="$icon" alt="Crypto Icon" id="cryptoIcon">
                            </div>
                            <div class="crypto-name">
                                <h1 id="cryptoName">$name</h1>
                                <p id="cryptoSymbol">$symbol</p>
                            </div>
                        </div>

                        <!-- <div class="qr-container">
                            <div class="qr-code">
                                <img src="/chain-fortune/qr-code/$qrCode" alt="QR Code" id="qrCode">
                            </div>
                        </div> -->

                        <div class="info-row">
                            <div class="info-label">Wallet Address</div>
                            <div class="address-container">
                                <div class="info-value" id="walletAddress">$walletAddress</div>
                                <button class="copy-btn" id="copyBtn" title="Copy address">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Amount to withdraw</div>
                            <div class="info-value amount-value" id="depositAmount">$formattedAmount USD</div>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="$userId">
                    <input type="hidden" name="crypto_name" value="$name">
                    <input type="hidden" name="crypto_symbol" value="$symbol">
                    <input type="hidden" name="wallet_address" value="$walletAddress">
                    <input type="hidden" name="qr_code" value="$qrCode">
                    <input type="hidden" name="icon" value="$icon">
                    <input type="hidden" name="amount" value="$amount">

                    <button class="btn" id="pay-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 8v4l3 3"></path>
                        </svg>
                        Complete Withdrawal
                    </button>
                    <button id="goBack" class="btn back">Back</button>
                    <script>
                        document.getElementById('goBack').addEventListener('click', function() {
                            window.history.back();
                        });
                    </script>

                    <p class="warning">Please send <span>exactly</span> the specified amount to avoid transaction issues.</p>
                    <p class="warning-asset">Only send <samp id="assetSymbol">$symbol</samp> assets to this address. Other assets will be lost forever</p>
                </div>
            HTML);
        ?>
      </div>
    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        document.getElementById('copyBtn').addEventListener('click', function() {
            const walletAddress = document.getElementById('walletAddress').textContent;
            navigator.clipboard.writeText(walletAddress).then(() => {
                this.classList.add('pulse');
                showToast('info', 'Copied')
                setTimeout(() => {
                    this.classList.remove('pulse');
                }, 300);
            });
        });

        $('#pay-btn').on('click', function() {
            const userId = $('input[name="user_id"]').val();
            const cryptoSymbol = $('input[name="crypto_symbol"]').val();
            const walletAddress = $('input[name="wallet_address"]').val();
            const amount = $('input[name="amount"]').val();
            
            if (!userId || !cryptoSymbol || !walletAddress || !amount) {
                showToast('error', 'Invalid deposit data. Please try again.');
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
            $.ajax({
                url: '/chain-fortune/action/handle_withdrawal',
                type: 'POST',
                data: {
                    user_id: userId,
                    crypto_symbol: cryptoSymbol,
                    wallet_address: walletAddress,
                    amount: amount
                },
                dataType: 'json',
                success: function(response) {
                    const data = response;
                    if (data.status === 'success') {
                        showToast('success', data.message);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
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
                    console.error("Raw Response:", xhr.responseText);
                    showToast('error', 'Server error. Please try again.');
                }
            });
        });
    </script>



</body>
</html>



<?php
    include("../../../backend/section_handler.php");
    include("../../../backend/check_role.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune../styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[7]
            sideBarItem.classList.remove("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[0];
            navItem.classList.remove("active");
        });
    </script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
      

        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;
            
            @media (max-width: 800px) {
                margin-left: 0;
            }
        }
        .app-container {
            max-width: 100%;
            width: 100%;
            margin: 0 auto;
            padding: 16px;
            flex-direction: column;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            width: 100%;
        }

        .header h1 {
            font-size: calc(1.295rem + 1.4vw);
            font-weight: 700;
            margin-left: 14px;
            margin: auto;
            text-align: center;
        }

        
        .receipt-container {
            min-height: 297mm;
            margin: 0 auto;
            background: var(--base-clr);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--line-clr);
            width: 100%;
        }

        .receipt-header {
            background: linear-gradient(135deg, var(--black-clr) 0%, var(--hover-clr) 100%);
            color: var(--text-clr);
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid var(--accent-clr);
        }

        .receipt-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(94, 99, 255, 0.05) 10px,
                rgba(94, 99, 255, 0.05) 20px
            );
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .company-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            position: relative;
            z-index: 1;
            color: var(--text-clr);
        }

        .company-name {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            color: var(--text-clr);
        }

        .company-tagline {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
            color: var(--secondary-text-clr);
        }

        .receipt-title {
            /* background: linear-gradient(135deg, var(--accent-clr), var(--info-clr)); */
            color: var(--text-clr);
            padding: 25px 40px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .receipt-body {
            padding: 40px;
            background: var(--base-clr);
        }

        .transaction-summary {
            background: var(--hover-clr);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            border-left: 6px solid var(--line-clr);
            position: relative;
            border: 1px solid var(--line-clr);
        }

        .transaction-summary::before {
            content: '✓';
            position: absolute;
            top: -10px;
            right: 20px;
            background: var(--positive-text-clr);
            color: var(--text-clr);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        .amount-display {
            text-align: center;
            margin-bottom: 20px;
        }

        .amount-value {
            font-size: 48px;
            font-weight: 700;
            color: var(--positive-text-clr);
            margin-bottom: 5px;
        }

        .crypto-symbol {
            font-size: 18px;
            color: var(--secondary-text-clr);
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.approved {
            background: var(--positive-bg-clr);
            color: var(--positive-text-clr);
            border: 1px solid var(--positive-text-clr);
        }

        .status-badge.pending {
            background: var(--pending-bg-clr);
            color: var(--pending-text-clr);
            border: 1px solid var(--pending-text-clr);
        }

        .status-badge.declined {
            background: var(--negative-bg-clr);
            color: var(--negative-text-clr);
            border: 1px solid var(--negative-text-clr);
        }

        .transaction-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .detail-group {
            background: var(--hover-clr);
            border-radius: 8px;
            padding: 20px;
            border: 1px solid var(--line-clr);
        }

        .detail-label {
            font-size: 12px;
            color: var(--secondary-text-clr);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 16px;
            color: var(--text-clr);
            font-weight: 500;
            word-break: break-all;
        }

        .miner-preference {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .miner-low {
            background: var(--positive-bg-clr);
            color: var(--positive-text-clr);
            border: 1px solid var(--positive-text-clr);
        }

        .miner-medium {
            background: var(--pending-bg-clr);
            color: var(--pending-text-clr);
            border: 1px solid var(--pending-text-clr);
        }

        .miner-high {
            background: var(--negative-bg-clr);
            color: var(--negative-text-clr);
            border: 1px solid var(--negative-text-clr);
        }

        .transaction-type {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .type-credit {
            background: var(--positive-bg-clr);
            color: var(--positive-text-clr);
            border: 1px solid var(--positive-text-clr);
        }

        .type-debit {
            background: var(--negative-bg-clr);
            color: var(--negative-text-clr);
            border: 1px solid var(--negative-text-clr);
        }

        .receipt-footer {
            background: var(--hover-clr);
            padding: 30px 40px;
            border-top: 2px solid var(--line-clr);
            text-align: center;
        }

        .footer-note {
            font-size: 14px;
            color: var(--secondary-text-clr);
            margin-bottom: 15px;
            line-height: 1.6;
            text-align: center;
            margin-top:20px;
        }

        .qr-placeholder {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--black-clr), var(--hover-clr));
            margin: 0 auto;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-clr);
            font-size: 12px;
            text-align: center;
            border: 1px solid var(--line-clr);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(255, 255, 255, 0.03);
            font-weight: 900;
            z-index: 0;
            pointer-events: none;
        }

        .info-section {
            background: var(--hover-clr);
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid var(--line-clr);
        }

        .info-section h3 {
            color: var(--text-clr);
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-section ul {
            color: var(--secondary-text-clr);
            font-size: 14px;
            line-height: 1.6;
            padding-left: 20px;
        }

        .info-section li {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .receipt-container {
                min-height: auto;
                margin: 0;
                border-radius: 8px;
            }

            .receipt-header {
                padding: 30px 20px;
            }

            .company-logo {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .company-name {
                font-size: 24px;
            }

            .receipt-title {
                padding: 20px;
                font-size: 20px;
            }

            .receipt-body {
                padding: 30px 20px;
            }

            .transaction-summary {
                padding: 25px 20px;
            }

            .amount-value {
                font-size: 36px;
            }

            .transaction-details {
                gap: 20px;
            }

            .detail-group {
                padding: 15px;
            }

            .receipt-footer {
                padding: 25px 20px;
            }

            .watermark {
                font-size: 80px;
            }
        }

        /* Mobile styles */
        @media (max-width: 480px) {
         

            .receipt-container {
                border-radius: 6px;
            }

            .receipt-header {
                padding: 25px 15px;
            }

            .company-logo {
                width: 50px;
                height: 50px;
                font-size: 20px;
                margin-bottom: 15px;
            }

            .company-name {
                font-size: 20px;
                margin-bottom: 6px;
            }

            .company-tagline {
                font-size: 12px;
            }

            .receipt-title {
                padding: 15px;
                font-size: 18px;
                letter-spacing: 0.5px;
            }

            .receipt-body {
                padding: 20px 15px;
            }

            .transaction-summary {
                padding: 20px 15px;
                margin-bottom: 25px;
            }

            .transaction-summary::before {
                width: 30px;
                height: 30px;
                font-size: 14px;
                top: -8px;
                right: 15px;
            }

            .amount-display {
                margin-bottom: 15px;
            }

            .amount-value {
                font-size: 28px;
            }

            .crypto-symbol {
                font-size: 16px;
            }

            .status-badge {
                padding: 6px 15px;
                font-size: 12px;
            }

            .transaction-details {
                grid-template-columns: 1fr;
                gap: 15px;
                margin-bottom: 25px;
            }

            .detail-group {
                padding: 15px 12px;
            }

            .detail-label {
                font-size: 11px;
                margin-bottom: 6px;
            }

            .detail-value {
                font-size: 14px;
                line-height: 1.4;
            }

            .miner-preference {
                padding: 3px 10px;
                font-size: 11px;
            }

            .transaction-type {
                padding: 5px 12px;
                font-size: 12px;
            }

            .info-section {
                padding: 15px;
                margin-top: 25px;
            }

            .info-section h3 {
                font-size: 16px;
                margin-bottom: 12px;
            }

            .info-section ul {
                font-size: 13px;
                line-height: 1.5;
                padding-left: 18px;
            }

            .receipt-footer {
                padding: 20px 15px;
            }

            .footer-note {
                font-size: 12px;
                margin-bottom: 12px;
            }

            .qr-placeholder {
                width: 80px;
                height: 80px;
                font-size: 10px;
            }

            .watermark {
                font-size: 60px;
            }
        }

        /* Extra small mobile styles (320px and below) */
        @media (max-width: 320px) {
            

            .receipt-container {
                border-radius: 4px;
            }

            .receipt-header {
                padding: 20px 12px;
            }

            .company-logo {
                width: 45px;
                height: 45px;
                font-size: 18px;
                margin-bottom: 12px;
            }

            .company-name {
                font-size: 18px;
                margin-bottom: 5px;
            }

            .company-tagline {
                font-size: 11px;
            }

            .receipt-title {
                padding: 12px;
                font-size: 16px;
                letter-spacing: 0.3px;
            }

            .receipt-body {
                padding: 15px 12px;
            }

            .transaction-summary {
                padding: 15px 12px;
                margin-bottom: 20px;
            }

            .transaction-summary::before {
                width: 25px;
                height: 25px;
                font-size: 12px;
                top: -6px;
                right: 12px;
            }

            .amount-display {
                margin-bottom: 12px;
            }

            .amount-value {
                font-size: 24px;
            }

            .crypto-symbol {
                font-size: 14px;
            }

            .status-badge {
                padding: 5px 12px;
                font-size: 11px;
            }

            .transaction-details {
                gap: 12px;
                margin-bottom: 20px;
            }

            .detail-group {
                padding: 12px 10px;
            }

            .detail-label {
                font-size: 10px;
                margin-bottom: 5px;
            }

            .detail-value {
                font-size: 13px;
                line-height: 1.3;
            }

            .miner-preference {
                padding: 2px 8px;
                font-size: 10px;
            }

            .transaction-type {
                padding: 4px 10px;
                font-size: 11px;
            }

            .info-section {
                padding: 12px;
                margin-top: 20px;
            }

            .info-section h3 {
                font-size: 15px;
                margin-bottom: 10px;
            }

            .info-section ul {
                font-size: 12px;
                line-height: 1.4;
                padding-left: 16px;
            }

            .info-section li {
                margin-bottom: 4px;
            }

            .receipt-footer {
                padding: 15px 12px;
            }

            .footer-note {
                font-size: 11px;
                margin-bottom: 10px;
                line-height: 1.4;
            }

            .qr-placeholder {
                width: 70px;
                height: 70px;
                font-size: 9px;
            }

            .watermark {
                font-size: 50px;
            }
        }

        @media print {
            body {
                background: var(--base-clr);
                padding: 0;
            }
            
            .receipt-container {
                box-shadow: none;
                border-radius: 0;
                max-width: none;
                min-height: auto;
            }
        }

        
   
    </style>
</head>


<body>
    
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <?php include "../../../backend/transaction_details_logic.php"; ?>

    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweet_alert.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <header class="header">
                <h1>Transactions Details</h1>
            </header>
            <div class="receipt-container">
                <div class="watermark">CHAIN FORTUNE</div>
                
                <div class="receipt-header">
                    <div class="company-logo">
                        <img src="https://imghost.online/ib/WcbyDZGmGG5u5vH_1747394599.png" alt="Chain Fortune Logo" width="97" height="97" style="display: block; border: 0;" />
                    </div>
                    <div class="company-name">Chain Fortune</div>
                    <div class="company-tagline">Secure Digital Transactions</div>
                </div>

                <div class="receipt-title">Deposit Transaction Receipt</div>

                <div class="receipt-body">
                    <div class="transaction-summary">
                        <div class="amount-display">
                            <div class="amount-value"><?= htmlspecialchars($transaction['amount']) ?> USD</div>
                            <div class="crypto-symbol"><?= htmlspecialchars($transaction['crypto_symbol']) ?></div>
                        </div>
                        <div style="text-align: center;">
                            <span class="status-badge <?= strtolower($transaction['status']) ?>"><?= htmlspecialchars($transaction['status']) ?></span>
                        </div>
                    </div>

                    <div class="transaction-details">
                        <div class="detail-group">
                            <div class="detail-label">Transaction ID</div>
                            <div class="detail-value"><?= htmlspecialchars($transaction['transaction_id']) ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Receipt ID</div>
                            <div class="detail-value">#000001234</div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">User ID</div>
                            <div class="detail-value">USR-<?= htmlspecialchars($transaction['user_id']) ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Transaction Time</div>
                            <div class="detail-value"><?= htmlspecialchars($transaction['transaction_time']) ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Wallet Address</div>
                            <div class="detail-value"><?= htmlspecialchars($transaction['wallet_address']) ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Cryptocurrency</div>
                            <div class="detail-value"> <?= htmlspecialchars($transaction['crypto_symbol']) ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Miner Preference</div>
                            <div class="detail-value">
                                <span class="miner-preference miner-high"><?= htmlspecialchars($transaction['miner_preference']) ?></span>
                            </div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Transaction Type</div>
                            <div class="detail-value">
                                <span class="transaction-type type-credit"><?= htmlspecialchars($transaction['transaction_type']) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3>Important Information</h3>
                        <ul>
                            <li>This receipt serves as proof of your cryptocurrency transaction</li>
                            <li>Transaction fees may apply based on network conditions</li>
                            <li>Please keep this receipt for your records</li>
                            <li>Contact support if you have any questions about this transaction</li>
                        </ul>
                    </div>
                </div>

                <div class="receipt-footer">
                    <div class="qr-placeholder" style="width: 0px; height: 0px; margin: 0 auto; display: flex; align-items: center; justify-content: center;"></div>
                        <strong style="padding-bottom: 10px;">Scan to verify transaction</strong><br>
                        <img src="/chain-fortune/deposit-qr-code/<?= htmlspecialchars($transaction['qr_code']) ?>" alt="">
                    </div>

                    <div class="footer-note">
                        Thank you for using Chain Fortine. This is an electronically generated receipt.<br>
                        For support, visit our website or contact us at support@chainfortune.com
                    </div>
                </div>
                <button id="generatePDF" class="btn btn-primary" style="margin-top: 20px; font-size:17px; width: 100%; padding: 12px; background-color: var(--accent-clr); color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Download PDF
                </button>

                <button id="generateImage" class="btn btn-secondary" style="margin-top: 20px; font-size:17px; width: 100%; padding: 12px; background-color: var(--accent-clr); color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Download Image
                </button>
            </div>
            
        </div>
    </main>




    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script src="/chain-fortune/js/toggle_action_dropdown.js"></script>
    <script>
        $(function() {
            $('#generatePDF').on('click', function () {
                Swal.fire({
                    title: 'Please wait...',
                    text: 'Downloading your PDF receipt..., this may take a few seconds',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    background: 'var(--hover-clr)',
                    showCancelButton: true,
                    cancelButtonText: 'Quit downloading',
                    
                    color: '#ffffff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                const htmlContent = $(".receipt-container")[0].outerHTML;

                setTimeout(() => {
                    $.ajax({
                        url: '/chain-fortune/action/deposit_receipt_maker',
                        method: 'POST',
                        data: {
                            htmlContent: htmlContent,
                        },
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function (blob) {
                            const blobUrl = window.URL.createObjectURL(blob);
                            const a = document.createElement("a");
                            a.href = blobUrl;
                            a.download = "deposit_receipt.pdf";
                            document.body.appendChild(a);
                            a.click();
                            a.remove();

                            showToast('success', 'PDF downloaded and opened successfully');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'PDF downloaded successfully. Click "Open" to view it.',
                                showCancelButton: true,
                                background: 'var(--hover-clr)',
                                color: '#ffffff',
                                confirmButtonText: 'Open',
                                cancelButtonText: 'Close',
                                confirmButtonColor: '#4caf50',
                                allowOutsideClick: false,
                                customClass: {
                                    popup: 'swal2-dark-popup'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open(blobUrl, '_blank');
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.close();
                            showToast('error', 'Failed to generate PDF. Check password or try again.');
                            console.error("AJAX Error:", status, error);
                        }
                    });
                }, 10000);
            });
        });
        


        
    </script>
</body>
</html>
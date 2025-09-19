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
        :root {
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.2);
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 16px;
            --spacing-lg: 24px;
            --spacing-xl: 32px;
        }
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


        .crypto-container header {
        text-align: center;  
        margin-bottom: var(--spacing-xl);
        padding: var(--spacing-lg) 0;
        }

        header h1 {
        font-size: 2.5rem;
        margin-bottom: var(--spacing-sm);
        font-weight: 700;
        color: var(--accent-clr);
        }

        header p {
        color: var(--secondary-text-clr);
        font-size: 1rem;
        }

        .crypto-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: var(--spacing-md);
        }

        .crypto-card {
        background-color: var(--base-clr);
        border-radius:7px;
        padding: var(--spacing-lg);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        cursor: pointer;
        transition: transform var(--transition-normal), background-color var(--transition-normal);
        position: relative;
        overflow: hidden;
        border: 1px solid var(--line-clr);
        }

        .crypto-card:hover {
        background-color: var(--hover-clr);
        transform: translateY(-5px);
        border-color: var(--accent-clr);
        }

        .crypto-card:hover::after {
        opacity: 1;
        }

        .crypto-card::after {
        content: "Manage Wallet";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: var(--accent-clr);
        color: white;
        padding: var(--spacing-sm);
        transform: translateY(100%);
        transition: transform var(--transition-normal), opacity var(--transition-normal);
        opacity: 0;
        }

        .crypto-card:hover::after {
        transform: translateY(0);
        }

        .crypto-icon {
        
        transition: transform var(--transition-normal);
        width: 48px;
        height: 48px;
        margin-bottom: 12px;
        border-radius: 50%;
        background-color: var(--hover-clr);
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .crypto-card:hover .crypto-icon {
        transform: scale(1.1);
        }

        .crypto-symbol {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 4px;
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            color: var(--text-clr);
        }

        .crypto-name {
            font-size: 0.9rem;
            text-align: center;
        }

        .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity var(--transition-normal), visibility var(--transition-normal);
        }

        .modal-overlay.active {
        opacity: 1;
        visibility: visible;
        }

        .modal {
        background-color: var(--base-clr);
        border-radius: 7px;
        width: 90%;
        max-width: 520px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: var(--shadow-md);
        transform: translateY(30px);
        opacity: 0;
        transition: transform var(--transition-normal), opacity var(--transition-normal);

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
        }

        .modal-overlay.active .modal {
        transform: translateY(0);
        opacity: 1;
        }

        .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--spacing-lg);
        border-bottom: 1px solid var(--line-clr);
        }

        .modal-title {
        display: flex;
        align-items: center;
        gap: var(--spacing-md);
        }

        .modal-coin-icon {
        width: 40px;
        height: 40px;
        }

        .modal-title h2 {
        font-size: 1.5rem;
        font-weight: 600;
        }

        .close-button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--secondary-text-clr);
        font-size: 1.5rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: background-color var(--transition-fast), color var(--transition-fast);
        }

        .close-button:hover {
        color: var(--text-clr);
        background-color: var(--hover-clr);
        }

        .modal-body {
        padding: var(--spacing-lg);
        }

        .input-group {
        margin-bottom: var(--spacing-lg);
        }

        .input-group label,
        .qrPreview-label {
        display: block;
        margin-bottom: var(--spacing-sm);
        color: var(--secondary-text-clr);
        font-weight: 500;
        }

        .wallet-input-container {
        display: flex;
        position: relative;
        }

        .wallet-input-container input {
        flex: 1;
        background-color: var(--black-clr);
        border: 1px solid var(--line-clr);
        color: var(--text-clr);
        padding: var(--spacing-md);
        border-radius: var(--radius-sm);
        font-size: 1rem;
        width: 100%;
        transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
        }

        .wallet-input-container input:focus {
        outline: none;
        border-color: var(--accent-clr);
        box-shadow: 0 0 0 3px var(--input-focus-clr);
        }

        .copy-button {
        position: absolute;
        right: var(--spacing-sm);
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--secondary-text-clr);
        cursor: pointer;
        padding: var(--spacing-sm);
        border-radius: var(--radius-sm);
        transition: color var(--transition-fast), background-color var(--transition-fast);
        }

        .copy-button:hover {
        color: var(--text-clr);
        background-color: var(--hover-clr);
        }

        .file-upload-container {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-sm);
        }

        .file-upload-button {
        background-color: var(--hover-clr);
        color: var(--text-clr);
        border: 1px solid var(--line-clr);
        border-radius: var(--radius-sm);
        padding: var(--spacing-md);
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--spacing-sm);
        transition: background-color var(--transition-fast), border-color var(--transition-fast);
        }

        .file-upload-button:hover {
        background-color: var(--accent-clr);
        border-color: var(--accent-clr);
        }

        .file-name {
        font-size: 0.875rem;
        color: var(--secondary-text-clr);
        padding: var(--spacing-sm);
        }

        .qr-preview {
        background-color: var(--black-clr);
        border: 1px dashed var(--line-clr);
        border-radius: var(--radius-sm);
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: var(--spacing-lg);
        overflow: hidden;
        }

        .qr-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--spacing-sm);
        color: var(--secondary-text-clr);
        }

        .qr-placeholder i {
        font-size: 3rem;
        }

        .qr-placeholder p {
        font-size: 0.875rem;
        }

        #qrImage {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        }

        .modal-footer {
        display: flex;
        justify-content: flex-end;
        }

        .save-button {
        background-color: var(--accent-clr);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        padding: var(--spacing-md) var(--spacing-lg);
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
        transition: background-color var(--transition-fast), transform var(--transition-fast);
        }

        .save-button:hover {
        background-color: #4148c9;
        transform: translateY(-2px);
        }

        .save-button:active {
        transform: translateY(0);
        }

        /* Toast Notification */
        .toast {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background-color: var(--positive-bg-clr);
        color: var(--positive-text-clr);
        padding: var(--spacing-md) var(--spacing-lg);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
        z-index: 2000;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity var(--transition-normal), transform var(--transition-normal);
        }

        .toast.active {
        opacity: 1;
        transform: translateY(0);
        }

        .toast.error {
        background-color: var(--negative-bg-clr);
        color: var(--negative-text-clr);
        }

        /* Responsive styles */
        @media (max-width: 1200px) {
        .crypto-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        }

        @media (max-width: 992px) {
        .crypto-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        }

        @media (max-width: 768px) {
        .container {
            padding: var(--spacing-md);
        }
        
        header h1 {
            font-size: 2rem;
        }
        
        .crypto-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        }

        @media (max-width: 480px) {
        header h1 {
            font-size: 1.75rem;
        }
        
        header p {
            font-size: 0.875rem;
        }
        
        .crypto-card {
            padding: var(--spacing-md);
        }
        
        .crypto-icon {
            width: 48px;
            height: 48px;
        }
        
        .crypto-symbol {
            font-size: 1.25rem;
        }
        }

        @media (max-width: 320px) {
        .container {
            padding: var(--spacing-sm);
        }
        
        header {
            margin-bottom: var(--spacing-lg);
            padding: var(--spacing-md) 0;
        }
        
        header h1 {
            font-size: 1.5rem;
        }
        
        .crypto-grid {
            gap: var(--spacing-sm);
        }
        
        .modal-header,
        .modal-body {
            padding: var(--spacing-md);
        }
        
        .modal-title h2 {
            font-size: 1.25rem;
        }
        
        .wallet-input-container input,
        .file-upload-button,
        .save-button {
            padding: var(--spacing-sm) var(--spacing-md);
            font-size: 0.875rem;
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
          <div class="crypto-container">
            <header>
                <h1>Edit Crypto Wallet</h1>
                <p>Click on a cryptocurrency to manage wallet information</p>
            </header>
            
            <div class="crypto-grid" id="cryptoGrid">

            </div>

          </div>
          <div class="modal-overlay" id="modalOverlay">
                <input type="hidden" name="crypto_id" id="crypto_id">
                <div class="modal">
                <div class="modal-header">
                    <div class="modal-title">
                    <img src="" alt="" class="modal-coin-icon">
                    <h2 id="modalTitle"></h2>
                    </div>
                    <button class="close-button" id="closeModal">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <label for="walletAddress">Wallet Address</label>
                        <div class="wallet-input-container">
                            <input type="text" id="walletAddress" placeholder="Enter wallet address">
                            <button class="copy-button" id="copyWallet" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    
                   
                    
                    <label class="qrPreview-label">QR Code</label>
                    <div class="qr-preview" id="qrPreview">
                        <div class="qr-placeholder">
                            <i class="fas fa-qrcode"></i>
                            <p>QR code preview will appear here</p>
                        </div>
                        <img src="" alt="QR Code Preview" id="qrImage" style="display: none;">
                    </div>

                    <div class="input-group">
                        <div class="file-upload-container">
                            <input type="file" id="qrCodeUpload" accept="image/*" hidden>
                            <button class="file-upload-button" id="triggerFileUpload">
                                <i class="fas fa-upload"></i> Upload QR Code
                            </button>
                            <span class="file-name" id="fileName">No file chosen</span>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                    <button class="save-button" id="saveWallet">
                        <i class="fas fa-save"></i> Save
                    </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        $(document).ready(function() {
            const STORAGE_KEY_PREFIX = 'crypto_wallet_';
            let cryptoData = [];

            function fetchCryptocurrencies() {
            $.ajax({
                url: '/chain-fortune/action/fetch_overall_crypto',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                if (response.error) {
                    console.error(response.error);
                    return;
                }
                cryptoData = response;
                generateCryptoGrid();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to load cryptocurrencies:', textStatus, errorThrown);
                }
            });
            }

            function generateCryptoGrid() {
            const $cryptoGrid = $('#cryptoGrid');
            $cryptoGrid.empty(); 

            cryptoData.forEach(crypto => {
                const $cryptoCard = $(`
                <div class="crypto-card" data-id="${crypto.id}">
                    <img src="${crypto.crypto_icon}" alt="${crypto.crypto_name}" class="crypto-icon">
                    <div class="crypto-symbol">${crypto.crypto_symbol}</div>
                    <div class="crypto-name">${crypto.crypto_name}</div>
                </div>
                `);
                $cryptoGrid.append($cryptoCard);
            });
            }

            function initializeModal() {
            const $modalOverlay = $('#modalOverlay');
            const $modal = $('.modal');
            const $closeModal = $('#closeModal');
            let currentCryptoId = null;

            $(document).on('click', '.crypto-card', function() {
                const cryptoId = $(this).data('id');
                const crypto = cryptoData.find(c => c.id == cryptoId); 

                if (crypto) {
                currentCryptoId = cryptoId;

                $('#crypto_id').val(cryptoId);
                $('#modalTitle').text(`${crypto.crypto_symbol} Wallet`);
                $('.modal-coin-icon').attr('src', crypto.crypto_icon).attr('alt', crypto.crypto_name);
                $('#walletAddress').val(crypto.wallet_address || '');
                if (crypto.qr_code) {
                    $('#qrImage').attr('src', '/chain-fortune/qr-code/' + crypto.qr_code).show();
                    $('.qr-placeholder').hide();
                    $('#fileName').text('QR code image loaded');
                } else {
                    $('#qrImage').hide();
                    $('.qr-placeholder').show();
                    $('#fileName').text('No file chosen');
                }

                $modalOverlay.addClass('active');
                setTimeout(() => {
                    $modal.css('opacity', '1');
                    $modal.css('transform', 'translateY(0)');
                }, 50);
                }
            });

            $closeModal.on('click', function() {
                closeModal();
            });

            $modalOverlay.on('click', function(e) {
                if ($(e.target).is($modalOverlay)) {
                closeModal();
                }
            });

            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $modalOverlay.hasClass('active')) {
                closeModal();
                }
            });

            function closeModal() {
                $modal.css('opacity', '0');
                $modal.css('transform', 'translateY(30px)');

                setTimeout(() => {
                $modalOverlay.removeClass('active');
                resetModalFields();
                }, 300);
            }

            function resetModalFields() {
                $('#walletAddress').val('');
                $('#qrImage').attr('src', '').hide();
                $('.qr-placeholder').show();
                $('#fileName').text('No file chosen');
                currentCryptoId = null;
            }

            // Trigger file input
            $('#triggerFileUpload').on('click', function() {
                $('#qrCodeUpload').click();
            });

            $('#qrCodeUpload').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#qrImage').attr('src', event.target.result).show();
                    $('.qr-placeholder').hide();
                    $('#fileName').text('1 file chosen');
                    $('#fileName').css({
                        'color': 'var(--positive-text-clr)',
                        'font-weight': 'bold'
                    });
                };
                reader.readAsDataURL(file);
                }
            });

            // Copy wallet address
            $('#copyWallet').on('click', function() {
                const walletAddress = $('#walletAddress').val();
                if (walletAddress) {
                navigator.clipboard.writeText(walletAddress)
                    .then(() => {
                    showToast('info','Wallet address copied to clipboard!');
                    })
                    .catch(err => {
                    console.error('Could not copy text: ', err);
                    });
                }
            });
            }

            fetchCryptocurrencies();
            initializeModal();

            $('#saveWallet').on('click', function() {
                const currentCryptoId = $('#crypto_id').val();
                const cryptoSymbol = $('#modalTitle').text().split(' ')[0];
                const walletAddress = $('#walletAddress').val();
                const qrCodeFile = $('#qrCodeUpload')[0].files[0];

                console.log('Current Crypto ID:', currentCryptoId);
                console.log('Crypto Symbol:', cryptoSymbol);
                console.log('Wallet Address:', walletAddress);
                console.log('QR Code File:', qrCodeFile);
                console.log('QR Code File Size:', qrCodeFile ? qrCodeFile.size : 'No file selected');

                if (!currentCryptoId) {
                    showToast('error','No cryptocurrency selected');
                    return;
                }
                if (!walletAddress) {
                    showToast('error','Please enter a wallet address');
                    return;
                }
                if (qrCodeFile && qrCodeFile.size > 2 * 1024 * 1024) { 
                    showToast('error','QR code image size exceeds 2MB');
                    return;
                }

                if (currentCryptoId) {
                    const formData = new FormData();
                    formData.append('crypto_id', currentCryptoId);
                    formData.append('crypto_symbol', cryptoSymbol);
                    formData.append('wallet_address', walletAddress);
                    if (qrCodeFile) {
                        formData.append('qr_code', qrCodeFile);
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
                    setTimeout(()=>{
                        $.ajax({
                            url: '/chain-fortune/action/update_wallet',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function(response) {
                                const data = response;
                                if (data.status === 'success') {
                                    fetchCryptocurrencies();
                                    showToast('success', data.message);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Wallet Updated',
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
                                showToast('error', 'Server error. Please try again.');
                            }
                        });
                    },2000);
                }
            });
        });
    </script>



</body>
</html>



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
        .deposit-container {
        }

            h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 32px;
            text-align: center;
            color:var(--text-clr)
            }
            .deposit-container p {
                font-size: 1rem;
                color: var(--secondary-text-clr);
                margin-bottom: 30px;
                text-align: center;
                margin-inline: 10px;
                line-height: 1.6;

                b{
                    color: var(--accent-clr);
                }
            }
         

            .content {
            display: flex;
            flex-direction: column;
            gap: 32px;
            }

            @media (min-width: 900px) {
                .content {
                    flex-direction: row;
                    width: 100%;
                }
            }

            /* Crypto Grid Styles */
            .crypto-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
            flex: 1;
            }

            .crypto-card {
            background-color: transparent;
            border-radius: 7px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            position: relative;
            transition: all 0.5s ease;
            border: 1px solid var(--line-clr);
            overflow: hidden;
            }

            .crypto-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
            }

            .crypto-card.selected {
            border-color: var(--primary-color);
            border: 2px solid var(--accent-clr);

            }

            .crypto-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            border-radius: 50%;
            background-color: var(--hover-clr);
            display: flex;
            align-items: center;
            justify-content: center;
            }

            .crypto-icon img {
            width: 32px;
            height: 32px;
            object-fit: contain;
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

            /* Selected Crypto Styles */
            .selected-crypto {
            background-color: transparent;
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            min-height: 300px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            z-index: -1;
            }

            .selected-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--secondary-text-clr);
            text-align: center;
            padding: 32px;
            }

            .selected-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 32px;
            }

            .selected-icon {
            width: 120px;
            height: 120px;
            margin-bottom: 24px;
            border-radius: 50%;
            background-color: var(--hover-clr);
            display: flex;
            align-items: center;
            justify-content: center;
            }

            .selected-icon img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            }

            .selected-symbol {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-clr);
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            }

            .selected-name {
            font-size: 1.2rem;
            color: var(--secondary-text-clr);
            margin-bottom: 24px;
            }

            .selected-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--positive-text-clr);
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            }

            /* Animation classes */
            .animate-flyout {
            animation: flyout 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 10;
            }

            @keyframes flyout {
            0% {
                transform: scale(1) translateY(0);
            }
            50% {
                transform: scale(1.1) translateY(-20px);
            }
            100% {
                transform: scale(1) translateY(0);
            }
            }

            .clone-card {
            position: fixed;
            z-index: -100;
            transition: all 1.5s cubic-bezier(0.1, 1, 0.3, 1);
            pointer-events: none;
            }

            /* inputs container */
            .inputs-container {
                display: flex;
                flex-direction: column;
                gap: 16px;
                margin-top: 32px;
                justify-content: start;
                align-items: start;
            }
            label {
                font-size: 1rem;
                color: var(--text-clr);
                margin-top: 8px;
            }
            .inputs-container input {
                width: 100%;
                padding: 1rem;
                padding-left: 1rem;
                background-color: var(--base-clr);
                border: 1px solid var(--line-clr);
                border-radius: 7px;
                color: var(--text-clr);
                font-size: 1rem;
                outline: none;
                transition: border-color 0.3s ease;
            }
            .inputs-container input:disabled {
                background-color: var(--hover-clr);
                color: var(--secondary-text-clr);
                font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;

            }
            .inputs-container input[type="number"] {
                -moz-appearance: textfield;
            }
            .inputs-container input[type="number"]::-webkit-inner-spin-button,
            .inputs-container input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            .inputs-container input:focus {
                outline: none;
                border-color: var(--accent-clr);
                box-shadow: 0 0 0 4px var(--input-focus-clr);
            }
            .inputs-container input::placeholder {
                color: var(--secondary-text-clr);
            }
            .inputs-container button {
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

            /* Mobile Optimizations */
            @media (max-width: 800px) {
                
                h1 {
                    font-size: 2rem;
                    margin-bottom: 24px;
                }

                .crypto-grid {
                    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                    gap: 12px;
                }

                .crypto-card {
                    padding: 12px;
                }

                .crypto-icon {
                    width: 40px;
                    height: 40px;
                }

                .crypto-icon img {
                    width: 28px;
                    height: 28px;
                }

                .crypto-symbol {
                    font-size: 1rem;
                }

                .crypto-name {
                    font-size: 0.8rem;
                }

                .selected-crypto {
                    min-height: 250px;
                }

                .selected-icon {
                    width: 100px;
                    height: 100px;
                }

                .selected-icon img {
                    width: 60px;
                    height: 60px;
                }

                .selected-symbol {
                    font-size: 2rem;
                }

                .selected-name {
                    font-size: 1rem;
                }

                .selected-price {
                    font-size: 1.2rem;
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
    <script src="/chain-fortune/js/sweet_alert.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <div class="deposit-container">
                <h1>Delete Crypto Wallet</h1>
                <p>
                    Select the cryptocurrency wallet you want to delete. This action is irreversible and will remove all associated data. Please ensure you have backed up any important information before proceeding.
                </p>
                <div class="content">
                    <div class="crypto-grid" id="cryptoGrid">

                    </div>

                    <div class="selected-crypto" id="selectedCrypto">
                        <div class="selected-placeholder">
                            <p>Select a cryptocurrency</p>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="inputs-container">

                <input type="hidden" name="crypto_id" id="crypto_id" value="">
                <input type="hidden" name="crypto_symbol" id="crypto_symbol" value="">
                <input type="hidden" name="crypto_name" id="crypto_name" value="">

                <button class="delete-btn" id="deleteWalletBtn" type="button">Delete Wallet</button>
            </div>



        </div>




    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        $(function() {
            const $cryptoGrid = $('#cryptoGrid');
            const $selectedCrypto = $('#selectedCrypto');

            const $cryptoId = $('#crypto_id');
            const $cryptoName = $('#crypto_name');
            const $cryptoSymbol = $('#crypto_symbol');

            let $selectedCard = null;
            let isAnimating = false;

            function fetchCryptocurrencies() {
                $.ajax({
                    url: '/chain-fortune/action/get_user_cryptos',
                    method: 'GET',
                    dataType: 'json',
                    success: function(cryptocurrencies) {
                        if (cryptocurrencies.error) {
                            console.error(cryptocurrencies.error);
                            return;
                        }
                        initializeCryptoGrid(cryptocurrencies);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to load cryptocurrencies:', textStatus, errorThrown);
                    }
                });
            }

            function initializeCryptoGrid(cryptocurrencies) {
                $cryptoGrid.empty(); 
                $.each(cryptocurrencies, function(_, crypto) {
                    const $card = createCryptoCard(crypto);
                    $cryptoGrid.append($card);
                });
            }

            function createCryptoCard(crypto) {
                const $card = $(`
                    <div class="crypto-card" data-id="${crypto.id}">
                        <div class="crypto-icon">
                            <img src="${crypto.iconUrl}" alt="${crypto.name} icon">
                        </div>
                        <div class="crypto-symbol">${crypto.symbol}</div>
                        <div class="crypto-name">${crypto.name}</div>
                    </div>
                `);

                $card.on('click', function() {
                    if (isAnimating) return;
                    selectCryptoCard($card, crypto);
                });

                return $card;
            }

            function selectCryptoCard($card, crypto) {
                isAnimating = true;

                if ($selectedCard) {
                    $selectedCard.removeClass('selected');
                }

                $selectedCard = $card;
                $card.addClass('selected');

                const cardRect = $card[0].getBoundingClientRect();
                const selectedRect = $selectedCrypto[0].getBoundingClientRect();

                const $clone = $card.clone();
                $clone.css({
                    width: cardRect.width + 'px',
                    height: cardRect.height + 'px',
                    position: 'fixed',
                    left: cardRect.left + 'px',
                    top: cardRect.top + 'px',
                    margin: 0,
                    zIndex: 9999,
                    transition: 'transform 0.6s ease, opacity 0.6s ease',
                }).addClass('clone-card');

                $('body').append($clone);

                setTimeout(() => {
                    const targetX = selectedRect.left + (selectedRect.width / 2) - (cardRect.width / 2);
                    const targetY = selectedRect.top + (selectedRect.height / 2) - (cardRect.height / 2);
                    const scaleX = 2;
                    const scaleY = 2;

                    $clone.css({
                        transform: `translate(${targetX - cardRect.left}px, ${targetY - cardRect.top}px) scale(${scaleX}, ${scaleY})`,
                        opacity: 0
                    });

                    updateSelectedView(crypto);

                    $cryptoId.val(crypto.crypto_id || '');
                    $cryptoSymbol.val(crypto.symbol || '');
                    $cryptoName.val(crypto.name || '');

                    setTimeout(() => {
                        $clone.remove();
                        isAnimating = false;
                    }, 600);
                }, 50);
            }

            function updateSelectedView(crypto) {
                $selectedCrypto.html(`
                    <div class="selected-content animate-flyout">
                        <div class="selected-icon">
                            <img src="${crypto.iconUrl}" alt="${crypto.name} icon">
                        </div>
                        <div class="selected-symbol">${crypto.symbol}</div>
                        <div class="selected-name">${crypto.name}</div>
                        <!-- <div class="selected-price">${crypto.price}</div> -->
                    </div>
                `);
            }
            fetchCryptocurrencies();

            $('#deleteWalletBtn').on('click', function() {
                
                const cryptoId = $cryptoId.val();
                const cryptoSymbol = $cryptoSymbol.val();
                const cryptoName = $cryptoName.val();

                if (!cryptoId || !cryptoName || !cryptoSymbol) {
                    showToast('error', 'Please select a cryptocurrency wallet');
                    return;
                };
                Swal.fire({
                    title: 'Confirm Deletion',
                    text: `You are about to delete the ${cryptoName} (${cryptoSymbol}) wallet`,
                    icon: 'warning',
                    input: 'password',
                    inputPlaceholder: 'Enter your admin password',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#f44336',
                    confirmButtonText: 'Yes, delete it!',
                    background: 'var(--hover-clr)',
                    color: '#ffffff'
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        const adminPassword = result.value;

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
                                url: '/chain-fortune/action/delete_wallet_logic',
                                method: 'POST',
                                data: {
                                    crypto_id: cryptoId,
                                    crypto_name: cryptoName,
                                    crypto_symbol: cryptoSymbol,
                                    admin_password: adminPassword 
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
                                    showToast('error', 'Server error. Please try again.');
                                }
                            });
                        }, 2000);
                    } else if (result.isConfirmed && !result.value) {
                        showToast('error', 'Password is required to proceed.');
                    }
                });


                

               
                
                
            });
        });
    </script>




</body>
</html>



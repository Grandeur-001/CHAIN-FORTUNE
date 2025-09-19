
<?php
if (!isset($_SESSION['user_id'])) {
    die('Session user_id not set!');
}
include('../../../backend/connection.php');

function getSelectedUserWallets($userId, $conn) {
    $query = "
        SELECT c.crypto_name AS crypto_name, c.crypto_symbol AS crypto_symbol, c.crypto_icon AS crypto_icon, c.wallet_address AS wallet_address, c.qr_code AS qr_code, uw.amount, uw.user_id
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ? AND c.crypto_symbol IN ('BTC', 'ETH', 'USDT')
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return [];
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $wallets = [];

    while ($row = $result->fetch_assoc()) {
        $wallets[] = $row;
    }

    $stmt->close();
    return $wallets;
}

$user_id = $_SESSION['user_id'];
$wallets = getSelectedUserWallets($user_id, $conn);
foreach ($wallets as $wallet) {
    echo '
        <div class="wallet-card ltc" id="' . htmlspecialchars($wallet['crypto_symbol']) . '">
           <div class="wallet-header2">
            <input type="hidden" name="user_id" id="user_id" value="' . htmlspecialchars($wallet['user_id']) . '">
            <input type="hidden" name="crypto_symbol" id="crypto_symbol" value="' . htmlspecialchars($wallet['crypto_symbol']) . '">
            <input type="hidden" name="crypto_name" id="crypto_name" value="' . htmlspecialchars($wallet['crypto_name']) . '">
            <input type="hidden" name="qr_code" id="qr_code" value="' . htmlspecialchars($wallet['qr_code']) . '">
            <input type="hidden" name="wallet_address" id="wallet_address" value="' . htmlspecialchars($wallet['wallet_address']) . '">
             <div class="wallet-icon">
               <img src="' . htmlspecialchars($wallet['crypto_icon']) . '" alt="' . htmlspecialchars($wallet['crypto_name']) . '">
             </div>
             <h2 class="wallet-name">' . htmlspecialchars($wallet['crypto_name']) . '</h2>
             <button class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M942.2 486.2Q889.47 375.11 816.7 305l-50.88 50.88C807.31 395.53 843.45 447.4 874.7 512 791.5 684.2 673.4 766 512 766q-72.67 0-133.87-22.38L323 798.75Q408 838 512 838q288.3 0 430.2-300.3a60.29 60.29 0 000-51.5zm-63.57-320.64L836 122.88a8 8 0 00-11.32 0L715.31 232.2Q624.86 186 512 186q-288.3 0-430.2 300.3a60.3 60.3 0 000 51.5q56.69 119.4 136.5 191.41L112.48 835a8 8 0 000 11.31L155.17 889a8 8 0 0011.31 0l712.15-712.12a8 8 0 000-11.32zM149.3 512C232.6 339.8 350.7 258 512 258c54.54 0 104.13 9.36 149.12 28.39l-70.3 70.3a176 176 0 00-238.13 238.13l-83.42 83.42C223.1 637.49 183.3 582.28 149.3 512zm246.7 0a112.11 112.11 0 01146.2-106.69L401.31 546.2A112 112 0 01396 512z"/><path d="M508 624c-3.46 0-6.87-.16-10.25-.47l-52.82 52.82a176.09 176.09 0 00227.42-227.42l-52.82 52.82c.31 3.38.47 6.79.47 10.25a111.94 111.94 0 01-112 112z"/></svg></button>
           </div>
           <div class="wallet-balance">
             <div style="color:var(--accent-clr);"  class="crypto-amount" data-usd="' . htmlspecialchars($wallet['amount']) . '"> <span>Loading...</span></div>
             <div class="usd-amount">' . htmlspecialchars($wallet['amount']) . ' USD</div>
           </div>
           <div class="wallet-actions">
             <button class="action-btn deposit-btn">
               <span class="action-icon send-icon"></span>
               Deposit
             </button>
             <button class="action-btn receive-btn">
               <span class="action-icon receive-icon"></span>
               Transfer
             </button>
             <button class="action-btn withdraw-btn" id="' . htmlspecialchars($wallet['crypto_symbol']) . '" data-symbol="' . htmlspecialchars($wallet['crypto_symbol']) . '">
               <span class="action-icon withdraw-icon"></span>
               Withdraw
             </button>
           </div>
         </div>
    ';
}
?>

<script>
    $(document).on('click', '.deposit-btn', function() {
        const walletCard = $(this).closest('.wallet-card');
        const userId = walletCard.find('input[name="user_id"]').val();
        const cryptoName = walletCard.find('input[name="crypto_name"').val();
        const cryptoSymbol = walletCard.find('input[name="crypto_symbol"').val();
        const qrCode = walletCard.find('input[name="qr_code"').val();
        const walletAddress = walletCard.find('input[name="wallet_address"').val();

        if(!userId || !cryptoName || !cryptoSymbol || !qrCode || !walletAddress) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Missing required data for withdrawal.',
                background: 'var(--hover-clr)',
                color: '#ffffff'
            });
            return;
        };

        Swal.fire({
            title: 'Make A Deposit?',
            html: `
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">Deposit to your ${cryptoName} (${cryptoSymbol}) wallet?</div>
                <input id="withdraw-amount" type="number" min="0" step="0.0001" class="swal2-input" placeholder="Enter amount">
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#f44336',
            confirmButtonText: 'Proceed',
            background: 'var(--hover-clr)',
            color: '#ffffff',
            preConfirm: () => {
                const amount = parseFloat(document.getElementById('withdraw-amount').value.trim());

                if (isNaN(amount) || amount <= 0) {
                    showToast('error', 'Invalid input: Please enter a valid amount.');
                    return false;
                }
                return { amount };
            }   
        }).then((result) => {
            if (result.isConfirmed) {
                const { amount } = result.value;
                
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
                        url: '/chain-fortune/action/validate_deposit',
                        method: 'POST',
                        data: {
                            user_id: userId,
                            amount: amount,
                            wallet_address: walletAddress,
                            qr_code: qrCode,
                            crypto_symbol: cryptoSymbol
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
                            console.error("Server Response:", xhr.responseText);
                            showToast('error', 'Server error. Please try again.');
                        }
                    });
                }, 2000);

                
            }
        });

    });
    $(document).on('click', '.withdraw-btn', function() {
        const walletCard = $(this).closest('.wallet-card');
        const userId = walletCard.find('input[name="user_id"]').val();
        const cryptoName = walletCard.find('input[name="crypto_name"').val();
        const cryptoSymbol = walletCard.find('input[name="crypto_symbol"').val();
        const qrCode = walletCard.find('input[name="qr_code"').val();

        if(!userId || !cryptoName || !cryptoSymbol || !qrCode) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Missing required data for withdrawal.',
                background: 'var(--hover-clr)',
                color: '#ffffff'
            });
            return;
        }
        
        Swal.fire({
            title: 'Make A Withdrawal?',
            html: `
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">Withdraw from your ${cryptoName} (${cryptoSymbol}) wallet?</div>
                <input id="wallet-address" class="swal2-input" placeholder="Enter wallet address">
                <input id="withdraw-amount" type="number" min="0" step="0.0001" class="swal2-input" placeholder="Enter amount">
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#f44336',
            confirmButtonText: 'Proceed',
            background: 'var(--hover-clr)',
            color: '#ffffff',
            preConfirm: () => {
                const address = document.getElementById('wallet-address').value.trim();
                const amount = parseFloat(document.getElementById('withdraw-amount').value.trim());

                if (!address || isNaN(amount) || amount <= 0) {
                    showToast('error', 'Invalid input: Please enter a valid wallet address and amount.');
                    return false;
                }
                return { walletAddress: address, amount };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const { walletAddress, amount } = result.value;
                
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
                        url: '/chain-fortune/action/validate_withdrawal',
                        method: 'POST',
                        data: {
                            user_id: userId,
                            amount: amount,
                            wallet_address: walletAddress,
                            qr_code: qrCode,
                            crypto_symbol: cryptoSymbol
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

                
            }
        });

        

    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceSpans = document.querySelectorAll('.crypto-amount');

        // Build a set of unique coin symbols
        const symbolMap = {
            BTC: 'bitcoin',
            ETH: 'ethereum',
            USDT: 'tether'
        };

        const usedSymbols = new Set();
        priceSpans.forEach(span => {
            const symbol = span.dataset.symbol?.toUpperCase();
            if (symbol && symbolMap[symbol]) {
                usedSymbols.add(symbolMap[symbol]);
            }
        });

        const ids = Array.from(usedSymbols).join(',');

        if (!ids) return;

        fetch(`https://api.coingecko.com/api/v3/simple/price?ids=${ids}&vs_currencies=usd&include_24hr_change=true`)
            .then(res => res.json())
            .then(prices => {
                priceSpans.forEach(span => {
                    const symbol = span.dataset.symbol?.toUpperCase();
                    const usdAmount = parseFloat(span.dataset.usd);
                    let coinId = symbolMap[symbol];

                    const data = prices[coinId];
                    if (data && data.usd) {
                        const coinPrice = data.usd;
                        const converted = (usdAmount / coinPrice).toFixed(6);
                        span.textContent = `${converted} ${symbol}`;
                    } else {
                        span.textContent = 'N/A';
                    }
                });
            })
            .catch(err => {
                console.error("Price fetch failed:", err);
                priceSpans.forEach(span => {
                    span.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="15" class="stroke" stroke="var(--accent-clr)" viewBox="0 0 24 24"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"></animate><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"></animate></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"></animateTransform></g></svg>';
                });
            });
    });
</script>
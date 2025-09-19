
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[3]
            sideBarItem.classList.add("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[2];
            navItem.classList.add("active");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;
            
            @media (max-width: 800px) {
                margin-left: 0;
            }
        }

        .header-section{
            text-align: center;
        }
        .swap-container {
            width: 100%;
            padding: 20px;
        }

        .swap-card {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 24px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            color: var(--secondary-text-clr);
            margin-bottom: 8px;
        }

        .input-wrapper {
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            @media (max-width: 500px) {
                flex-direction: column;
            }
        }

        .token-select {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            cursor: pointer;
            min-width: 120px;
            @media (max-width: 500px) {
                width: 100%;
                justify-content: center;
            }

            > span {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                
                > svg{
                    margin-top: 3px;
                    margin-right: 13px;
                }
            }

        }

        .token-select img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
        }

        input {
            background: none;
            border: none;
            color: var(--text-clr);
            font-size: 1rem;
            width: 100%;
            outline: none;
        }
        .amount-wrapper{
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            @media (max-width: 500px) {
                -moz-appearance: textfield;
                appearance: none;

            }
        }
        .usd-value {
            color: var(--accent-clr);
            font-size: 1.2rem;
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            padding: 13px 12px;
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            display: none;
            
        }
        #from-amount,
        #to-amount{
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            font-weight: 500;
            padding: 13px 12px;
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            width: 100%;


            &:focus {
                outline: none;
                border-color: var(--accent-clr);
                box-shadow: 0 0 0 4px var(--input-focus-clr);
            }
        }
        #to-amount{
            padding: 10px 12px;
        }

        .swap-icon {
            display: flex;
            justify-content: center;
            margin: -10px 0;
            color: var(--accent-clr);
            cursor: pointer;

            span{
                background: var(--hover-clr);
                display: grid;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                place-content: center ;
            }
        }

        .details {
            margin: 24px 0;
            padding: 16px;
            border: 1px solid var(--line-clr);
            border-radius: 7px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: var(--secondary-text-clr);
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .btn-group{
            display: flex;
            gap: 10px;
            width: 400px;
            @media (max-width: 500px) {
                flex-direction: column;
                width: 100%;
            }
        }

        .btn-primary{
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
        .btn-secondary{
            width: 100%;
            background-color: transparent;
            color: var(--text-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            &:hover{
                background-color: var(--hover-clr);
            }
        }

        
        .token-modal-wrapper {
            overflow-y: auto;
            flex: 1;
        }
        .token-modal {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--base-clr);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            border-top: 1px solid var(--line-clr);
            padding-top: 5px;
            z-index: 10000;

        }

        .token-modal.active {
            transform: translateY(0);
        }

       

      
        
        .search-box {
            position: relative;
            margin-bottom: 16px;
            margin-top: 20px;
        }
        
        .search-box input {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 7px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;

        }

        .search-box input:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        .search-box svg {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-text-clr);
        }


        .token-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            overflow-y: auto;
            /* padding-right: 10px; */
        }
        .token-list::-webkit-scrollbar {
            width: 8px;
        }

        .token-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .token-list::-webkit-scrollbar-thumb {
            background: var(--line-clr);
            border-radius: 4px;
        }

        .token-list::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-text-clr);
        }

        .token-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            cursor: pointer;
            border-radius: 7px;
            transition: background-color 0.2s;
            border: 0.3px solid var(--line-clr);
        }
        
        .token-item:hover {
            background-color: var(--hover-clr);
        }
        .coin-info{
            display: flex;
            align-items: center;
            gap: 1rem;
        }

            
        .coin-image,
        .crypto_icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
        }

        .token-name{
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
        }
     

        .token-symbol{
            color: var(--secondary-text-clr);
            text-transform: uppercase;
            font-size: 0.875rem;
            display:flex;
            align-items:center;
        }

        .price-container {
            text-align: right;
        }

        .converted-price {
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            color: var(--accent-clr)
            
        }
        .wallet-amount{
            color: var(--secondary-text-clr);
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
        }





        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 9000;
            backdrop-filter: blur(8px); 

        }

        .overlay.active {
            opacity: 1;
            pointer-events: auto;
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
    </style>
</head>


<body>
    
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <?php include "../components/toastify.php"; ?>

    
    <main class="main" id="main">
        <div class="app-container">
            <header class="header-section">
                <h1>Exchanges Coins</h1>
            </header>
            <div class="swap-container">
                <div class="swap-card">
                    <div class="input-group from">
                        <label>From✨</label>
                        <div class="input-wrapper">
                            <div class="token-select" data-type="from">
                                <img src="/chain-fortune/images/no-image.jpg" alt="" id="from-token-img">
                                <span id="from-token-symbol">Select</span>
                                <span class="dropdown-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                        <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="amount-wrapper">
                                <input type="number" id="from-amount" value="1000" placeholder="0">
                                <div class="usd-value" id="from-usd">($0.00)</div>
                            </div>
                        </div>
                    </div>

                    <div class="swap-icon">
                        <span>
                            <svg style="transform: rotate(90deg);" xmlns="http://www.w3.org/2000/svg" width="28px" fill="var(--accent-clr)" viewBox="64 64 896 896" focusable="false"><path d="M847.9 592H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h605.2L612.9 851c-4.1 5.2-.4 13 6.3 13h72.5c4.9 0 9.5-2.2 12.6-6.1l168.8-214.1c16.5-21 1.6-51.8-25.2-51.8zM872 356H266.8l144.3-183c4.1-5.2.4-13-6.3-13h-72.5c-4.9 0-9.5 2.2-12.6 6.1L150.9 380.2c-16.5 21-1.6 51.8 25.1 51.8h696c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"/></svg>
                        </span>
                    </div>

                    <div class="input-group to">
                        <label>To✨</label>
                        <div class="input-wrapper">
                            <div class="token-select" data-type="to">
                                <img src="/chain-fortune/images/no-image.jpg" alt="" id="to-token-img">
                                <span id="to-token-symbol">Select</span>
                                <span class="dropdown-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                        <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"></path>
                                    </svg>
                                </span>
                            </div>
                            <!-- <input type="number" id="to-amount" placeholder="0" readonly> -->
                            <span id="to-amount">0.0</span>
                            <div class="usd-value" id="to-usd">($0.00)</div>
                        </div>
                    </div>

                    <div class="details">
                        <div class="detail-row">
                            <span>Slippage Tolerance</span>
                            <span>2.0%</span>
                        </div>
                        <div class="detail-row">
                            <span>Price</span>
                            <span id="price-info">Select tokens</span>
                        </div>
                        <div class="detail-row">
                            <span>Gas Fee</span>
                            <span>150 GWEI</span>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button class="btn-secondary price-rate-btn">Price Rate</button>
                        <button class="swap-btn btn-primary">Swap</button>
                    </div>
                </div>
            </div>

            <div class="token-modal">
                <div class="search-box">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search by name or symbol">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            
                <div class="token-list">
                    <?php
                        if (!isset($_SESSION['user_id'])) {
                            die('Session user_id not set!');
                        }
                        include('../../../backend/connection.php');


                        function getUserWallets($userId, $conn) {
                            $query = "
                                SELECT c.crypto_name AS crypto_name, c.crypto_symbol AS crypto_symbol, c.crypto_icon AS crypto_icon, c.crypto_id AS crypto_id, uw.amount
                                FROM users_wallet uw
                                JOIN currencies c ON uw.currency_id = c.id
                                WHERE uw.user_id = ?
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
                        $wallets = getUserWallets($user_id, $conn);


                        foreach ($wallets as $wallet) {
                            echo '
                                <div class="token-item" data-id="' . htmlspecialchars($wallet['crypto_name']) . '" data-crypto-id="' . htmlspecialchars($wallet['crypto_id']) . '">
                                    <div class="coin-info">
                                        <img class="coin-image" src="' . htmlspecialchars($wallet['crypto_icon']) . '" alt="' . htmlspecialchars($wallet['crypto_name']) . '">
                                        <div class="token-info">
                                            <div class="token-name">' . htmlspecialchars($wallet['crypto_name']) . '</div>
                                            <div class="token-symbol">' . htmlspecialchars($wallet['crypto_symbol']) . '</div>
                                        </div>
                                    </div>

                                    <div class="price-container">
                                        <span class="converted-price" >Not yet ready</span>
                                        <div class="wallet-amount">' . htmlspecialchars($wallet['amount']) .' USD</div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>

                </div>
            </div>
            <div class="overlay"></div>





            <style>
                .widget_wrapper {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 20px;
                    padding: 20px;
                    background-color: var( --surface);
                    border-radius: var(--border-radius);
                }
                .widget-card {
                    border-radius: 8px;
                    overflow: hidden;
                    background: rgba(255, 255, 255, 0.05);

                }
                .tradingview-widget-copyright {
                    font-size: 13px !important;
                    line-height: 32px !important;
                    text-align: center !important;
                    vertical-align: middle !important;
                    font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif !important;
                    color: #B2B5BE !important;
                }
                .tradingview-widget-copyright .blue-text {
                    color: #2962FF !important;
                }
                .tradingview-widget-copyright a {
                    text-decoration: none !important;
                    color: #B2B5BE !important;
                }
                .tradingview-widget-copyright a:visited {
                    color: #B2B5BE !important;
                }
                .tradingview-widget-copyright a:hover .blue-text {
                    color: #1E53E5 !important;
                }
                .tradingview-widget-copyright a:active .blue-text {
                    color: #1848CC !important;
                }
                .tradingview-widget-copyright a:visited .blue-text {
                    color: #2962FF !important;
                }
                @media (max-width: 1200px) {
                    .widget_wrapper {
                        grid-template-columns: repeat(3, 1fr);
                    }
                }
                @media (max-width: 900px) {
                    .widget_wrapper {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }
                @media (max-width: 600px) {
                    .widget_wrapper {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
            <div id="widgetWrapper" class="widget_wrapper"><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BITSTAMP:BTCUSD%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BITSTAMP:BTCUSD/" rel="noopener" target="_blank">
                                    <span class="blue-text">BTC/USD Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BITSTAMP:ETHUSD%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BITSTAMP:ETHUSD/" rel="noopener" target="_blank">
                                    <span class="blue-text">ETH/USD Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BINANCE:LTCUSDT%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BINANCE:LTCUSDT/" rel="noopener" target="_blank">
                                    <span class="blue-text">LTC/USDT Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BINANCE:XRPUSDT%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BINANCE:XRPUSDT/" rel="noopener" target="_blank">
                                    <span class="blue-text">XRP/USDT Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BITMEX:XBTUSD%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BITMEX:XBTUSD/" rel="noopener" target="_blank">
                                    <span class="blue-text">XBT/USD Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22KRAKEN:DOTUSD%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/KRAKEN:DOTUSD/" rel="noopener" target="_blank">
                                    <span class="blue-text">DOT/USD Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BITTREX:DOGEUSD%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BITTREX:DOGEUSD/" rel="noopener" target="_blank">
                                    <span class="blue-text">DOGE/USD Rates</span>
                                </a> by TradingView
                            </div>
                        </div>
                    </div><div class="widget-card">
                        <div class="tradingview-widget-container" style="width: 100%; height: 126px;">
                            <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/single-quote/?locale=in#%7B%22symbol%22%3A%22BITFINEX:XRPUSD%22%2C%22width%22%3A%22100%25%22%2C%22colorTheme%22%3A%22dark%22%2C%22isTransparent%22%3Atrue%2C%22height%22%3A126%2C%22utm_source%22%3A%22example.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22single-quote%22%2C%22page-uri%22%3A%22example.com%2Fpage%22%7D" style="box-sizing: border-box; height: calc(126px - 32px); width: 100%;">
                            </iframe>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/symbols/BITFINEX:XRPUSD/" rel="noopener" target="_blank">
                                    <span class="blue-text">XRP/USD Rates</span>
                                </a> by TradingView
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
    <script src="/chain-fortune/js/toastify.js"></script>
    <script>
        const tokens = {};
        <?php
            $sql = "SELECT crypto_name, crypto_symbol, crypto_id, crypto_icon FROM currencies";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = addslashes($row['crypto_name']);
                    $id = addslashes($row['crypto_id']);
                    $symbol = addslashes($row['crypto_symbol']);
                    $icon = addslashes($row['crypto_icon']);

                    echo "tokens['$name'] = {
                        id: '$id',
                        symbol: '$symbol',
                        name: '$name',
                        image: '$icon'
                    };\n";
                }
            }
        ?>
    </script>
    <script>
        $(document).ready(function() {
            let selectedType = null;
            let fromToken = null;
            let toToken = null;
            $('.token-select').click(function() {
                selectedType = $(this).data('type');
                $('.token-modal, .overlay').addClass('active');
            });

            $('.close-modal, .overlay').click(function() {
                $('.token-modal, .overlay').removeClass('active');
            });

            $(document).on('click', '.token-item', function() {
                const tokenId = $(this).data('id');
                const token = tokens[tokenId];
                if (selectedType === 'from') {
                    fromToken = token;
                    $('#from-token-img').attr('src', token.image);
                    $('#from-token-symbol').text(token.symbol);
                } else {
                    toToken = token;
                    $('#to-token-img').attr('src', token.image);
                    $('#to-token-symbol').text(token.symbol);
                }
                $('.token-modal, .overlay').removeClass('active');
                if (fromToken && toToken) {
                }
            });

            $('.swap-icon').click(function() {
                if (fromToken && toToken) {
                    [fromToken, toToken] = [toToken, fromToken];
                    $('#from-token-img').attr('src', fromToken.image);
                    $('#from-token-symbol').text(fromToken.symbol);
                    $('#to-token-img').attr('src', toToken.image);
                    $('#to-token-symbol').text(toToken.symbol);
                }
            });

            
            const $loading = $('#loading');
            $("#searchInput").on("keyup", function() {
                $(".token-modal").css({
                    height: '80vh',
                })
                var value = $(this).val().toLowerCase();
                var found = false;

                $(".token-item").each(function() {
                    var text = $(this).find(".token-info").text().toLowerCase();
                    var match = text.indexOf(value) > -1;
                    $(this).toggle(match);
                    if (match) found = true; 
                });
                
                if (!found && value.trim() !== "") {
                    $loading.show();
                    showToast('error', 'Token not found');
                 
                } else {
                    $loading.hide();
                }
            });

            
            $('.swap-btn').click(function() {
                const FROM_AMOUNT = $('#from-amount').val();
                const FROM_WALLET = $('#from-token-symbol').text();
                const TO_WALLET = $('#to-token-symbol').text();

                console.log(FROM_WALLET, TO_WALLET, FROM_AMOUNT)

                if (!FROM_AMOUNT || FROM_AMOUNT <= 0) {
                    showToast('error', 'Please enter a valid amount');
                    return;
                }
                if(FROM_WALLET === 'Select'){
                    showToast('error', 'Please select a token to swap');
                    return;
                }
                if(TO_WALLET === 'Select'){
                    showToast('error', 'Please select a token to swap');
                    return;
                }
                if (FROM_WALLET === TO_WALLET) {
                    showToast('error', 'Cannot swap the same token');
                    return;
                }
                $('.swap-btn').html(`<svg xmlns="http://www.w3.org/2000/svg" width="23px" stroke="#fff" class="stroke" viewBox="0 0 24 24"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"/></g></svg>`);
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
                        url: '/chain-fortune/action/exchange_logic',
                        type: 'POST',
                        data: {
                            from_token: FROM_WALLET,
                            to_token: TO_WALLET,
                            from_amount: FROM_AMOUNT
                        },
                        success: function(response) {
                            const data = response;
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Swap Successful',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#4caf50',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href=response.redirect;
                                    }
                                });
                                showToast('success', data.message);
                                $('#from-amount').val(0);
                                $('#from-token-symbol').text('Select');
                                $('#to-token-symbol').text('Select');
                                $('#from-token-img').attr('src', '/chain-fortune/images/no-image.jpg');
                                $('#to-token-img').attr('src', '/chain-fortune/images/no-image.jpg');
                                $('.swap-btn').html(`Swap`)

                            } else {
                                showToast('error', data.message);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Swap Failed',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                                $('.swap-btn').html(`Swap`)

                            }
                        },
                        error: function(xhr, status, error) {

                            console.error(error);
                            showToast('error', 'An unexpected error occurred. Please try again later.');
                        }
                    });
                }, 2000);
            });
        });
    </script>
</body>
</html>

















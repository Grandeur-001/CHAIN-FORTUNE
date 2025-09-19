<script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: var(--base-clr);
            color: var(--text-clr);
            margin: 0;
        }



        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-text-clr);
        }

        #searchInput {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        #searchInput:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        #searchInput::placeholder {
            color: var(--secondary-text-clr);
        }



        .coin-card {
            background-color: var(--hover-clr);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transform: translateZ(0);
            transition: transform 0.2s ease;
        }

        .coin-card:active {
            transform: scale(0.98);
        }

        .coin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .coin-image {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
        }

        .coin-name-container h2 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
        }

        .coin-symbol {
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
            font-weight: bold;
            color: var(--accent-clr)
            
        }
        .wallet-amount{
            color: var(--secondary-text-clr);
            font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
            font-weight: bold;
        }

        .price-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.700rem;
            
        }

        .price-change.positive {
            color: var(--positive-text-clr);
        }

        .price-change.negative {
            color: var(--negative-text-clr);
        }

        .loading {
            display: flex;
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

        @keyframes priceUpdate {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .price-flash {
            animation: priceUpdate 0.5s ease-out;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1F2937;
        }

        ::-webkit-scrollbar-thumb {
            background: #4B5563;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6B7280;
        }

        .error-message {
            text-align: center;
            padding: 20px;
            background-color: var(--hover-clr);
            border-radius: 8px;
        }

        .retry-button {      
            background-color: var(--accent-clr);
            color: var(--text-clr);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .retry-button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="app">
        <header>
            <div class="search-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="search-icon"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="searchInput" placeholder="Search cryptocurrencies...">
            </div>
        </header>
        <a href=""></a>
        <main id="coinList" class="coin-list">
            <div class="loading">
                <div class="spinner"></div>
            </div>
        </main>
        <script src="/chain-fortune/js/crypto_wallet.js"></script>
    </div>






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
    header {
        text-align: center;
        margin-bottom: 2.5rem;

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 32px;
            text-align: center;
            color:var(--text-clr)
        }

        p {
            font-size: 1rem;
            color: var(--secondary-text-clr);
            margin-bottom: 30px;
            text-align: center;
            margin-inline: 10px;
            line-height: 1.6;
        }
    }


    .search-container {
      position: relative;
      margin-bottom: 2rem;
    }

    .search-wrapper {
      position: relative;
      width: 100%;
    }


    #search-input {
        background-color: var(--base-clr);
        border: 1px solid var(--line-clr);
        border-radius: 7px;
        padding: 12px;
        color: var(--text-clr);
        font-size: 16px;
        transition: border-color 0.2s;
        width: 100%;
    }

    #search-input {
        outline: none;
        border-color: var(--accent-clr);
    }

    .search-icon {
      position: absolute;
      right: 1.2rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--secondary-text-clr);
    }

    .crypto-dropdown {
      position: absolute;
      width: 100%;
      max-height: 550px;
      overflow-y: auto;
      background-color: var(--base-clr);
      border-radius: 7px;
      box-shadow: var(--shadow-md);
      z-index: 10;
      display: none;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid var(--border-color);
      scrollbar-width: thin;
    }

    .crypto-dropdown::-webkit-scrollbar {
      width: 6px;
    }

    .crypto-dropdown::-webkit-scrollbar-thumb {
      background-color: var(--line-clr);
      border-radius: 6px;
    }

    .crypto-dropdown.show {
      display: block;
      animation: fadeIn 0.2s ease;
    }

    .crypto-item {
      display: flex;
      align-items: center;
      padding: 0.8rem 1rem;
      cursor: pointer;
      transition: var(--transition);
      border-bottom: 1px solid var(--line-clr);
    }

    .crypto-item:last-child {
      border-bottom: none;
    }

    .crypto-item:hover, .crypto-item.active {
      background-color: var(--hover-clr);
    }

    .crypto-item img {
      width: 28px;
      height: 28px;
      margin-right: 0.8rem;
      border-radius: 50%;
      object-fit: cover;
    }

    .crypto-info {
      display: flex;
      flex-direction: column;
    }

    .crypto-name {
      font-weight: 500;
    }

    .crypto-symbol {
      color: var(--secondary-text-clr);
      font-size: 0.85rem;
      text-transform: uppercase;
    }

    .no-results {
      padding: 1.5rem;
      text-align: center;
      color: var(--secondary-text-clr);
    }

    .selected-crypto {
      background-color: var(--base-clr);
      border-radius: 7px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
      border: 1px solid var(--line-clr);
    }

    .crypto-details {
      display: flex;
      align-items: center;
    }

    .crypto-details img {
      width: 64px;
      height: 64px;
      margin-right: 1.2rem;
      border-radius: 12px;
    }

    .crypto-details-info h2 {
      font-size: 1.5rem;
      margin-bottom: 0.2rem;
    }

    .empty-state {
      color: var(--secondary-text-clr);
      text-align: center;
      padding: 1rem 0;
    }

    .loader {
      position: absolute;
      right: 1.2rem;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      border: 2px solid transparent;
      border-top-color: var(--accent-clr);
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      display: none;
    }
    .create-wallet-btn-container{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
    }
    #createWalletBtn{
        background-color: var(--accent-clr);
        color: #fff;
        padding: 12px 24px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
        margin-top: 1rem;
        margin-bottom: 2rem;
        margin-inline: auto;

        &:hover{}
    }

    .history-container {
      background-color: var(--base-clr);
      border-radius: var(--radius-md);
      padding: 1.5rem;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--line-clr);
    }

    .history-container h3 {
      margin-bottom: 1rem;
      font-weight: 500;
      color: var(--text-clr);
    }

    .history-list {
      display: flex;
      gap: 0.8rem;
      overflow-x: auto;
      padding-bottom: 0.5rem;
      padding-bottom: 40px;

        &::-webkit-scrollbar {
            height: 6px;
        }

        &::-webkit-scrollbar-track {
            background: var(--line-clr);
            border-radius: 4px;
        }

        &::-webkit-scrollbar-thumb {
            background: var(--text-clr);
            border-radius: 4px;
        }

        &::-webkit-scrollbar-thumb:hover {
            background: var(--accent-clr);
        }
    }



    .history-item {
      display: flex;
      align-items: center;
      padding: 0.5rem 0.8rem;
      border-radius: 7px;
      border: 1px solid var(--line-clr);
      background-color: var(--base-clr);
      cursor: pointer;
      transition: var(--transition);
      white-space: nowrap;
    }

    .history-item:hover {
      background-color: rgba(0, 113, 227, 0.08);
    }

    .history-item img {
      width: 20px;
      height: 20px;
      margin-right: 0.5rem;
      border-radius: 50%;
    }

    footer {
      text-align: center;
      padding: 1.5rem;
      color: var(--text-clr);
      font-size: 0.9rem;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes spin {
      to {
        transform: translateY(-50%) rotate(360deg);
      }
    }

    @media (max-width: 768px) {
      h1 {
        font-size: 2rem;
      }
      
      .subtitle {
        font-size: 1rem;
      }
      
      .container {
        padding: 1.5rem 1rem;
      }
      
      .crypto-details img {
        width: 48px;
        height: 48px;
      }
      
      .crypto-details-info h2 {
        font-size: 1.3rem;
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
            <header>
                <h1>Create Wallet</h1>
                <p class="subtitle">
                    Create a new wallet for your cryptocurrency assets. Please ensure to keep your recovery phrase safe and secure.
                </p>
            </header>

            <div class="search-container">
            <div class="search-wrapper">
                <input type="text" id="search-input" placeholder="Search cryptocurrencies..." autocomplete="off">
                <div class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                </div>
                <div class="loader" id="search-loader"></div>
            </div>
            
            <div class="crypto-dropdown" id="search-results">
                <!-- Results will be populated here -->
            </div>
            </div>

            <div class="selected-crypto" id="selected-crypto">
            <p class="empty-state">Search and select a cryptocurrency to view details</p>
            </div>

            <div class="create-wallet-btn-container">
                <button id="createWalletBtn">Create Wallet</button>
            </div>

            <div class="history-container">
            <h3>Recently Viewed</h3>
            <div class="history-list" id="history-list">
                <!-- History will be populated here -->
            </div>
            </div>
        </div>

        <footer>
            <p>Data provided by CoinGecko API</p>
        </footer>




        </div>




    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        class CryptoAPI {
        constructor() {
            this.baseUrl = 'https://api.coingecko.com/api/v3';
            this.cache = new Map();
            this.cacheExpiration = 5 * 60 * 1000; // 5 minutes cache
        }

        async searchCrypto(query) {
            if (!query) return [];
            
            const cacheKey = `search_${query.toLowerCase()}`;
            
            if (this.cache.has(cacheKey)) {
            const cachedData = this.cache.get(cacheKey);
            if (Date.now() < cachedData.expiration) {
                return cachedData.data;
            }
            }
            
            try {
            const response = await fetch(`${this.baseUrl}/search?query=${encodeURIComponent(query)}`);
            
            if (!response.ok) {
                throw new Error('API request failed');
            }
            
            const data = await response.json();
            const coins = data.coins || [];
            
            this.cache.set(cacheKey, {
                data: coins,
                expiration: Date.now() + this.cacheExpiration
            });
            
            return coins;
            } catch (error) {
            console.error('Error searching cryptocurrencies:', error);
            return [];
            }
        }

        async getCryptoDetails(id) {
            if (!id) return null;
            
            const cacheKey = `details_${id}`;
            
            if (this.cache.has(cacheKey)) {
            const cachedData = this.cache.get(cacheKey);
            if (Date.now() < cachedData.expiration) {
                return cachedData.data;
            }
            }
            
            try {
            const response = await fetch(`${this.baseUrl}/coins/${id}?localization=false&tickers=false&market_data=true&community_data=false&developer_data=false`);
            
            if (!response.ok) {
                throw new Error('API request failed');
            }
            
            const data = await response.json();
            
            this.cache.set(cacheKey, {
                data,
                expiration: Date.now() + this.cacheExpiration
            });
            
            return data;
            } catch (error) {
            console.error('Error fetching cryptocurrency details:', error);
            return null;
            }
        }

        clearExpiredCache() {
            const now = Date.now();
            for (const [key, value] of this.cache.entries()) {
            if (now > value.expiration) {
                this.cache.delete(key);
            }
            }
        }
        }

        // UI Handler
        class CryptoUI {
        constructor() {
            this.searchInput = document.getElementById('search-input');
            this.searchResults = document.getElementById('search-results');
            this.selectedCrypto = document.getElementById('selected-crypto');
            this.searchLoader = document.getElementById('search-loader');
            this.historyList = document.getElementById('history-list');
            
            this.activeIndex = -1;
            this.searchResults.addEventListener('mouseover', this.handleMouseOver.bind(this));
        }

        displaySearchResults(results) {
            this.hideLoader();
            this.searchResults.innerHTML = '';
            this.activeIndex = -1;
            
            if (results.length === 0) {
            this.searchResults.innerHTML = `
                <div class="no-results">
                <p>No related crypto found</p>
                </div>
            `;
            this.showDropdown();
            return;
            }
            
            results.forEach((crypto, index) => {
            const item = document.createElement('div');
            item.className = 'crypto-item';
            item.dataset.id = crypto.id;
            item.dataset.index = index;
            
            item.innerHTML = `
                <img src="${crypto.large}" alt="${crypto.name}" onerror="this.src='https://assets.coingecko.com/coins/images/1/large/bitcoin.png'">
                <div class="crypto-info">
                <span class="crypto-name">${crypto.name}</span>
                <span class="crypto-symbol">${crypto.symbol}</span>
                </div>
            `;
            
            item.addEventListener('click', () => this.selectCrypto(crypto));
            this.searchResults.appendChild(item);
            });
            
            this.showDropdown();
        }

        async selectCrypto(crypto) {
            this.showLoader();
            this.hideDropdown();
            
            try {
            const details = await cryptoApi.getCryptoDetails(crypto.id);
            
            if (!details) {
                throw new Error('Failed to fetch cryptocurrency details');
            }
            
            this.selectedCrypto.innerHTML = `
                <div class="crypto-details">
                    <img src="${details.image?.large || crypto.large}" alt="${details.name}" 
                        onerror="this.src='https://assets.coingecko.com/coins/images/1/large/bitcoin.png'">
                    <div class="crypto-details-info">
                        <h2>${details.name} <span class="crypto-symbol">(${details.symbol.toUpperCase()})</span></h2>
                        <p>Current price: $${details.market_data?.current_price?.usd?.toLocaleString() || 'N/A'}</p>
                        <p>Market cap rank: #${details.market_cap_rank || 'N/A'}</p>
                    </div>
                    <input type="hidden" name="crypto_icon" id="crypto_icon" value="${details.image?.large || crypto.large}">
                    <input type="hidden" name="crypto_name" id="crypto_name" value="${details.name}">
                    <input type="hidden" name="crypto_symbol" id="crypto_symbol" value="${details.symbol.toUpperCase()}">
                    <input type="hidden" name="crypto_id" id="crypto_id" value="${details.id}">
                    </div>
            `;
            
            this.addToHistory(crypto);
            } catch (error) {
            console.error('Error displaying cryptocurrency details:', error);
            this.selectedCrypto.innerHTML = `
                <p class="empty-state">Failed to load cryptocurrency details. Please try again.</p>
            `;
            } finally {
            this.hideLoader();
            }
        }

        addToHistory(crypto) {
            const existingItem = document.querySelector(`.history-item[data-id="${crypto.id}"]`);
            if (existingItem) {
            this.historyList.removeChild(existingItem);
            this.historyList.prepend(existingItem);
            return;
            }
            
            const historyItem = document.createElement('div');
            historyItem.className = 'history-item';
            historyItem.dataset.id = crypto.id;
            
            historyItem.innerHTML = `
            <img src="${crypto.thumb}" alt="${crypto.name}" onerror="this.src='https://assets.coingecko.com/coins/images/1/thumb/bitcoin.png'">
            <span>${crypto.symbol.toUpperCase()}</span>
            `;
            
            historyItem.addEventListener('click', () => this.selectCrypto(crypto));
            
            this.historyList.prepend(historyItem);
            
            if (this.historyList.children.length > 10) {
            this.historyList.removeChild(this.historyList.lastChild);
            }
        }

        showDropdown() {
            this.searchResults.classList.add('show');
        }

        hideDropdown() {
            this.searchResults.classList.remove('show');
        }

        showLoader() {
            this.searchLoader.style.display = 'block';
            if (document.querySelector('.search-icon')) {
            document.querySelector('.search-icon').style.display = 'none';
            }
        }

        hideLoader() {
            this.searchLoader.style.display = 'none';
            if (document.querySelector('.search-icon')) {
            document.querySelector('.search-icon').style.display = 'block';
            }
        }

        handleKeyboardNavigation(event, results) {
            const items = this.searchResults.querySelectorAll('.crypto-item');
            
            items.forEach(item => item.classList.remove('active'));
            
            if (event.key === 'ArrowDown') {
            event.preventDefault();
            this.activeIndex = Math.min(this.activeIndex + 1, items.length - 1);
            } else if (event.key === 'ArrowUp') {
            event.preventDefault();
            this.activeIndex = Math.max(this.activeIndex - 1, 0);
            } else if (event.key === 'Enter' && this.activeIndex >= 0 && this.activeIndex < items.length) {
            event.preventDefault();
            this.selectCrypto(results[this.activeIndex]);
            return;
            } else if (event.key === 'Escape') {
            this.hideDropdown();
            return;
            } else {
            return;
            }
            
            if (this.activeIndex >= 0) {
            items[this.activeIndex].classList.add('active');
            items[this.activeIndex].scrollIntoView({ block: 'nearest' });
            }
        }

        handleMouseOver(event) {
            const item = event.target.closest('.crypto-item');
            if (!item) return;
            
            const items = this.searchResults.querySelectorAll('.crypto-item');
            items.forEach(el => el.classList.remove('active'));
            
            this.activeIndex = parseInt(item.dataset.index, 10);
            item.classList.add('active');
        }

        showNoResults() {
            this.searchResults.innerHTML = `
            <div class="no-results">
                <p>No related crypto found</p>
            </div>
            `;
            this.showDropdown();
        }
        }

        // Utility Functions
        function debounce(func, wait) {
        let timeout;
        
        return function(...args) {
            const context = this;
            clearTimeout(timeout);
            
            timeout = setTimeout(() => {
            func.apply(context, args);
            }, wait);
        };
        }

        function saveToStorage(key, value) {
        try {
            sessionStorage.setItem(key, JSON.stringify(value));
        } catch (error) {
            console.error('Error saving to local storage:', error);
        }
        }

        function getFromStorage(key) {
        try {
            const value = sessionStorage.getItem(key);
            return value ? JSON.parse(value) : null;
        } catch (error) {
            console.error('Error retrieving from local storage:', error);
            return null;
        }
        }


        // Create global instances
        const cryptoApi = new CryptoAPI();
        const cryptoUI = new CryptoUI();

        // Initialize App
        document.addEventListener('DOMContentLoaded', () => {
        let currentResults = [];
        
        const handleSearch = async (query) => {
            if (!query || query.trim().length === 0) {
            cryptoUI.hideDropdown();
            return;
            }
            
            cryptoUI.showLoader();
            
            try {
            const results = await cryptoApi.searchCrypto(query);
            currentResults = results;
            
            if (results.length === 0) {
                cryptoUI.showNoResults();
            } else {
                cryptoUI.displaySearchResults(results);
            }
            } catch (error) {
            console.error('Search error:', error);
            cryptoUI.showNoResults();
            }
        };
        
        const debouncedSearch = debounce(handleSearch, 300);
        
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            debouncedSearch(query);
        });
        
        searchInput.addEventListener('focus', () => {
            if (searchInput.value.trim() && currentResults.length > 0) {
            cryptoUI.showDropdown();
            }
        });
        
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            cryptoUI.hideDropdown();
            }
        });
        
        searchInput.addEventListener('keydown', (e) => {
            if (['ArrowDown', 'ArrowUp', 'Enter', 'Escape'].includes(e.key)) {
            cryptoUI.handleKeyboardNavigation(e, currentResults);
            }
        });
        
        setInterval(() => {
            cryptoApi.clearExpiredCache();
        }, 60 * 1000);
        
        searchInput.focus();
        
        const loadHistory = () => {
            const history = getFromStorage('cryptoSearchHistory');
            if (history && Array.isArray(history)) {
            history.forEach(crypto => {
                cryptoUI.addToHistory(crypto);
            });
            }
        };
        
        loadHistory();
        
        window.addEventListener('beforeunload', () => {
            const historyItems = document.querySelectorAll('.history-item');
            const historyData = [];
            
            historyItems.forEach(item => {
            const id = item.dataset.id;
            const symbol = item.querySelector('span').textContent;
            const imgSrc = item.querySelector('img').src;
            
            historyData.push({
                id,
                symbol,
                thumb: imgSrc,
                name: symbol
            });
            });
            
            saveToStorage('cryptoSearchHistory', historyData);
        });
        });


    </script>
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#createWalletBtn').on('click', function() {
            const cryptoId = $('#crypto_id').val();
            const cryptoName = $('#crypto_name').val();
            const cryptoSymbol = $('#crypto_symbol').val();
            const cryptoIcon = $('#crypto_icon').val();

            if (!cryptoName || !cryptoSymbol || !cryptoIcon) {
                showToast('error','Please select a cryptocurrency');
                return;
            }
            
            Swal.fire({
                title: 'Please wait...',
                text: 'Creating your wallet',
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
                    url: '/chain-fortune/action/create_wallet_logic',
                    method: 'POST',
                    data: {
                        crypto_id: cryptoId,
                        crypto_name: cryptoName,
                        crypto_symbol: cryptoSymbol,
                        crypto_icon: cryptoIcon
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
        });
    </script>






</body>
</html>



<script src="/chain-fortune/js/toastify.js" defer></script>
<script src="/chain-fortune/js/jquery-3.6.0.min.js" defer></script>
<style>
    .header-wrapper{
        display: flex;
        align-items: center;
        justify-content: space-between;

        > div .asset-list{
            margin-top: 5px;
            margin-left: 8px;

            @media (max-width: 350px) {
                font-size: 1.3rem;
            }

        }

      
    }

    .action-checkbox{
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
       

        @media (max-width: 360px) {
            flex-direction: column;
            justify-content: start;
            align-items: start;
            gap: 1px;

        }


    }

    .checkbox-wrapper{
        background: transparent;
        padding: 0.5rem;
        &:hover{
            color: var(--accent-clr);
        }


        .checkbox-tile {
            position: relative;
            width: 18px;
            height: 18px;
            border-radius: 6px;
            background-color: var(--base-clr);
            border: 2px solid var(--line-clr);
        }



        .checkbox-icon {
            width: 11px;
            height: 11px;
        }


    }

    .search-container {
        position: relative;
        margin-bottom: 20px;
        margin-top: 30px;
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
        padding: 0.55rem 0.8rem;
        border-radius: 30px;
        color: var(--text-clr);
        font-size: 1rem;
        transition: all 0.3s ease;
        box-sizing: border-box;
        width: 170px;

        @media (max-width: 370px) { 
            width: 120px;
        }

    }

    #searchInput:focus {
        outline: none;
        border-color: var(--accent-clr);
        box-shadow: 0 0 0 4px var(--input-focus-clr);
    }

    #searchInput::placeholder {
        color: var(--secondary-text-clr);
    }



    .coin-list{
        box-shadow: 0 3px 30px rgba(0, 0, 0, 0.212);
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

    .coin-card {
        background-color: var(--base-clr);
        border: 1px solid var(--line-clr);
        border-radius: 7px;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transform: translateZ(0);
        transition: transform 0.2s ease;
        
        &:hover{
            background: var(--hover-clr);
            font-weight: bold;
        }
    }

    .coin-card:active {
        transform: scale(0.98);
    }

    .coin-info {
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
        /* font-weight: bold; */
        color: var(--accent-clr)
        
    }
    .wallet-amount{
        color: var(--secondary-text-clr);
        font-family: 'SF Mono', SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
        /* font-weight: bold; */
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

<?php
    include("../components/big_wallet.php");
?>

<header>
    <div class="header-wrapper">
        <div>
            <h2 class="asset-list">
                Assets List
            </h2>
        </div>
        <div class="search-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="searchInput" placeholder="Search">
        </div>
    </div>

    
    <div class="action-checkbox">
        <label class="checkbox-wrapper checkbox-wrapper1">
            <input type="checkbox" class="checkbox-input" id="check-box">
            <span class="checkbox-tile">
                <span class="checkbox-icon"></span>
            </span>
            <span class="checkbox-label" style="white-space:nowrap; font-weight: 500; font-size: 0.8rem; color: var(--secondary-text-clr)">
                Hide Small Balances
            </span>
        </label>

        <label class="checkbox-wrapper checkbox-wrapper2">
            <input type="checkbox" class="checkbox-input" id="check-box">
            <span class="checkbox-tile">
                <span class="checkbox-icon"></span>
            </span>
            <span class="checkbox-label" style="white-space:nowrap; font-weight: 500; font-size: 0.8rem; color: var(--secondary-text-clr)">
                Simplified List
            </span>
        </label>
    </div>
</header>

<div id="coinList" class="coin-list">
    <div class="loading" id="loading">
        <div class="spinner"></div>
    </div>
   <?php include('../../../backend/fetch_wallet.php');?>
</div>

 <script>
    const $loading = $('#loading');
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var found = false;

        $(".coin-card").each(function() {
            var text = $(this).find(".coin-name-container").text().toLowerCase();
            var match = text.indexOf(value) > -1;
            $(this).toggle(match);
            if (match) found = true; 
        });
        
        if (!found && value.trim() !== "") {
            $loading.show();
            showToast('error', 'Asset not found');
           
        } else {
            $loading.hide();
       
        }
    });
 </script>


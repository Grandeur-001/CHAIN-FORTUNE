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
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="/chain-fortune/js/toastify.js" defer></script>
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[2]
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
            width: 100%;
            padding: 2rem;
        }
        .welcome-text-animation {
        position: relative;
        /* font-family: sans-serif; */
        text-transform: capitalize;
        font-size: 3em;
        font-weight: 700;
        letter-spacing: 4px;
        overflow: hidden;
        background: linear-gradient(90deg, var(--base-clr), var(--accent-clr), var(--base-clr));
        background-repeat: no-repeat;
        background-size: 80%;
        animation: animate 3s linear infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: rgba(255, 255, 255, 0);
        margin-bottom: 4rem;
        }

        @keyframes animate {
        0% {
            background-position: -500%;
        }
        100% {
            background-position: 500%;
        }
        }











        .actions-grid {
            display: grid;
            grid-template-columns: auto auto auto;
            gap: 1rem;
        }

        .action-card {
            background-color: var(--card-gradient);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.2rem;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 3px 30px rgba(0, 0, 0, 0.212);

        }





        .action-card:hover {
            background-color: var(--accent-clr);
            transform: translateY(-3px);

        }
        .action-card:hover svg{
            stroke: var(--text-clr);
        }
        .action-card:hover .edited-svg{
            fill: var(--text-clr);
        }


        .action-card svg {
            width: 24px;
            height: 24px;
            stroke: var(--accent-clr);
        }

        .action-card .edited-svg {
            width: 22px;
            height: 22px;
            fill: var(--accent-clr);
        }
        


        .action-card span {
            font-size: 1rem;
            font-weight: 500;
        }
        @keyframes Arrowup {
            0% {
                transform: translateY(0); 
            }
            50% {
                transform: translateY(-10px); 
            }
            100% {
                transform: translateY(0); 
            }
        }
        @keyframes Arrowdown {
            0% {
                transform: translateY(0); 
            }
            50% {
                transform: translateY(10px); 
            }
            100% {
                transform: translateY(0); 
            }
        }
        @keyframes headShake {
            from {
                -webkit-transform: scale3d(1, 1, 1);
                        transform: scale3d(1, 1, 1);
            }
            10%, 20% {
                -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
                        transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
            }
            30%, 50%, 70%, 90% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
                        transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            }
            40%, 60%, 80% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
                        transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            }
            to {
                -webkit-transform: scale3d(1, 1, 1);
                        transform: scale3d(1, 1, 1);
            }
        }

        .action-card:nth-of-type(3) svg{
            animation: headShake 1s infinite;
        }

        /* QUICK ACTION MOBILE */
        .quick-action-container {
            width: 100%;
            /* background-color: var(--accent-clr); */
            padding: 16px 0;
            border-radius: 16px;
            /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); */
            position: relative;
            display: none;
        }

        .quick-action-list {
            display: flex;
            justify-content: space-around;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .quick-action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 12px;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            width: 64px;
        }

        .quick-action-item:hover {
            background-color: var(--hover-clr);
            transform: translateY(-2px);
        }

        .quick-action-item:active {
            transform: scale(0.95);
        }

        .quick-action-icon {
            width: 28px;
            height: 28px;
            fill: var(--accent-clr);
            filter: drop-shadow(0 2px 4px rgba(94, 99, 255, 0.2));
            transition: all 0.3s ease;
        }
        
        .quick-action-item .edited-svg{
            width: 22px;
            height: 22px;
        }

        .quick-action-item:hover .quick-action-icon {
            fill: var(--text-clr);
            transform: scale(1.1);
        }

        .quick-action-text {
            font-size: 12px;
            color: var(--secondary-text-clr);
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: color 0.3s ease;
            text-transform: capitalize;
        }

        .quick-action-item:hover .quick-action-text {
            color: var(--text-clr);
        }

        .quick-action-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 16px;
            pointer-events: none;
        }

        .quick-action-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .quick-action-item:hover::before {
            opacity: 1;
        }

                
        .search-container {
            margin-top: 30px;
            margin-bottom: 20px;
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

        .search-input:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        .search-input::placeholder {
            color: var(--secondary-text-clr);
        }

        .crypto-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .crypto-item {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            transition: transform 0.2s;
        }
        .crypto-logo{
            width: 40px;
            height: 40px;
            margin-right: 16px;
            border-radius: 50%;
        }
        

        .crypto-info {
            /* font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; */
            flex-grow: 1;
        }

        .crypto-pair {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-clr);
            margin-bottom: 4px;
        }

        .crypto-name {
            color: var(--secondary-text-clr);
            font-size: 14px;
        }

        .crypto-price-container {
            text-align: right;
        }

        .crypto-price {
            font-size: 17px;
            color: var(--text-clr);
            display: block;
            margin-bottom: 4px;

        }

        .price-change {
            display: inline-block;
            padding: 5px 13px;
            border-radius: 30px;
            margin-top: 8px;
            font-weight: 500;
            font-size: 13px;
            /* margin-right: 8px; */
        }

        .price-up {
            background-color: rgba(52, 199, 89, 0.2);
            color: #34c759;
        }

        .price-down {
            background-color: rgba(255, 59, 48, 0.2);
            color: #ff3b30;
        }

        .loading,
        .error-message {
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            margin: 10px 0;
        }

        .error-message {
            color: #ff3b30;
        }

        .retry-button {
            background-color: var(--accent-clr);
            color: var(--text-clr);
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            margin-top: 10px;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-left: 6px;
        }

        .retry-button:hover {
            opacity: 0.9;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            color: var(--secondary-text-clr);
        }




        @media (max-width: 800px) {
            #main{
                margin-left: 0;
            }
            .app-container {
                padding: 0.7rem;
            }
            .wallet-header{
                padding: 1rem;

            }

            .balance {
                font-size: 2.5rem;
            }

            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
                display: none;
            }
            .quick-action-container {
                display: block;
            }

        }

        @media (max-width: 480px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }

            .balance {
                font-size: 2rem;
            }

            .quick-action-container {
                padding: 12px 0;
            }

            .quick-action-item {
                width: 56px;
                padding: 8px;
            }

            .quick-action-icon {
                width: 24px;
                height: 24px;
            }

            .quick-action-text {
                font-size: 11px;
            }
            .crypto-item {
                padding: 16px;
            }
            
            .crypto-pair {
                font-size: 14px;
            }
            
            .crypto-price {
                font-size: 14px;
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
       
            <?php include("../components/balance_card.php"); ?>
    
            <br><br>
            <div class="actions-grid">
                <div onclick="location.href=``" class="action-card primary">
                    <svg  width="24" height="24"xmlns="http://www.w3.org/2000/svg" class="edited-svg" stroke="" viewBox="64 64 896 896" focusable="false"><defs><style/></defs><path d="M931.4 498.9L94.9 79.5c-3.4-1.7-7.3-2.1-11-1.2a15.99 15.99 0 00-11.7 19.3l86.2 352.2c1.3 5.3 5.2 9.6 10.4 11.3l147.7 50.7-147.6 50.7c-5.2 1.8-9.1 6-10.3 11.3L72.2 926.5c-.9 3.7-.5 7.6 1.2 10.9 3.9 7.9 13.5 11.1 21.5 7.2l836.5-417c3.1-1.5 5.6-4.1 7.2-7.1 3.9-8 .7-17.6-7.2-21.6zM170.8 826.3l50.3-205.6 295.2-101.3c2.3-.8 4.2-2.6 5-5 1.4-4.2-.8-8.7-5-10.2L221.1 403 171 198.2l628 314.9-628.2 313.2z"/></svg>
                    <span>Send</span>
                </div>
                
                <div onclick="location.href=`<?php echo $deposit_url; ?>`" class="action-card">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 14l-7 7-7-7" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Deposit</span>
                </div>
                
                <div onclick="location.href=`/chain-fortune/admin/sell`" class="action-card">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Sell</span>
                </div>
                
                <div onclick="location.href=`<?php echo $exchange_url; ?>`" class="action-card">
                    <svg width="25px" height="25px" viewBox="64 64 896 896" class="edited-svg" focusable="false">
                        <path d="M847.9 592H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h605.2L612.9 851c-4.1 5.2-.4 13 6.3 13h72.5c4.9 0 9.5-2.2 12.6-6.1l168.8-214.1c16.5-21 1.6-51.8-25.2-51.8zM872 356H266.8l144.3-183c4.1-5.2.4-13-6.3-13h-72.5c-4.9 0-9.5 2.2-12.6 6.1L150.9 380.2c-16.5 21-1.6 51.8 25.1 51.8h696c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"/>
                    </svg>
                    <span>Exchange</span>
                </div>
                
                <div onclick="location.href=`<?php echo $withdrawal_transactions_url; ?>`" class="action-card">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="" stroke-width="2"/>
                        <path d="M12 6v6l4 2" stroke="" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span>Withdrawal History</span>
                </div>

                <div onclick="location.href=`<?php echo $withdraw_url; ?>`" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <!-- Rounded rectangle for the main shape -->
                        <rect x="2" y="4" width="20" height="12" rx="2" ry="2" />
                        
                        <!-- Two vertical lines for the sides -->
                        <line x1="6" y1="8" x2="6" y2="12" />
                        <line x1="18" y1="8" x2="18" y2="12" />
                        
                        <!-- Circle in the center -->
                        <circle cx="12" cy="10" r="2" />
                        
                        <!-- Downward arrow -->
                        <path d="M12 16 L12 20 M9 18 L12 21 L15 18" />
                    </g>
                </svg>
                    <span>Withdraw</span>
                </div>
            </div>

           

            <br>
            

            <?php 
                include "../components/stats.php";
            ?>

     
            <?php 
                include "../components/wallet.php";
            ?>
            <br><br>
           

            <div style="margin-bottom: 30px;"></div>


            <?php 
                include "../components/top_stories.php";
            ?>

            

        </div>
    </main>

    



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
</body>
</html>

<!-- dkwd oftp mypg gsfq -->
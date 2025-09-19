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
            margin-bottom: 20px;
            text-align: center;
            color:var(--text-clr)
            }
            .app-container p {
                font-size: 1rem;
                color: var(--secondary-text-clr);
                margin-bottom: 40px;
                text-align: center;
                margin-inline: 10px;
                line-height: 1.6;
            }
            /* Mobile Optimizations */
            @media (max-width: 800px) {
                
                h1 {
                    font-size: 2rem;
                    margin-bottom: 24px;
                }
                p{
                    font-size: 0.9rem;
                    margin-bottom: 16px;
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
            <div>
                <h1>Market Chart</h1>
                <p>Check out the latest market trends and prices for your favorite cryptocurrencies.</p>
            </div>
            <div>
                <iframe scrolling="no" allowtransparency="true" frameborder="0"
                    style="user-select: none; box-sizing: border-box; display: block; height: 610px; width: 100%; background: transparent;"
                    src="https://www.tradingview-widget.com/embed-widget/market-overview/?locale=en#%7B%22colorTheme%22%3A%22dark%22%2C%22dateRange%22%3A%2212M%22%2C%22showChart%22%3Atrue%2C%22largeChartUrl%22%3A%22%22%2C%22isTransparent%22%3Atrue%2C%22showSymbolLogo%22%3Atrue%2C%22showFloatingTooltip%22%3Afalse%2C%22width%22%3A%22100%25%22%2C%22height%22%3A610%2C%22tabs%22%3A%5B%7B%22title%22%3A%22Crypto%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22BINANCE%3ABTCUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AETHUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ABNBUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AXRPUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AADAUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ADOGEUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ALTCUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ADOTUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ATRXUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ASOLUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ASHIBUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AUSDCUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AUSDTUSD%22%7D%5D%7D%5D%7D">
                </iframe>
            </div>


        </div>




    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>





</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <title>MetaTrader 5 | Chain Fortune</title>
    <script src="/chain-fortune/js/w3.js"></script>
    <?php 
        include "../components/index_style.php";
    ?>
   
</head>

<body>
    <?php 
        include "../components/index_header.php";
    ?>
    <div style="margin-top: 5rem;"></div>

    <!-- sections wrapper start -->
    <div class="sections-wrapper" style="overflow: hidden;">
        <div style="padding-top: 2rem; margin-bottom: 1rem;">
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Three Major Measures to Safeguard Asset Security";
                $headText = "MetaTrader 5 (MT5)";
                include("../components/heading_text.style.php");
                include("../components/heading_text.php");
                
            ?>
            <style>
                .head-text::after{
                    display: none;
                }
            </style>
            
        </div>
        <div style="margin: auto; width: 87%;">
            <p style="text-align: center; margin-bottom: 1.2rem;">
            Trade CFDs on your favourite trading instruments using the MetaTrader 5. A powerful platform for currency pairs and other financial instruments CFD trading, the MetaTrader 5 is free to download on <?php include("../components/company_name.php"); ?>.
            </p>
            <div style="width: 300px; margin:auto;">
                <?php 
                    $buttonFilledText = "download metatrade 5";
                    $buttonFilledHref = "../auth/signup";
                    include("../components/button_filled.php"); 
                ?>
            </div>
        </div>
        <style>
            .metatrade-layout{
                display: flex;
                flex-direction: column;
                gap: 20px;
                padding: 3rem;
                width: 100%;
                margin-top: 70px;
                @media (max-width: 900px) {
                    padding: 1.2rem;
                }

                .metatrade-layout-header{
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    width: 50%;
                    @media (max-width: 900px) {
                        width: 80%;
                    }
                    @media (max-width: 500px) {
                        width: 100%;
                    }


                    h4{
                        color: var(--accent-clr);
                        margin-bottom: 7px;
                    }
                    h2{
                        margin-bottom: 6px;
                    }
                }
                
                .metatrade-list-layout{
                    display: flex;
                    flex-direction: column;
                    gap: 20px;
                    margin-top: 20px;
                    
                    > div{
                        display: flex;
                        align-items: center;
                        gap: 17px;

                        span{
                            height: 23px;
                            width: 23px;
                            background-color: var(--accent-clr);
                            border-radius: 50%;
                            display: grid;
                            place-content: center;
                            font-weight: 500;
                        }

                        p{
                            font-weight: 500;
                            color: var(--text-clr);
                        }
                    }
                }
            }
        </style>
        <div class="metatrade-layout">
            <div class="metatrade-layout-header">
                <h4>MetaTrader 5</h4>
                <h2>What you can trade on MT5</h2>
                <p>At <?php include("../components/company_name.php"); ?>, you can enjoy trading CFDs on more than 200 instruments, which include trading forex currency pairs, metals, cryptocurrencies, stocks, indices and energies.</p>
            </div>

            <div class="metatrade-list-layout">
                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Forex
                    </p>

                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Metals
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Energies
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Stocks
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Indices
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Cryptocurrencies
                    </p>
                </div>
            </div>
        </div>

        <div style="padding-top: 2rem; margin-bottom: 0.3rem;">
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Three Major Measures to Safeguard Asset Security";
                $headText = "Why Trade With Chain Fortune on MetaTrader 5?";
                include("../components/heading_text.style.php");
                include("../components/heading_text.php");
                
            ?>
            <style>
                .head-text::after{
                    display: none;
                }
            </style>
            
        </div>
        <div class="features card-wrapper" id="MetaTrader-5-card-wrapper">
            <div w3-repeat="MetaTrader-5" class="move_in feature-card card">
                <div class="icon">{{icon}}</div>
                <h3> {{title}} </h3>
                <p> {{paragraph}} </p>
            </div>
            
        <script>
            let cardObject = {"MetaTrader-5":[
                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"MetaEditor",
                    "paragraph":"On MetaTrader 5, you can develop trading robots and technical indicators through the specialized MetaEditor tool. As the tool is linked with the platform, new programs will automatically appear in your MetaTrader 5 and can be executed instantly."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Hedging system",
                    "paragraph":"In MetaTrader 5 with <?php include("../components/company_name.php"); ?>, you can experience trading using the hedging mode system. Hedging allows you to open multiple positions, even exact opposite positions, for a trading instrument."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Fundamental analysis",
                    "paragraph":"Capture market opportunities with fundamental analysis tools on the MetaTrader 5, such as the built-in Economic Calendar. Keep abreast of the latest news events, expected market impacts and forecasts."
                },
                // 
                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Indicators & analytical object tools",
                    "paragraph":"Enhance your trading experience with 38 built-in indicators, 22 analytical tools and 46 graphical objects when you trade financial instruments in the trading platform."
                },

   
                
            ]};

            w3.displayObject("MetaTrader-5-card-wrapper", cardObject);
        </script>
         











        


        </div>

        <div>
            <div>
                <img src="/chain-fortune/images/" alt="">
            </div>
        </div>
    </div>
    <!-- sections wrapper end -->

    


    
    <?php 
        include "../components/scroll_up.php";
        include "../components/index_footer.php";
        include "../components/bottom_crypto_ticker.php";
    ?>
    <script src="/chain-fortune/js/scroll_animation.js"></script>
    <script src="/chain-fortune/js/Three.mjs"></script>
 
 

</body>
</html>
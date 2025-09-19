
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <title>MetaTrader 5 Mobile | Chain Fortune</title>
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
                $headText = "MetaTrader 5 App for Android and iOS";
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
                We offer both MetaTrader 4 and MetaTrader 5 as an application on Android-based devices. These applications give traders easy access to their accounts wherever they are. The AmaniLightEquity MetaTrader Android application gives you access to our tight spreads and fast execution speeds directly on your Android-based mobile. It features fast one click trading from multiple screens and customisable layouts. With full access to historical data and advanced charting facilities, you can manage your account, trade our full list of products, and use over 30 technical indicators for market analysis.
            </p>
            <div style="width: 200px; margin:auto;">
                <?php 
                    $buttonFilledText = "start trading";
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
                <h2>METATRADER 5 Advantages</h2>
                <p>Metatrader 5 (MT5) is the new financial trading platform among Forex and CFD from MetaQuotes Software Corp, to replace MetaTrader 4. CypherBlockSage, alongside Metatrader 5, provides its traders FREE add-ons and indicators when trading.</p>
            </div>

            <div class="metatrade-list-layout">
                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                        You can open even 100 charts at a time
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    The charting system comes with 21 time-frames
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    There are 40+ graphical objects
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    There are 50+ technical indicators
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    There are 4 scaling modes
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
                    "title":"Customer/Technical Support",
                    "paragraph":"Access to MT5 platform specialists 24/5"
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"More Than 50 FX Pairs To Trade On",
                    "paragraph":"Long or short, spreads starting from 0.3 pips"
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Advanced Trading Platform",
                    "paragraph":"Enjoy the cutting-edge features of MetaTrader 5, including enhanced charting tools, multiple order types, and superior execution speeds."
                },
                // 
                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Multi-Asset Trading",
                    "paragraph":"Trade forex, commodities, indices, stocks, and cryptocurrencies all in one platform with advanced trading capabilities."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Fast Order Execution",
                    "paragraph":"Benefit from lightning-fast trade execution speeds, minimizing slippage and ensuring optimal market entry and exit."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Customizable Trading Tools",
                    "paragraph":"Utilize advanced indicators, automated trading strategies (EAs), and customizable charts to enhance your trading efficiency."
                },
                
            ]};

            w3.displayObject("MetaTrader-5-card-wrapper", cardObject);
        </script>
         











        


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
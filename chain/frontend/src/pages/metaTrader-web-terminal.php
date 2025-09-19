
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <title>MetaTrader WebTerminal | Chain Fortune</title>
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
                $headText = "Trade Forex from anywhere on MetaTrader WebTerminal!";
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
            MetaTrader WebTerminal offers fast order execution capabilities of MetaTrader with ease and convenience of being a web-based application. MetaTrader WebTrader is a user friendly web-based trading platform allowing you to enjoy trading in the IC Markets Global trading environment with no dealing desk from anywhere in the world. MetaTrader WebTerminal has the same tight spreads, Level II Pricing, and one-click trading as the MetaTrader desktop version along with features such as a personalized trader dashboard to allow monitoring of your positions at a glance.
            </p>
            <div style="width: 300px; margin:auto;">
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
                <h4>MetaTrader WebTerminal</h4>
                <h2>Functionality of Web Terminal</h2>
                <p>
                    Web Terminal is almost identical to the desktop MetaTrader. This ensures the web platform's high reliability and compatibility with the entire MetaTrader ecosystem. The application is safe to use - all transmitted data is securely encrypted.
                </p>
            </div>

            <div class="metatrade-list-layout">
                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    One-click trading
                    </p>

                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Multilingual interface
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                        Fully customized chartsEnergies
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                        Stop loss/take operations
                    </p>
                </div>

                <div>
                    <span>
                        <i class="ri-check-fill"></i>
                    </span>
                    <p>
                    Indicators
                    </p>
                </div>

                
            </div>
        </div>

        <div style="padding-top: 2rem; margin-bottom: 0.3rem;">
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Three Major Measures to Safeguard Asset Security";
                $headText = "Why Trade Via MetaTrader WebTerminal?";
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
                    "title":"Automated Trading",
                    "paragraph":"With MetaTrader WebTerminal you can set up your own automated trading algorithms."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"More Than 50 FX Pairs",
                    "paragraph":"Trade forex with CypherBlockSage MetaTrader WebTerminal spreads starting at just 0.3 pips, long and short."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Customizable charts",
                    "paragraph":"The MetaTrader WebTerminal platform gives you the option to adjust trading charts to your own preferences."
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
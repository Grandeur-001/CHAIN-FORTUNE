
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
                $headText = "Why Trade Via Chain Fortune";
                include("../components/heading_text.style.php");
                include("../components/heading_text.php");
                
            ?>
            <style>
                .head-text::after{
                    display: none;
                }
            </style>
            <div style="margin: auto; width: 87%;">
                <p style="text-align: center; margin-bottom: 1.2rem;">
                    Better-than-market conditions, unique features and cutting-edge security, partnered with our dedication to transparency and excellent customer service, are the reasons traders continue to choose Chain Fortune.
                </p>
                <div style="width: 200px; margin:auto;">
                    <?php 
                        $buttonFilledText = "start trading";
                        $buttonFilledHref = "../auth/signup.php";
                        include("../components/button_filled.php"); 
                    ?>
                </div>
            </div>
            
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
                    "title":"Instant Withdrawals",
                    "paragraph":"Remain in control of your funds. Simply choose your preferred payment method, make a withdrawal request, and enjoy instant automatic approval."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Ultra-Fast Execution",
                    "paragraph":"Stay ahead trends with lightening-fast execution. Get your orders executed in milliseconds on all available platforms at <?php include("../components/company_name.php"); ?>"
                },

                 {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Stop Out Protection",
                    "paragraph":"Enjoy our unique stop out Protection feature. Delay and sometimes completely avoid stop outs while trading with <?php include("../components/company_name.php"); ?>"
                },


                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Trusted Broker with a Global Presence",
                    "paragraph":"<?php include("../components/company_name.php"); ?> has built a strong reputation by providing top-tier brokerage services to thousands of traders worldwide, ensuring transparency, reliability, and client satisfaction."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Advanced Security & Fund Protection",
                    "paragraph":"At <?php include("../components/company_name.php"); ?>, we prioritize the safety of our clients' funds through strict regulatory compliance, negative balance protection, and secure partnerships with Tier 1 banks."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Cutting-Edge Trading Technology",
                    "paragraph":"We offer an intuitive and fast trading platform equipped with advanced tools, real-time market data, and seamless execution to enhance your trading experience."
                },
                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Diverse Investment Opportunities",
                    "paragraph":"<?php include("../components/company_name.php"); ?> provides access to Forex, cryptocurrencies, commodities, and stocks, allowing traders to diversify their portfolios and maximize their earning potential."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"Dedicated Customer Support",
                    "paragraph":"Our expert support team is available 24/5 to assist traders with any inquiries, ensuring a smooth and hassle-free trading experience for all our clients."
                },

                {
                    "icon": `<img width="50px" src="/chain-fortune/images/tower.png" alt="">`,
                    "title":"MT5 Trading Platform",
                    "paragraph":"<?php include("../components/company_name.php"); ?> gives its clients the chance to trade on the world's most accredited and heavily regulated platform, MetaTrader 5."
                },
                
            ]};

            w3.displayObject("MetaTrader-5-card-wrapper", cardObject);
        </script>

        


        </div>
    </div>
    <div style="width: 200px; margin:auto;">
        <?php 
            $buttonFilledText = "create account";
            $buttonFilledHref = "../auth/signup.php";
            include("../components/button_filled.php"); 
        ?>
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
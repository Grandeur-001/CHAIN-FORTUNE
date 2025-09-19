
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <title>Markets - Chain Fortune</title>
    <script src="/chain-fortune/js/w3.js"></script>
    <?php 
        include "../components/index_style.php";
    ?>
   <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .tabs-container {
            background: var(--base-clr);
            border-radius: 10px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tabs-header {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            position: relative;
        }

        .tabs-header::-webkit-scrollbar {
            display: none;
        }

        .tab-button {
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: none;
            color: var(--secondary-text-clr);
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            white-space: nowrap;
            transition: all 0.3s ease;
            position: relative;
            border-radius: 8px;
        }

        .tab-button::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--accent-clr);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .tab-button.active {
            color: var(--text-clr);
            background: var(--hover-clr);
            color: var(--accent-clr);
        }

        .tab-button.active::after {
            transform: scaleX(1);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        .content-text {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .content-image {
            flex: 0 0 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .content-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        h1 {
            color: #fff;
            padding-bottom: 1rem;
            font-size: 2rem;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .tab-content.active {
                flex-direction: column;
            }

            .content-image {
                flex: 0 0 auto;
                width: 100%;
                max-width: 500px;
                margin: 0 auto;
            }

            .tabs-container {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 1rem;
            }

            .tab-button {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            h1 {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php 
        include "../components/index_header.php";
    ?>
    <div style="margin-top: 10rem;"></div>


    <div class="container">
        <h1>Our Markets</h1>
        <p style="text-align: center; margin-bottom: 2rem; width: 80%; margin:auto;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere, iste deserunt numquam nesciunt odio reiciendis optio eos doloribus hic, ipsa mollitia necessitatibus fugiat minima, nemo tempore sed esse nostrum. Eos?</p>
        <br><br>
        <div class="tabs-container">
            <div class="tabs-header">
                <button class="tab-button active" data-tab="tab1">Cryptocurrencies</button>
                <button class="tab-button" data-tab="tab2">Real Estate</button>
                <button class="tab-button" data-tab="tab3">Gold</button>
                <button class="tab-button" data-tab="tab4">Oil and Gas</button>

                <button class="tab-button" data-tab="tab5">Renewable Energy</button>
                <button class="tab-button" data-tab="tab6">Shocked Indices</button>
                <button class="tab-button" data-tab="tab7">Commodities</button>
                <button class="tab-button" data-tab="tab8">Marijuana</button>
 
            </div>

            <div class="tab-content active" id="tab1">
                <div class="content-text">
                    <h2>Real Cryptocurrency Trading</h2>
                    <p>
                        
                        Our powerful computing system is optimized for the issuance of Bitcoin, Ethereum, Tether, Dodge, LiteCoin, Tron, and other decentralized cryptocurrencies. Chain Fortune has developed high-performance servers, dedicated to mining for Bitcoin, Ethereum, Tether, Dodge, Tron, LiteCoin and other most popular cryptocurrencies, also providing other high quality Worldwide services..
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos velit ratione ea mollitia consectetur voluptatibus ipsam recusandae adipisci quis dicta enim, non est alias sint impedit architecto dignissimos omnis aspernatur.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos velit ratione ea mollitia consectetur voluptatibus ipsam recusandae adipisci quis dicta enim, non est alias sint impedit architecto dignissimos omnis aspernatur.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos velit ratione ea mollitia consectetur voluptatibus ipsam recusandae adipisci quis dicta enim, non est alias sint impedit architecto dignissimos omnis aspernatur.
                    </p>
                </div>
                <div class="content-image">
                    <img src="/chain-fortune/images/business-person-looking-finance-graphs.jpg" alt="Technology">
                </div>
            </div>

            <div class="tab-content" id="tab2">
                <div class="content-text">
                    <h2>Real Estate</h2>
                    <p>We offer investment options in most cities important for property multi-family, office, commercial and hotels.</p>
                </div>
                <div class="content-image">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f" alt="Features">
                </div>
            </div>

            <div class="tab-content" id="tab3">
                <div class="content-text">
                    <h2>Gold</h2>
                    <p>Of all the precious metals, the gold is the most popular as investment. The investors usually buy or like a way to diversify risk, especially through the use of futures and derivatives contracts.</p>
                </div>
                <div class="content-image">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3" alt="Resources">
                </div>
            </div>

            <div class="tab-content" id="tab4">
                <div class="content-text">
                    <h2>Oil and Gas</h2>
                    <p>Oil makes the world go round and no sign of that changing soon.</p>
                </div>
                <div class="content-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c" alt="Community">
                </div>
            </div>
        </div>
        <div style="margin-block: 3rem;"></div>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            function switchTab(tabId) {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to selected button and content
                const selectedButton = document.querySelector(`[data-tab="${tabId}"]`);
                const selectedContent = document.getElementById(tabId);

                selectedButton.classList.add('active');
                selectedContent.classList.add('active');
            }

            // Add click event listeners to all tab buttons
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const tabId = button.getAttribute('data-tab');
                    switchTab(tabId);
                });
            });
        });
    </script>

    


    
    <?php 
        include "../components/scroll_up.php";
        include "../components/index_footer.php";
        include "../components/bottom_crypto_ticker.php";
    ?>
    <script src="/chain-fortune/js/scroll_animation.js"></script>
    <script src="/chain-fortune/js/Three.mjs"></script>
 
 

</body>
</html>
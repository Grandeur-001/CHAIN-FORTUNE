<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

 

        .ticker-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .ticker-wrapper {
            display: flex;
            white-space: nowrap;
            width: fit-content;
        }

        .ticker-item {
            display: inline-block;
            /* padding: 15px 0; */
            animation: ticker-scroll 20s linear infinite;
        }

        .ticker-content {
            /* color: var(--text-clr); */
            font-size: 25px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 0 10px;
            background-color: #000;
        }

        @keyframes ticker-scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .ticker-content {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .ticker-content {
                font-size: 22px;
            }
        }

        @media (max-width: 320px) {
            .ticker-content {
                font-size: 18px;
            }
        }

        /* White background for the ticker */
        .ticker-stripe {
            border-top: 2px solid var(--accent-clr);
            border-bottom: 2px solid var(--accent-clr);

            padding: 10px 0;
        }

        .ticker-stripe .ticker-content {
            color: var(--accent-clr);
            /* background-color: #fff; */
        }
    </style>
<div class="ticker-container">
        <div class="ticker-stripe">
            <!-- First ticker for seamless looping -->
            <div class="ticker-wrapper">
                <div class="ticker-item">
                    <span class="ticker-content">- MOBILE APP DEVELOPMENT -</span>
                    <span class="ticker-content">- BACKEND DEVELOPMENT -</span>
                    <span class="ticker-content">- FRONTEND DEVELOPMENT -</span>
                    <span class="ticker-content">- DESKTOP APPLICATIONS -</span>
                    <span class="ticker-content">- GAME DEVELOPEMENT -</span>
                    <span class="ticker-content">- WEBSITE DEVELOPEMENT -</span>
                </div>
                <!-- Duplicate for seamless looping -->
                <div class="ticker-item">
                    <span class="ticker-content">- MOBILE APP DEVELOPMENT -</span>
                    <span class="ticker-content">- BACKEND DEVELOPMENT -</span>
                    <span class="ticker-content">- FRONTEND DEVELOPMENT -</span>
                    <span class="ticker-content">- DESKTOP APPLICATIONS -</span>
                    <span class="ticker-content">- GAME DEVELOPEMENT -</span>
                    <span class="ticker-content">- WEBSITE DEVELOPEMENT -</span>
                </div>
            </div>
        </div>
    </div>
    <!-- <a href="../images/C++-Logo.wine (1).svg"></a> -->
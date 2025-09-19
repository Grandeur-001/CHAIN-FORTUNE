<style>

    .download-metatrader{
        width: 100%;
        background: var(--base-clr);
        display: flex;
        flex-direction: column;
        justify-content: center;

        .download-metatrader-card1{
            height: 300px;
            width: 100%;
            background-color: var(--black-clr);
        }
        .download-metatrader-card2{
            height: 250px;
            width: 80%;
            margin: auto;
            background-color: var(--hover-clr);
            border-radius: 1rem;
            z-index: 3;
            transform: translateY(-70px);
            text-align: center;

        }
    }
    
</style>

<div class="download-metatrader">
    <div class="download-metatrader-card1"></div>
    <div class="download-metatrader-card2">
    <div style="padding-top: 1rem; margin-bottom: 1rem;">
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Three Major Measures to Safeguard Asset Security";
                $headText = "Download MetaTrader 5";
                include("../components/heading_text.style.php");
                include("../components/heading_text.php");
                
            ?>
            <style>
                .head-text::after{
                    display: none;
                }
            </style>
            
        </div>
        <div style="margin: auto; display:flex; justify-content:center; flex-direction:column; width: 100%;">
            <p style="text-align: center; margin-bottom: 1.2rem;">
                Trade without trade offs with the most popular platform
            </p>
            <div style="width: 100%; display:flex; align-items:center; justify-content:center;">
                <?php 
                    $buttonFilledText = "Download MetaTrader 5";
                    $buttonFilledHref = "../auth/signup.php";
                    include("../components/button_filled.php"); 
                ?>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Chain Fortune </title>
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: var(--base-clr);
            color: var(--text-clr);
            min-height: 100vh;
            /* display: flex; */
            justify-content: center;
            align-items: flex-start;
        }
        a {
            color: var(--accent-clr);
            text-decoration: none;
        }

        .faq-container {
            /* max-width: 800px; */
            width: 100%;
            margin-top: 2rem;
            padding: 0 1rem;
        }

        .faq-container h1 {
            text-align: center;
            color: var(--text-clr);
            font-size: var(--large-font-size);
            padding: 0 1rem;
            margin-bottom: 5rem;
            position: relative;
        }
        
        .faq-container h1::after{
            z-index: -1;
            content: "Frequently Asked Questions";
            position: absolute;
            color: var(--hover-clr);
            opacity: 0.6;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 55px;
            transform: translateY(-40px);
        }
        @media (max-width: 820px) {
            .faq-container h1::after{
                font-size: 40px;
            }
            
        }
        @media (max-width: 560px) {
            .faq-container h1::after{
                font-size: 37px;
            }
        }

        .faq-item {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .faq-item:active {
            transform: scale(0.98);
        }

        .faq-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem;
            cursor: pointer;
            transition: background-color 0.4s ease;
        }

        .faq-header:hover {
            background-color: var(--hover-clr);
        }

        .faq-header h3 {
            color: var(--text-clr);
            font-size: var(--medium-font-size);
            padding-right: 1rem;
        }

        .icon {
            color: var(--accent-clr);
            font-size: 1.25rem;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 20px;
            text-align: center;
        }

        .faq-item.active .icon {
            transform: rotate(45deg);
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-content p {
            padding: 1.25rem;
            color: var(--secondary-text-clr);
            line-height: 1.6;
            font-size: var(--small-font-size);
        }

        .faq-item.active .faq-content {
            max-height: 1000px;
        }

        .faq-item.active {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 480px) {
           
            
            .faq-container {
                margin-top: 1rem;
            }
            
            .faq-header {
                padding: 1rem;
            }
            
            .faq-content p {
                padding: 1rem;
            }
        }

        @media (max-width: 320px) {
           
            
            .faq-header {
                padding: 0.875rem;
            }
            
            .faq-content p {
                padding: 0.875rem;
            }
            
            h1 {
                margin-bottom: 1.5rem;
            }
        }
        .faq-wrapper{
            width: 50%;
        }
        @media (max-width: 660px) {
            .faq-container main{
                flex-direction: column;
                gap: 0;
                
                
                > .faq-wrapper{
                    width: 100%;
                }
            }

           
        }
    </style>
</head>

<body>
    <?php
        include("../components/index_header.php");
    ?>

    <div style="margin-top: 10rem;"></div>
 

    <div style="margin-bottom: 5rem;"></div>

    

    <!-- faq start -->
    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>
        
        <main style="display: flex; gap: 20px">
            <div class="faq-wrapper">
                <div class="faq-item">
                    <div class="faq-header">
                        <h3>Is <?php include("../components/company_name.php"); ?> incorporated?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p><?php include("../components/company_name.php"); ?> is a legal financial investment company incorporated in Norway.</p>
                    </div>
                </div>
                <div class="faq-item">
            
                    <div class="faq-header">
                        <h3> Who is qualified to open an account with <?php include("../components/company_name.php"); ?> ?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Any individual (except for persons under the age of 18; as well as citizens of any countries where the Company does not provide their specified services).
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How do I start investment with <?php include("../components/company_name.php"); ?> ?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            All you need to pass a simple registration. After registration, login into your Company Name account then go to the investment section and open your first deposit.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How may I become a client of <?php include("../components/company_name.php"); ?> ?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            You may become a client of <?php include("../components/company_name.php"); ?> and it is totally free of charge. All you need is to sign up and fill all required fields..
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>Is it free of charge to open an account?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Yes, it is totally free of charge.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How long does it take to make my client account active ?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Your account will be active immediately after registration.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How may I access my account ?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            You may log into your account by clicking the link Login and enter your email address and password.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How can I control my account ?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            In order to control your account you need to use navigation menu in the left side of our website.
                        </p>
                    </div>
                </div>
            </div>

            <div class="faq-wrapper">
                <div class="faq-item">
                    <div class="faq-header">
                        <h3>May I change my account details?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            You may change your account details on Profile page.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How secure user accounts and personal data?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            All stored data on our servers remains protected via encryption technology all the time. All account related transactions done by our clients are mediated exclusively via secured internet connections.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How many accounts can I open on the site?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Any client can have only one account. In the event of multiple registrations from your device we have rights to suspend all of your accounts.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>When the deposit should be activated?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Your deposit should be activated immediately if you use Perfect Money. If you use cryptocurrencies it could be some time which is required for getting confirmations by the cryptocurrency network. For deposits in cryptocurrencies we need at least 1 confirmation. If your deposit hasn't appear in your account for a long time, please contact us.
                        </p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-header">
                        <h3>Where can I read about the investment plans?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            You can check all actual investment plans in your member area on Make Deposit page.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How can I withdraw my profit?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            In order to withdraw your profit you need to navigate to "cashout" page in your Cabinet. Please input payout amount and choose payment system which you have used for making your deposits.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>Where are my transactions?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Click on the finance icon, then look for "Transactions" on the menu list, click on it to view all transactions.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How soon after withdrawal request will the money appear on my payment account?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            Your request will be processed instantly. We do everything possible to reduce awaiting time of our clients.
                        </p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-header">
                        <h3>How do I resolve issues?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-content">
                        <p>
                            If you require any assistance you can always reach out to <a href="mailto:support@chainfortune.com">support@chainfortune.com</a> via email.
                        </p>
                    </div>
                </div>
            </div>
        </main>

        
    </div>
    <div style="margin-block: 5rem;"></div>
    <!-- faq start -->
    <?php 
        include "../components/scroll_up.php";
        include "../components/index_footer.php";
        include "../components/bottom_crypto_ticker.php";

    ?>

     <script>
        $(document).ready(function() {
            $('.faq-header').click(function() {
                const faqItem = $(this).parent();
                
                if(faqItem.hasClass('active')) {
                    faqItem.removeClass('active');
                    $(this).css('background', 'var(--base-clr)'); 
                    
                } else {
                    $('.faq-item').removeClass('active');
                    faqItem.addClass('active');
                    $(this).css('background', 'var(--hover-clr)'); 

                }
            });
        });
     </script>
    <script src="/chain-fortune/js/scroll_animation.js"></script>

</body>
</html>
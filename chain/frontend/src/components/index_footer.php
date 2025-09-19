<style>
    footer{
        margin-top: 40px;
        background: inherit;
        color: var(--text-clr);
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background: url(/chain-fortune/images/wp3624600-cryptocurrency-wallpapers.jpg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;

        .logo-card{
            padding: 2rem;
            width: 100%;
            @media (max-width: 768px) {
                margin-right: 0;
            };
            p{
                line-height: 32px;
                i{
                    font-size: 14px;
                    line-height: 20px;
                }
            }

            .readmore-link{
                display: flex;
                align-items: center;
                color: var(--accent-clr);
                gap: 9px;
                transition: all 0.4s ease;
                span{
                    margin-top: 7px;
                    transform: rotate(-30deg);
                    transition: all 0.4s ease;
                }
                &:hover span{
                    transform: rotate(0deg);
                }
                
            }

            .social-icons{
                display: flex;
                gap: 10px;
                align-items: center;
                margin-top: 1rem;

                a{
                    width: 40px;
                    height: 40px;
                    background: transparent;
                    border: 1px solid var(--line-clr);
                    display: grid;
                    place-content: center;
                    border-radius: 50%;
                    color: var(--secondary-text-clr);
                    font-size: 18px;
                    font-weight: 300;
                    transition: all 0.3s ease;

                    &:hover{
                        transform: translateY(-5px);
                        color: var(--accent-clr);
                        border: 1px solid var(--accent-clr);

                    }
                    i{
                        margin: auto;
                    }
        
                }
            }
        }

        .footer-card-wrapper{
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            place-content: center;
            width: 100%;
            margin: 0 auto;
            padding: 1.5rem;
            border-top: 1px solid var(--line-clr);
            border-bottom: 1px solid var(--line-clr);
        
            @media (max-width: 900px) {
                grid-template-columns: repeat(3, 1fr);
            };
            @media (max-width: 620px) {
                grid-template-columns: repeat(2, 1fr);
            };
            @media (max-width: 450px) {
                grid-template-columns: repeat(1, 1fr);
            };

            .footer-card{
                width: 100%;
                margin: 0 auto;
                padding: 1rem;

                .card-header > h3{
                    font-size: 1.4rem;
                }
                .card-links{
                    ul{
                        display: flex;
                        flex-direction: column;
                        gap: 0.7rem;
                        margin-top: 2rem;
                        li a{
                            color: var(--text-clr);
                            transition: all 0.4s ease;
                            &:hover{
                                color: var(--accent-clr);
                            }
                        }
                    }
                }

            }
           
        }

        .payment-governance{
            /* background: var(--base-clr); */
            border-bottom: 1px solid var(--line-clr);
            width: 100%;
            display: flex;
            padding: 2rem;
            justify-content: space-between;
            @media (max-width: 899px) {
                flex-direction: column;
                gap: 50px;
            }

            .payment-governance-item{
                text-align: left;
                @media (max-width: 899px) {
                    width: 100%;
                    height: 100%;
                }

                .payment-governance-header{
                    margin-bottom: 8px;
                    @media (max-width: 440px) {
                        margin-bottom: 23px;
                    }

                }

                ul{
                    display: flex;
                    align-items: center;
                    gap: 19px;
                    @media (max-width: 440px) {
                        flex-direction: column;
                        align-items: start;
                    }

                }
            }
        }

        .footer-copyright{
            width: 100%;
            padding: 30px;
            
            > div{
                display: flex;
                justify-content: space-between;
                width: 100%;
                @media (max-width: 760px) {
                    flex-direction: column;
                    justify-content: start;
                    gap: 40px;

                }


                ul{
                    display: flex;
                    gap: 20px;
                    @media (max-width: 560px) {
                        flex-direction: column;
                    }


                    li{
                        a{
                            color: var(--secondary-text-clr);
                            transition: all 0.4s ease;
                            text-decoration: underline;
                            text-underline-offset: 2px;
                            &:hover{
                                color: var(--accent-clr);
                            }
                        }
                    }
                }
            }
        }
    }



</style>

<footer>
    <div class="logo-card">
        <div class="logo move_in" onclick="location.href=`home`">
            <img src="/chain-fortune/images/logo/logo_6.png" width="120" height="" alt="">
        </div>
        <p style="margin-top:1rem;" class="move_in">
            Chain Fortune is regulated by the International Financial Services Commission of Belize, as well as the Cyprus Securities and Exchange Commission, licensed by the Financial Services Board (FSB) of Switzerland. The company is also registered with the Financial Conduct Authority of the UK.

            <p class="move_in">
                <br>
                The information on this website does not constitute investment advice or a recommendation or a solicitation to engage in any investment activity. 
                Any interaction with this website constitutes an individual and voluntary operation on the part of the person accessing it. This website and its content should not be understood as an invitation for the contracting and/or acquisition of Exness' financial services and products. 
                The information on this website may only be copied with the express written permission of Exness.
                <a href="#" class="readmore-link">
                    Read More
                    <span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </span>
                </a>
                <br>
                <i class="move_in">
                    <b>NOTE:</b> Trading in Forex and Contracts for Difference (CFDs), which are leveraged products, is highly speculative and involves substantial risk of loss. It is possible to lose all your capital. Therefore AmaniLightEquity is guaranteed to give you your capital when the market may go down as well as up. AmaniLightEquity Limited provides it's services to global citizens. Copyright © 2025 AmaniLightEquity. All Rights Reserved. Terms and Conditions | Risk Disclosure. Understand that prices displayed on the website may be affected by changes in currency exchange rate and price movements thereby affecting your investment return.
                </i>
            </p>
        </p>
        <div class="social-icons" class="move_in">
            <a href="">
                <i class="ri-facebook-circle-line"></i>
            </a>

            <a href="">
                <i class="ri-instagram-line"></i>
            </a>

            <a href="">
                <i class="ri-linkedin-box-line"></i>
            </a>

            <a href="">
                <i class="ri-youtube-line"></i>
            </a>
        </div>
            
    </div>

    <div class="footer-card-wrapper">
      
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Markets</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li>
                        <a href="../page/markets">Cryptocurrencies</a>
                    </li>
                    <li>
                        <a href="../page/markets">Real Estate</a>
                    </li>
                    <li>
                        <a href="../page/markets">Gold</a>
                    </li>

                    <li>
                        <a href="../page/markets">Oil Gas</a>
                    </li>

                    <li>
                        <a href="../page/markets">Renewable Energy</a>
                    </li>

                    <li>
                        <a href="../page/markets">Shocked Indices</a>
                    </li>

                    <li>
                        <a href="../page/markets">Commodities</a>
                    </li>

                    <li>
                        <a href="../page/markets">Marijuana</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Buy Crypto</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li>
                        <a onclick="window.open('https://coinbase.com')">Coinbase</a>
                    </li>
                    <li>
                        <a onclick="window.open('https://voyager.com')">Voyager</a>
                    </li>
                    <li>
                        <a onclick="window.open('https://coinamama.com')">Coinmama</a>
                    </li>
                    <li>
                        <a onclick="window.open('https://gemini.com')">Gemini</a>
                    </li>
                    <li>
                        <a onclick="window.open('https://etoro.com')">eToro</a>
                    </li>
                    <li>
                        <a onclick="window.open('https://blockfi.com')">BlockFi</a>
                    </li>
                    <li>
                        <a onclick="window.open('https://kraken.com')">Kraken</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Support</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="#">Our Support</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Platforms</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="../page/metaTrader-5">MetaTrader 5</a></li>
                    <li><a href="../page/metaTrader-4">MetaTrader 4</a></li>
                    <li><a href="../page/metaTrader-5-Mobile">MetaTrader 5 Mobile</a></li>
                    <li><a href="../page/metaTrader-4-Mobile">MetaTrader 4 Mobile</a></li>
                    <li><a href="../page/metaTrader-web-terminal">MetaTrader Web Terminal</a></li>
          
                </ul>
            </div>
        </div>
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Company</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="../page/about">About Us</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="../page/why-chain-fortune">Why Chain Fortune</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Cookie Settings</a></li>
                    <li><a href="../page/privacy_policy">Policy Policy</a></li>
                    <li><a href="../page/asset_safety">Asset Safety</a></li>
                    <li><a href="../page/term_condtions">Terms and Conditions</a></li>
                    <li><a href="../page/faq">FAQs</a></li>
                    <li><a href="../page/contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Support</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="#">Our Support</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
    

    <div class="payment-governance">
        <div class="payment-governance-item">
            <div class="payment-governance-header">
                <h3>Payment Method:</h3>
            </div>
            <ul>
                <li><img src="/chain-fortune/images/svg/bank-transfer.a3d69e58b7f5cb511b9cfabedfce7fdb.svg" alt=""></li>
                <li><img src="/chain-fortune/images/svg/neteller.c60e7554e2d746ef603f830c01730e87.svg" alt=""></li>
                <li><img src="/chain-fortune/images/svg/mastercard.3a7b9dc4c5725f01bb6f26a2527ef494.svg" alt=""></li>
                <li><img src="/chain-fortune/images/svg/visa.957f45202abf9b8d66e7afa94a316cb7.svg" alt=""></li>
            </ul>
        </div>

        <div class="payment-governance-item">
            <div class="payment-governance-header">
                <h3>Corporate Governance:</h3>
            </div>
            <ul>
                <li><img src="/chain-fortune/images/svg/bank-of-cyprus.7e7a39630a1e2c311f46cbb17c156da0.svg" alt=""></li>
                <li><img src="/chain-fortune/images/svg/bov.6d2ffc77fda20b81079cbebde1032ebb.svg" alt=""></li>
                <li><img src="/chain-fortune/images/svg/pwc.e3aac3f5f475c84806862210fc176b95.svg" alt=""></li>
            </ul>
        </div>
    </div>


    <div class="footer-copyright">
        <div>
           <ul>
                <li>
                    <a href="#">Risk Disclosure</a>
                </li>
                <li>
                    <a href="../page/asset_safety">Assets Safety</a>
                </li>
                <li>
                    <a href="../page/privacy_policy">Privacy Policy</a>
                </li>
                <li>
                    <a href="#">PAIA Manual</a>
                </li>
           </ul>

           <p>© 2025 Chain Fortune</p>
        </div>
        
    </div>
</footer>
<br>
<br>
<br>
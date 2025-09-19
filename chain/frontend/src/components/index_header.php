<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'b1fa6d1c6757e42f37bc2f896db1d70086bfbbe5';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/chain-fortune/js/w3.js"></script>
<?php
    include("../../../backend/check_ip_address.php");
    include("../components/sticky-cursor.php");
    include("../components/earning_alert.php");
    include("../components/page_refresh_loader.php");
    include("../components/remixicon.php");
?>
<script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
<script src="/chain-fortune/owlcarousel-js/owl.carousel.min.js"></script>
<link rel="stylesheet" href="/chain-fortune/owlcarousel-css/owl.theme.default.min.css"/>
<link rel="stylesheet" href="/chain-fortune/owlcarousel-css/owl.carousel.min.css"/>
<link rel="stylesheet" href="../styles/config/config.css">
<link rel="stylesheet" href="../styles/colors/colors.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<style>
    
        :root {
            --base-clr: #11121a;
            --line-clr: #42434a;
            --hover-clr: #222533;
            --text-clr: #e6e6ef;
            --accent-clr: #5e63ff;
            --secondary-text-clr: #b0b3c1;
            --negative-text-clr: rgb(255, 0, 0);
            --positive-text-clr: rgb(0, 255, 106);
            --pending-text-clr: rgb(255, 255, 0);
            --info-clr: rgb(0, 145, 255);

            --negative-bg-clr: rgba(231, 76, 60, 0.15);
            --positive-bg-clr: rgba(46, 204, 113, 0.15); 
            --pending-bg-clr: rgba(255, 255, 0, 0.15); 
            --input-focus-clr: rgba(94, 99, 255, 0.1);

            } 
            
            /* move class animation */
            .move_in{
                opacity: 0;
                transform: translateY(80px);
                transition: opacity 0.6s ease-out, transform 0.8s ease-out;
            }
            .move_in.visible{
                opacity: 1;
                transform: translateY(0);
            }











            @media screen and (min-width: 1024px) {
            :root {
                --normal-font-size: 1rem;
                --small-font-size: .875rem;
                --smaller-font-size: .813rem;
            }
            }

            /*=============== BASE ===============*/
            * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            }
            html{
                scroll-behavior: smooth;
                scrollbar-width: none;
                -webkit-scrollbar-width: none;
            }

            body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;    
            font-size: var(--normal-font-size);
            background-color: var(--base-clr);
            color: var(--text-clr);
            }

            ul {
            list-style: none;
            }
            li{
            list-style: none;
            }


            a {
            text-decoration: none;
            cursor: pointer;
            }

            /*=============== REUSABLE CSS CLASSES ===============*/
            .nav-container {
                margin-inline: 1.5rem;
            }

            /*=============== HEADER ===============*/
            .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            box-shadow: 0 2px 8px #171921;
            background-color: var(--base-clr);
            /* border-bottom: 1px solid var(--line-clr); */
            z-index: var(--z-fixed);
            }

            /*=============== NAV ===============*/
            .nav {
            height: var(--header-height);
            }
            .nav__data {
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 20%;
            }
            .nav__logo {
            display: inline-flex;
            align-items: center;
            column-gap: 0.25rem;
            color: var(--text-clr);
            font-weight: var(--font-semi-bold);
            transition: color 0.3s;
            margin-left: 30px;
            }
            .nav__logo i {
            font-size: 1.25rem;
            }
            .nav__logo:hover {
            color: var(--accent-clr);
            }
            .nav__toggle {
            position: relative;
            width: 32px;
            height: 32px;
            }
            .nav__toggle-menu, .nav__toggle-close {
            font-size: 1.25rem;
            color: var(--text-clr);
            position: absolute;
            display: grid;
            place-items: center;
            inset: 0;
            cursor: pointer;
            transition: opacity 0.1s, transform 0.4s;
            }
            .nav__toggle-close {
                opacity: 0;
                border-radius: 50%;
                background: var(--hover-clr);
            }
            .nav__toggle-close:hover{

            }
            .nav__menu{
                width: 80%;
            }


            @media screen and (max-width: 1118px) {
             .dropdown__icon svg {
                width: 20px;
                height: 20px;
            }
            .header {
                padding-block: 8px;
            }
            .nav__logo {
                margin-left: 1px;
            }
            .nav__data {
                width: auto;
            }

            .nav__menu {
                background-color: var(--base-clr);
                position: absolute;
                left: 0;
                top: 2.5rem;
                width: 100%;
                height: calc(100vh - 3.5rem);
                overflow: auto;
                padding-block: 1.5rem 4rem;
                pointer-events: none;
                opacity: 0;
                transition: top 0.4s, opacity 0.3s;
            }
            .nav__menu::-webkit-scrollbar {
                width: 0.5rem;
            }
            .nav__menu::-webkit-scrollbar-thumb {
                background-color: hsl(220, 12%, 70%);
            }
            }
            .nav__link {
            color: var(--text-clr);
            font-weight: var(--font-semi-bold);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
            }
            .nav__link:hover {
            background-color: var(--hover-clr);
            }
            .home-link:hover{
                color: var(--accent-clr);
            }

            /* Show menu */
            .show-menu {
            opacity: 1;
            top: 3.5rem;
            pointer-events: initial;
            }

            /* Show icon */
            .show-icon .nav__toggle-menu {
            opacity: 0;
            transform: rotate(90deg);
            }

            .show-icon .nav__toggle-close {
            opacity: 1;
            transform: rotate(90deg);
            }

            /*=============== DROPDOWN ===============*/
            .dropdown__button {
            cursor: pointer;
            }
            .dropdown__arrow {
            font-size: 1.5rem;
            font-weight: initial;
            transition: transform 0.4s;
            }
            .dropdown__content, .dropdown__group, .dropdown__list {
            display: grid;
            }
            .dropdown__container {
            background-color: var(--hover-clr);
            height: 0;
            overflow: hidden;
            transition: height 0.7s;
            }
            .dropdown__content {
            row-gap: 1.75rem;
            }
            .dropdown__group {
            padding-left: 2.5rem;
            row-gap: 0.5rem;
            }
            .dropdown__group:first-child {
            margin-top: 1.25rem;
            }
            .dropdown__group:last-child {
            margin-bottom: 1.25rem;
            }
            .dropdown__icon i {
            font-size: 1.25rem;
            color: var(--accent-clr);
            }
            
            .dropdown__title {
            font-size: var(--small-font-size);
            font-weight: var(--font-semi-bold);
            color: var(--t);
            }
            .dropdown__list {
            row-gap: 0.25rem;
            }
            .dropdown__link {
            font-size: var(--smaller-font-size);
            font-weight: var(--font-medium);
            color: var(--secondary-text-clr);
            transition: color 0.3s;
            }
            .dropdown__link:hover {
            color: var(--accent-clr);
            }

            /* Rotate dropdown icon */
            .show-dropdown .dropdown__arrow {
            transform: rotate(180deg);
            }
            

            /*=============== BREAKPOINTS ===============*/
            /* For small devices */
            @media screen and (max-width: 300px) {
            .dropdown__group {
                padding-left: 1.5rem;
            }
            }
            /* For large devices */
            @media screen and (min-width: 1118px) {
        

            /* Nav */
            .nav {
                height: calc(var(--header-height) + 2rem);
                display: flex;
                justify-content: space-between;
                width: 100%;
            }
          

            .nav__toggle {
                display: none;
            }
            .nav__list {
                display: flex;
                column-gap: 2.4rem;
                height: 100%;
            }
            .nav li {
                display: flex;
            }
            .nav__link {
                padding: 0;
            }
            .nav__link:hover {
                background-color: initial;
            }

            /* Dropdown */
            .dropdown__button {
                column-gap: 0.25rem;
                pointer-events: none;
            }
            .dropdown__container {
                height: max-content;
                position: absolute;
                left: 0;
                right: 0;
                top: 6.5rem;
                background-color: var(--base-clr);
                box-shadow: 0 2px 8px #171921;

                pointer-events: none;
                opacity: 0;
                transition: top 0.4s, opacity 0.3s;
            }
            .dropdown__content {
                grid-template-columns: repeat(4, max-content);
                column-gap: 6rem;
                max-width: 1120px;
                margin-inline: auto;
            }
            .dropdown__group {
                padding: 4rem 0;
                align-content: baseline;
                row-gap: 1.25rem;
            }
            .dropdown__group:first-child, .dropdown__group:last-child {
                margin: 0;
            }
            .dropdown__list {
                row-gap: 0.75rem;
            }
            .dropdown__icon {
                width: 60px;
                height: 60px;
                background-color: var(--hover-clr);
                border-radius: 50%;
                display: grid;
                place-items: center;
                margin-bottom: 1rem;
            }
            .dropdown__icon i {
                font-size: 2rem;
            }
           
            .dropdown__title {
                font-size: var(--normal-font-size);
            }
            .dropdown__link {
                font-size: var(--small-font-size);
            }
            .dropdown__link:hover {
                color: var(--accent-clr);
            }
            .dropdown__item {
                cursor: pointer;
            }
            .dropdown__item:hover .dropdown__arrow {
                transform: rotate(180deg);
            }
            .dropdown__item:hover > .dropdown__container {
                top: 5.5rem;
                opacity: 1;
                pointer-events: initial;
                cursor: initial;
            }
            }
            @media screen and (min-width: 1152px) {
            .nav-container {
                margin-inline: auto;
                width: 100%;
            }
           
            }

            @media screen and (max-width: 500px) {
                .button-li{
                    padding-inline: 20px;
                    margin-top: 10px;
                }
            }
            @media screen and (max-width: 430px) {
                .button-li{
                    flex-direction: column;
                    gap: 10px;
                    padding-inline: 10px;
                }
            }
</style>




<!-- header start -->
<header class="header">
    <?php include("../components/scroll_watcher.php"); ?>
    <nav class="nav nav-container">
        <div class="nav__data">
            <a href="../page/home" class="nav__logo">
                <img src="/chain-fortune/images/logo/logo_6.png" width="120" height="" alt="">
            </a>
            <div class="nav__toggle" id="nav-toggle">
                <i class="nav__toggle-menu">
                    <!-- ri-menu-line  -->
                    <svg aria-hidden="true" width="21px" focusable="false" data-prefix="fas" data-icon="bars-staggered" class="svg-inline--fa fa-bars-staggered sm-text site-primary-text " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#5e63ff" d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L96 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"></path>
                    </svg>
                </i>
                <i class="nav__toggle-close">
                    <!-- ri-close-line  -->
                    <svg fill-rule="evenodd" fill="#fff" width="15px" height="15px" viewBox="64 64 896 896" focusable="false">
                        <path d="M799.86 166.31c.02 0 .04.02.08.06l57.69 57.7c.04.03.05.05.06.08a.12.12 0 010 .06c0 .03-.02.05-.06.09L569.93 512l287.7 287.7c.04.04.05.06.06.09a.12.12 0 010 .07c0 .02-.02.04-.06.08l-57.7 57.69c-.03.04-.05.05-.07.06a.12.12 0 01-.07 0c-.03 0-.05-.02-.09-.06L512 569.93l-287.7 287.7c-.04.04-.06.05-.09.06a.12.12 0 01-.07 0c-.02 0-.04-.02-.08-.06l-57.69-57.7c-.04-.03-.05-.05-.06-.07a.12.12 0 010-.07c0-.03.02-.05.06-.09L454.07 512l-287.7-287.7c-.04-.04-.05-.06-.06-.09a.12.12 0 010-.07c0-.02.02-.04.06-.08l57.7-57.69c.03-.04.05-.05.07-.06a.12.12 0 01.07 0c.03 0 .05.02.09.06L512 454.07l287.7-287.7c.04-.04.06-.05.09-.06a.12.12 0 01.07 0z"/>
                    </svg>
                </i>
            </div>
        </div>

        <!-- nav menu start -->
        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li>
                    <a href="/chain-fortune/page/home" class="nav__link home-link">Home</a>
                </li>

                <!-- dropdown items start -->
                <li class="dropdown__item">                      
                    <div class="nav__link dropdown__button">
                        Markets <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                        
                    </div>

                    <div class="dropdown__container">
                        <div class="dropdown__content">
                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <!-- <i class="ri-flashlight-line"></i> -->
                                    <svg fill="#5e63ff" viewBox="0 0 24 24" width="31px" height="31px">
                                        <path d="M12,13A5,5 0 0,1 7,8H9A3,3 0 0,0 12,11A3,3 0 0,0 15,8H17A5,5 0 0,1 12,13M12,3A3,3 0 0,1 15,6H9A3,3 0 0,1 12,3M19,6H17A5,5 0 0,0 12,1A5,5 0 0,0 7,6H5C3.89,6 3,6.89 3,8V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V8C21,6.89 20.1,6 19,6Z"/>
                                    </svg>
                                </div>

                                <span class="dropdown__title">Our Markets</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/chain-fortune/page/markets" data-index="0" class="market-link dropdown__link">Cryptocurrencies</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/markets" data-index="1" class="market-link dropdown__link">Real Estate</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/markets" data-index="2" class="market-link dropdown__link">Gold</a>
                                    </li>

                                    <li>
                                        <a href="/chain-fortune/page/markets" data-index="3" class="market-link dropdown__link">Oil Gas</a>
                                    </li>

                                </ul>
                            </div>

                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <!-- <i class="ri-flashlight-line"></i> -->
                                    <svg fill="#5e63ff" viewBox="0 0 24 24" width="31px" height="31px">
                                        <path d="M12,13A5,5 0 0,1 7,8H9A3,3 0 0,0 12,11A3,3 0 0,0 15,8H17A5,5 0 0,1 12,13M12,3A3,3 0 0,1 15,6H9A3,3 0 0,1 12,3M19,6H17A5,5 0 0,0 12,1A5,5 0 0,0 7,6H5C3.89,6 3,6.89 3,8V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V8C21,6.89 20.1,6 19,6Z"/>
                                    </svg>
                                </div>

                                <span class="dropdown__title">Our Markets</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/chain-fortune/page/markets" class="dropdown__link">Renewable Energy</a>
                                    </li>

                                    <li>
                                        <a href="/chain-fortune/page/markets" class="dropdown__link">Shocked Indices</a>
                                    </li>

                                    <li>
                                        <a href="/chain-fortune/page/markets" class="dropdown__link">Commodities</a>
                                    </li>

                                    <li>
                                        <a href="/chain-fortune/page/markets" class="dropdown__link">Marijuana</a>
                                    </li>
                                </ul>
                            </div>

                            
                        </div>
                    </div>
                </li>

                

                <li class="dropdown__item">                      
                    <div class="nav__link dropdown__button">
                        Platforms <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

                    <div class="dropdown__container">
                        <div class="dropdown__content">
                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <i class="ri-flashlight-line"></i>
                                </div>

                                <span class="dropdown__title">Our Trading Platforms</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/chain-fortune/page/metaTrader-5" class="dropdown__link">MetaTrader 5</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/metaTrader-4" class="dropdown__link">MetaTrader 4</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/metaTrader-5-Mobile" class="dropdown__link">MetaTrader 5 Mobile</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/metaTrader-4-Mobile" class="dropdown__link">MetaTrader 4 Mobile</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/metaTrader-web-terminal" class="dropdown__link">MetaTrader Web Terminal</a>
                                    </li>
                                </ul>
                            </div>


                            
                        </div>
                    </div>
                </li>

                <li class="dropdown__item">
                    <div class="nav__link dropdown__button">
                        Crypto <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

                    <div class="dropdown__container">
                        <div class="dropdown__content">
                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        width="28px" 
                                        height="28px" 
                                        viewBox="0 0 24 24" 
                                        fill="none" 
                                        stroke="#5e63ff" 
                                        stroke-width="2" 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                    </svg>
                                </div>

                                <span class="dropdown__title">Buy Crypto</span>

                                <ul class="dropdown__list">
                                    <li>
                                        <a onclick="window.open('https://coinbase.com')" class="dropdown__link">Coinbase</a>
                                    </li>
                                    <li>
                                        <a onclick="window.open('https://voyager.com')" class="dropdown__link">Voyager</a>
                                    </li>
                                    <li>
                                        <a onclick="window.open('https://coinamama.com')" class="dropdown__link">Coinmama</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        width="28px" 
                                        height="28px" 
                                        viewBox="0 0 24 24" 
                                        fill="none" 
                                        stroke="#5e63ff" 
                                        stroke-width="2" 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                    </svg>
                                </div>
                                
                                <span class="dropdown__title">Buy Crypto</span>

                                <ul class="dropdown__list">
                                    <li>
                                        <a onclick="window.open('https://gemini.com')" class="dropdown__link">Gemini</a>
                                    </li>
                                    <li>
                                        <a onclick="window.open('https://etoro.com')" class="dropdown__link">eToro</a>
                                    </li>
                                    <li>
                                        <a onclick="window.open('https://blockfi.com')" class="dropdown__link">BlockFi</a>
                                    </li>
                                    <li>
                                        <a onclick="window.open('https://kraken.com')" class="dropdown__link">Kraken</a>
                                    </li>
                                </ul>
                            </div>

                            
                        </div>
                    </div>
                </li>

                <li class="dropdown__item">                        
                    <div class="nav__link dropdown__button">
                        Company 
                        <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

                    <div class="dropdown__container">
                        <div class="dropdown__content">
                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <i class="ri-community-line"></i>
                                </div>
                                <span class="dropdown__title">About us</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/chain-fortune/page/about" class="dropdown__link">About us</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/why-chain-fortune" class="dropdown__link">Why Chain Fortune</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown__link">Support</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/blog" class="dropdown__link">Blog</a>
                                    </li>
                                    <li>
                                        <a href="/chain-fortune/page/contact" class="dropdown__link">Contact us</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <i class="ri-shield-fill"></i>
                                </div>
                                <span class="dropdown__title">Safety and quality</span>
  
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="#" class="dropdown__link">Cookie settings</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown__link">Privacy Policy</a>
                                    </li>

                                    <li>
                                        <a href="/chain-fortune/page/asset_safety" class="dropdown__link">Asset Safety</a>
                                    </li>

                                    <li>
                                        <a href="/chain-fortune/page/term_condtions" class="dropdown__link">Terms and Conditions</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown__group">
                                <div class="dropdown__icon">
                                    <i class="ri-question-answer-fill"></i>
                                    <!-- <svg viewBox="0 0 20 20" class="c01311"><path d="M10 2a8 8 0 110 16 8 8 0 010-16zm0 1a7 7 0 100 14 7 7 0 000-14zm0 10.5a.75.75 0 110 1.5.75.75 0 010-1.5zm0-8a2.5 2.5 0 011.65 4.38l-.15.12-.22.17-.09.07-.16.15c-.33.36-.53.85-.53 1.61a.5.5 0 01-1 0 3.2 3.2 0 011.16-2.62l.25-.19.12-.1A1.5 1.5 0 0010 6.5c-.83 0-1.5.67-1.5 1.5a.5.5 0 01-1 0A2.5 2.5 0 0110 5.5z"></path></svg> -->
                                </div>

                                <span class="dropdown__title">Help</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/chain-fortune/page/faq" class="dropdown__link">FAQ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- dropdown items end -->
                <li class="button-li" style=" gap: 10px; height: 100%; display: flex; justify-content: center; width: 100%; align-items: center;">
                    <?php 
                        $buttonFilledText = "create account";
                        $buttonFilledHref = "/chain-fortune/auth/signup";
                        include("../components/button_filled.php"); 


                        $buttonOutlinedText = "SIGN IN";
                        $buttonOutlinedHref = "/chain-fortune/auth/login";
                        include("../components/button_outlined.php"); 
                    ?>
                </li>
            </ul>
        </div>
        <!-- nav menu end --> 
    </nav>
    <!-- <script src="/chain-fortune/js/index_header.style.js"></script> -->
    <script src="/chain-fortune/js/index_header.js"></script>
</header>
<!-- header end -->
<script>
    const Styles = `


    `;
    
    const css = document.createElement('style');
    css.appendChild(document.createTextNode(Styles));
    document.head.appendChild(css);
</script>
 

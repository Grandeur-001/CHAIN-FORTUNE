
<style>
  #sidebar ul li a{
    .stroke{
      stroke: var(--text-clr);
    }
  }
  #sidebar ul li.active a{
    .stroke{
      stroke: var(--accent-clr);
    }
  }
  .ti-more:before {
      content: "\e6e1";
  }







  #sidebar{
    box-sizing: border-box;
    height: 100vh;
    width: 250px;
    padding: 5px 1em;
    background-color: var(--base-clr);
    border-right: 1px solid var(--line-clr);

    position: fixed;
    top: 0;
    align-self: start;
    transition: 300ms ease-in-out;
    overflow: hidden;
    text-wrap: nowrap;
    z-index: 20;
  }
  #sidebar.close{
    padding: 5px;
    width: 60px;
  } 
  #sidebar ul{
    list-style: none;
  }
  #sidebar > ul > li:first-child{
    display: flex;
    justify-content: flex-end;
    margin-bottom: 16px;
    .logo{
      font-weight: 600;
    }
  }

  #sidebar ul li.active a{
    color: var(--accent-clr);
    background-color: var(--hover-clr);


    svg{
      fill: var(--accent-clr);
    }
  }

  #sidebar a, #sidebar .dropdown-btn, #sidebar .logo{
    border-radius: .5em;
    padding: .85em;
    text-decoration: none;
    color: var(--text-clr);
    display: flex;
    align-items: center;
    gap: 1em;
  }
  .dropdown-btn{
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    font: inherit;
    cursor: pointer;
  }
  #sidebar svg{
    flex-shrink: 0;
    fill: var(--text-clr);
  }
  #sidebar a span, #sidebar .dropdown-btn span{
    flex-grow: 1;
  }
  #sidebar a:hover, #sidebar .dropdown-btn:hover{
    background-color: var(--hover-clr);
  }
  #sidebar .sub-menu{
    display: grid;
    grid-template-rows: 0fr;
    transition: 300ms ease-in-out;

    > div{
      overflow: hidden;
    }
  }
  #sidebar .sub-menu.show{
    grid-template-rows: 1fr;
  }
  .sub-menu-items{
    color: var(--accent-clr);
  }
  .dropdown-btn svg{
    transition: 500ms ease;
  }
  .rotate svg:last-child{
    rotate: 180deg;
  }
  #sidebar .sub-menu a{
    padding-left: 2em;
  }
  #toggle-btn,
  .hide-sidebar{
    margin-left: auto;
    padding: 1em;
    border: none;
    border-radius: .5em;
    background: none;
    cursor: pointer;

    svg{
      transition: rotate 150ms ease;
    }
  }
  #toggle-btn:hover,
  .hide-sidebar:hover{
    background-color: var(--hover-clr);
  }
  .hide-sidebar{
    display: none;
  }

  /* @media(max-width: 800px){
      #sidebar{
        height: 60px;
        width: 100%;
        border-right: none;
        border-top: 1px solid var(--line-clr);
        padding: 0;
        position: fixed;
        top: unset;
        bottom: 0;
        display: block;
    
        > ul{
          padding: 0;
          display: grid;
          grid-auto-columns: 60px;
          grid-auto-flow: column;
          align-items: center;
          overflow-x: scroll;
        }
        ul li{
          height: 100%;
        }
        .logout{
          position: relative;
          bottom: auto;
        }
        ul a, ul .dropdown-btn{
          width: 60px;
          height: 60px;
          padding: 0;
          border-radius: 0;
          justify-content: center;
        }
    
        ul li span, ul li:first-child, .dropdown-btn svg:last-child{
          display: none;
        }
    
        ul li .sub-menu.show{
          position: fixed;
          bottom: 60px;
          left: 0;
          box-sizing: border-box;
          height: 60px;
          width: 100%;
          background-color: var(--hover-clr);
          border-top: 1px solid var(--line-clr);
          display: flex;
          justify-content: center;
    
          > div{
            overflow-x: auto;
          }
          li{
            display: inline-flex;
          }

          a{
            box-sizing: border-box;
            padding: 1em;
            width: auto;
            justify-content: center;
          }
        }
      }
    }

    html{
      scrollbar-width: none;
  } */


  @media(max-width: 800px){
    .sidebar{
      transform: translateX(-400px);
    }
    .sidebar.show-sidedar{
      transform: translateX(0);
    }
    #toggle-btn{
      display: none;
    }
    .hide-sidebar{
      display: block;
    }
  }

</style>


<nav id="sidebar" class="sidebar">
  <ul style="overflow-y: scroll; height: 100%; scrollbar-width:none;">
    <li>
      <span style="cursor: pointer;"  onclick="location.href=`<?php echo $dashboard_url; ?>`" class="logo">
        <img src="/chain-fortune/images/logo/logo_5.png" width="40" height="" alt="">
      </span>
      <button  onclick=toggleSidebar() id="toggle-btn">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"/></svg>
      </button>

      <button class="hide-sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"/></svg>
      </button>
    </li>
    
    <li class="" style="cursor: pointer;">
      <a id="translatorTrigger" href="javascript:void(0);">
        <img src="/chain-fortune/images/svg/translation-svgrepo-com.svg" width="28" alt="">
        <span>Translate</span>
      </a>
    </li>


    <li>
      <a href="<?php echo $dashboard_url; ?>">
        <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M924.8 385.6a446.7 446.7 0 00-96-142.4 446.7 446.7 0 00-142.4-96C631.1 123.8 572.5 112 512 112s-119.1 11.8-174.4 35.2a446.7 446.7 0 00-142.4 96 446.7 446.7 0 00-96 142.4C75.8 440.9 64 499.5 64 560c0 132.7 58.3 257.7 159.9 343.1l1.7 1.4c5.8 4.8 13.1 7.5 20.6 7.5h531.7c7.5 0 14.8-2.7 20.6-7.5l1.7-1.4C901.7 817.7 960 692.7 960 560c0-60.5-11.9-119.1-35.2-174.4zM761.4 836H262.6A371.12 371.12 0 01140 560c0-99.4 38.7-192.8 109-263 70.3-70.3 163.7-109 263-109 99.4 0 192.8 38.7 263 109 70.3 70.3 109 163.7 109 263 0 105.6-44.5 205.5-122.6 276zM623.5 421.5a8.03 8.03 0 00-11.3 0L527.7 506c-18.7-5-39.4-.2-54.1 14.5a55.95 55.95 0 000 79.2 55.95 55.95 0 0079.2 0 55.87 55.87 0 0014.5-54.1l84.5-84.5c3.1-3.1 3.1-8.2 0-11.3l-28.3-28.3zM490 320h44c4.4 0 8-3.6 8-8v-80c0-4.4-3.6-8-8-8h-44c-4.4 0-8 3.6-8 8v80c0 4.4 3.6 8 8 8zm260 218v44c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8v-44c0-4.4-3.6-8-8-8h-80c-4.4 0-8 3.6-8 8zm12.7-197.2l-31.1-31.1a8.03 8.03 0 00-11.3 0l-56.6 56.6a8.03 8.03 0 000 11.3l31.1 31.1c3.1 3.1 8.2 3.1 11.3 0l56.6-56.6c3.1-3.1 3.1-8.2 0-11.3zm-458.6-31.1a8.03 8.03 0 00-11.3 0l-31.1 31.1a8.03 8.03 0 000 11.3l56.6 56.6c3.1 3.1 8.2 3.1 11.3 0l31.1-31.1c3.1-3.1 3.1-8.2 0-11.3l-56.6-56.6zM262 530h-80c-4.4 0-8 3.6-8 8v44c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8v-44c0-4.4-3.6-8-8-8z"/></svg>
        <span>Dashboard</span>
      </a>
    </li>

    <li>
      <button onclick="toggleSubMenu(this)" class="dropdown-btn">
        <svg height="24" id="svg8" version="1.1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg">
          <defs id="defs2">
            <rect height="7.0346723" id="rect2504" width="7.9207187" x="-1.1008456" y="289.81766"/>
          </defs>
          <g id="g1769" style="stroke-width:1.01669" transform="matrix(0.98358049,0,0,0.98358049,-77.76606,40.305423)">
            <path d="M 55.564453,6.9824219 V 9.0332031 H 51.5 v 2.8671879 h -4.064453 v 2.822265 h -4.064453 v 6.617188 h -1.929688 c 0.03882,0.313006 -0.07693,0.781738 0.05664,1 h 21.060547 c -0.03885,-0.313006 0.07693,-0.781739 -0.05664,-1 H 60.628906 V 6.9824219 Z m 1,1.0019531 h 3.064453 v 13.34375 H 56.564453 Z M 52.5,10.033203 h 3.064453 V 21.328125 H 52.5 Z m -4.064453,2.869141 H 51.5 v 8.425781 h -3.064453 z m -4.064453,2.818359 h 3.064453 v 5.607422 h -3.064453 z" id="path1291" stroke="none" transform="matrix(1.0166936,0,0,1.0166936,38.396517,-40.97628)"/>
            <path d="m 57.597656,1.65625 v 4.5097656 1.3261719 l 0.998047,-0.056641 V 5.6757812 l 3.585938,-1.765625 z m 0.998047,1.6074219 1.318359,0.6464843 -1.318359,0.6484376 z" id="path1716" stroke="none" transform="matrix(1.0166936,0,0,1.0166936,38.396517,-40.97628)"/>
          </g>
        </svg>

        <span>Transactions</span>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
          <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/>
        </svg>
      </button>
      <ul class="sub-menu" style="transition: 500ms ease-in-out;">
        <div>
          <li>
            <a class="sub-menu-links" href="<?php echo $deposit_transactions_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Deposit Trans...</span>
            </a>
          </li>

          <li>
            <a class="sub-menu-links" href="<?php echo $withdrawal_transactions_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Withdrawal Trans...</span>
            </a>
          </li>
          
        </div>
      </ul>
    </li>

    <li>
      <button onclick="toggleSubMenu(this)" class="dropdown-btn">
        <svg height="24" id="svg8" version="1.1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg">
          <defs id="defs2">
            <rect height="7.0346723" id="rect2504" width="7.9207187" x="-1.1008456" y="289.81766"/>
          </defs>
          <g id="g1769" style="stroke-width:1.01669" transform="matrix(0.98358049,0,0,0.98358049,-77.76606,40.305423)">
            <path d="M 55.564453,6.9824219 V 9.0332031 H 51.5 v 2.8671879 h -4.064453 v 2.822265 h -4.064453 v 6.617188 h -1.929688 c 0.03882,0.313006 -0.07693,0.781738 0.05664,1 h 21.060547 c -0.03885,-0.313006 0.07693,-0.781739 -0.05664,-1 H 60.628906 V 6.9824219 Z m 1,1.0019531 h 3.064453 v 13.34375 H 56.564453 Z M 52.5,10.033203 h 3.064453 V 21.328125 H 52.5 Z m -4.064453,2.869141 H 51.5 v 8.425781 h -3.064453 z m -4.064453,2.818359 h 3.064453 v 5.607422 h -3.064453 z" id="path1291" stroke="none" transform="matrix(1.0166936,0,0,1.0166936,38.396517,-40.97628)"/>
            <path d="m 57.597656,1.65625 v 4.5097656 1.3261719 l 0.998047,-0.056641 V 5.6757812 l 3.585938,-1.765625 z m 0.998047,1.6074219 1.318359,0.6464843 -1.318359,0.6484376 z" id="path1716" stroke="none" transform="matrix(1.0166936,0,0,1.0166936,38.396517,-40.97628)"/>
          </g>
        </svg>

        <span>Investments</span>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
          <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/>
        </svg>
      </button>
      <ul class="sub-menu" style="transition: 500ms ease-in-out;">
        <div>
          

          <li>
            <a class="sub-menu-links" href="<?php echo $all_investments; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>All Investments</span>
            </a>
          </li>
          
        </div>
      </ul>
    </li>

    <li>
      <a href="<?php echo $exchange_url; ?>">
        <svg width="24px" height="24px" viewBox="64 64 896 896" focusable="false">
          <path d="M847.9 592H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h605.2L612.9 851c-4.1 5.2-.4 13 6.3 13h72.5c4.9 0 9.5-2.2 12.6-6.1l168.8-214.1c16.5-21 1.6-51.8-25.2-51.8zM872 356H266.8l144.3-183c4.1-5.2.4-13-6.3-13h-72.5c-4.9 0-9.5 2.2-12.6 6.1L150.9 380.2c-16.5 21-1.6 51.8 25.1 51.8h696c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"/>
        </svg>
        <span>Assets Exchange</span>
      </a>
    </li>

    <?php 
        if ($role === 'admin') {
          echo '
              <li>
                <button onclick="toggleSubMenu(this)" class="dropdown-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12C19 12.5523 18.5523 13 18 13C17.4477 13 17 12.5523 17 12C17 11.4477 17.4477 11 18 11C18.5523 11 19 11.4477 19 12Z" fill=""/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.94358 3.25H13.0564C14.8942 3.24998 16.3498 3.24997 17.489 3.40314C18.6614 3.56076 19.6104 3.89288 20.3588 4.64124C21.2831 5.56563 21.5777 6.80363 21.6847 8.41008C22.2619 8.6641 22.6978 9.2013 22.7458 9.88179C22.7501 9.94199 22.75 10.0069 22.75 10.067C22.75 10.0725 22.75 10.0779 22.75 10.0833V13.9167C22.75 13.9221 22.75 13.9275 22.75 13.933C22.75 13.9931 22.7501 14.058 22.7458 14.1182C22.6978 14.7987 22.2619 15.3359 21.6847 15.5899C21.5777 17.1964 21.2831 18.4344 20.3588 19.3588C19.6104 20.1071 18.6614 20.4392 17.489 20.5969C16.3498 20.75 14.8942 20.75 13.0564 20.75H9.94359C8.10583 20.75 6.65019 20.75 5.51098 20.5969C4.33856 20.4392 3.38961 20.1071 2.64124 19.3588C1.89288 18.6104 1.56076 17.6614 1.40314 16.489C1.24997 15.3498 1.24998 13.8942 1.25 12.0564V11.9436C1.24998 10.1058 1.24997 8.65019 1.40314 7.51098C1.56076 6.33856 1.89288 5.38961 2.64124 4.64124C3.38961 3.89288 4.33856 3.56076 5.51098 3.40314C6.65019 3.24997 8.10582 3.24998 9.94358 3.25ZM20.1679 15.75H18.2308C16.0856 15.75 14.25 14.1224 14.25 12C14.25 9.87756 16.0856 8.25 18.2308 8.25H20.1679C20.0541 6.90855 19.7966 6.20043 19.2981 5.7019C18.8749 5.27869 18.2952 5.02502 17.2892 4.88976C16.2615 4.75159 14.9068 4.75 13 4.75H10C8.09318 4.75 6.73851 4.75159 5.71085 4.88976C4.70476 5.02502 4.12511 5.27869 3.7019 5.7019C3.27869 6.12511 3.02502 6.70476 2.88976 7.71085C2.75159 8.73851 2.75 10.0932 2.75 12C2.75 13.9068 2.75159 15.2615 2.88976 16.2892C3.02502 17.2952 3.27869 17.8749 3.7019 18.2981C4.12511 18.7213 4.70476 18.975 5.71085 19.1102C6.73851 19.2484 8.09318 19.25 10 19.25H13C14.9068 19.25 16.2615 19.2484 17.2892 19.1102C18.2952 18.975 18.8749 18.7213 19.2981 18.2981C19.7966 17.7996 20.0541 17.0915 20.1679 15.75ZM5.25 8C5.25 7.58579 5.58579 7.25 6 7.25H10C10.4142 7.25 10.75 7.58579 10.75 8C10.75 8.41421 10.4142 8.75 10 8.75H6C5.58579 8.75 5.25 8.41421 5.25 8ZM20.9235 9.75023C20.9032 9.75001 20.8766 9.75 20.8333 9.75H18.2308C16.8074 9.75 15.75 10.8087 15.75 12C15.75 13.1913 16.8074 14.25 18.2308 14.25H20.8333C20.8766 14.25 20.9032 14.25 20.9235 14.2498C20.936 14.2496 20.9426 14.2495 20.9457 14.2493L20.9479 14.2492C21.1541 14.2367 21.2427 14.0976 21.2495 14.0139C21.2495 14.0139 21.2497 14.0076 21.2498 13.9986C21.25 13.9808 21.25 13.9572 21.25 13.9167V10.0833C21.25 10.0428 21.25 10.0192 21.2498 10.0014C21.2497 9.99238 21.2495 9.98609 21.2495 9.98609C21.2427 9.90242 21.1541 9.7633 20.9479 9.75076C20.9479 9.75076 20.943 9.75043 20.9235 9.75023Z" fill=""/>
                  </svg>

                  <span>Wallet Actions</span>
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                    <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/>
                  </svg>
                </button>
                <ul class="sub-menu" style="transition: 500ms ease-in-out;">
                  <div>
                    <li>
                      <a class="sub-menu-links" href="/chain-fortune/admin/create_wallet">
                        <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Create Wallet</span>
                      </a>
                    </li>

                    <li>
                      <a class="sub-menu-links" href="/chain-fortune/admin/delete_wallet">
                        <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Delete Wallet</span>
                      </a>
                    </li>

                    <li>
                      <a class="sub-menu-links" href="/chain-fortune/admin/edit_wallet">
                        <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Edit Wallet</span>
                      </a>
                    </li>

                    <li>
                      <a class="sub-menu-links" href="/chain-fortune/admin/credit_users">
                        <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Credit All Users</span>
                      </a>
                    </li>
                    
                  </div>
                </ul>
              </li>
          ';
        }
    ?>

    
    <li>
      <a href="#">
      <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M911.5 700.7a8 8 0 00-10.3-4.8L840 718.2V180c0-37.6-30.4-68-68-68H252c-37.6 0-68 30.4-68 68v538.2l-61.3-22.3c-.9-.3-1.8-.5-2.7-.5-4.4 0-8 3.6-8 8V763c0 3.3 2.1 6.3 5.3 7.5L501 910.1c7.1 2.6 14.8 2.6 21.9 0l383.8-139.5c3.2-1.2 5.3-4.2 5.3-7.5v-59.6c0-1-.2-1.9-.5-2.8zM512 837.5l-256-93.1V184h512v560.4l-256 93.1zM660.6 312h-54.5c-3 0-5.8 1.7-7.1 4.4l-84.7 168.8H511l-84.7-168.8a8 8 0 00-7.1-4.4h-55.7c-1.3 0-2.6.3-3.8 1-3.9 2.1-5.3 7-3.2 10.8l103.9 191.6h-57c-4.4 0-8 3.6-8 8v27.1c0 4.4 3.6 8 8 8h76v39h-76c-4.4 0-8 3.6-8 8v27.1c0 4.4 3.6 8 8 8h76V704c0 4.4 3.6 8 8 8h49.9c4.4 0 8-3.6 8-8v-63.5h76.3c4.4 0 8-3.6 8-8v-27.1c0-4.4-3.6-8-8-8h-76.3v-39h76.3c4.4 0 8-3.6 8-8v-27.1c0-4.4-3.6-8-8-8H564l103.7-191.6c.6-1.2 1-2.5 1-3.8-.1-4.3-3.7-7.9-8.1-7.9z"/></svg>
        <span>Payment Details</span>
      </a>
    </li>

    <li>
      <a href="#">
      <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M926 164H94c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V196c0-17.7-14.3-32-32-32zm-92.3 194.4l-297 297.2a8.03 8.03 0 01-11.3 0L410.9 541.1 238.4 713.7a8.03 8.03 0 01-11.3 0l-36.8-36.8a8.03 8.03 0 010-11.3l214.9-215c3.1-3.1 8.2-3.1 11.3 0L531 565l254.5-254.6c3.1-3.1 8.2-3.1 11.3 0l36.8 36.8c3.2 3 3.2 8.1.1 11.2z"/></svg>
        <span>Funds Account</span>
      </a>
    </li>

    <li>
      <button onclick="toggleSubMenu(this)" class="dropdown-btn">
        <svg height="24" id="svg8" version="1.1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg">
          <defs id="defs2">
            <rect height="7.0346723" id="rect2504" width="7.9207187" x="-1.1008456" y="289.81766"/>
          </defs>
          <g id="g1769" style="stroke-width:1.01669" transform="matrix(0.98358049,0,0,0.98358049,-77.76606,40.305423)">
            <path d="M 55.564453,6.9824219 V 9.0332031 H 51.5 v 2.8671879 h -4.064453 v 2.822265 h -4.064453 v 6.617188 h -1.929688 c 0.03882,0.313006 -0.07693,0.781738 0.05664,1 h 21.060547 c -0.03885,-0.313006 0.07693,-0.781739 -0.05664,-1 H 60.628906 V 6.9824219 Z m 1,1.0019531 h 3.064453 v 13.34375 H 56.564453 Z M 52.5,10.033203 h 3.064453 V 21.328125 H 52.5 Z m -4.064453,2.869141 H 51.5 v 8.425781 h -3.064453 z m -4.064453,2.818359 h 3.064453 v 5.607422 h -3.064453 z" id="path1291" stroke="none" transform="matrix(1.0166936,0,0,1.0166936,38.396517,-40.97628)"/>
            <path d="m 57.597656,1.65625 v 4.5097656 1.3261719 l 0.998047,-0.056641 V 5.6757812 l 3.585938,-1.765625 z m 0.998047,1.6074219 1.318359,0.6464843 -1.318359,0.6484376 z" id="path1716" stroke="none" transform="matrix(1.0166936,0,0,1.0166936,38.396517,-40.97628)"/>
          </g>
        </svg>

        <span>Finance</span>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
          <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/>
        </svg>
      </button>
      <ul class="sub-menu" style="transition: 500ms ease-in-out;">
        <div>
          <li>
            <a class="sub-menu-links" href="<?php echo $deposit_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Deposit</span>
            </a>
          </li>

          <li>
            <a class="sub-menu-links" href="<?php echo $withdraw_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Withdraw</span>
            </a>
          </li>

          <li>
            <a class="sub-menu-links" href="<?php echo $wallet_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Wallet</span>
            </a>
          </li>
          
          <li>
            <a class="sub-menu-links" href="<?php echo $investment_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Investment</span>
            </a>
          </li>

          <li>
            <a class="sub-menu-links" href="<?php echo $market_chart_url; ?>">
              <svg class="stroke" width="15px" height="15px" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.4 18L22.8 8.40002M32.4 18L22.8 27.6M32.4 18H2.40002" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Market Chart</span>
            </a>
          </li>
        </div>
      </ul>
    </li>


    <li>
      <a href="#">
        <svg width="26px" height="26px" class="fui-Icon-filled ___12fm75w f1w7gpdv fez10in fg4l7m0" fill="" aria-hidden="true" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 2.5a3.25 3.25 0 1 0 0 6.5 3.25 3.25 0 0 0 0-6.5ZM1.5 12c0-1.1.9-2 2-2H10a2 2 0 0 1 1 .26 5.49 5.49 0 0 0-1.88 5.4c-.64.21-1.42.34-2.37.34-2.51 0-3.87-.92-4.57-1.93a3.95 3.95 0 0 1-.68-1.99V12ZM17 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm2 8a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm-2-1.1h-1.55l-.47-1.54a.5.5 0 0 0-.96 0l-.47 1.53H12c-.48 0-.69.65-.3.95l1.26.94-.48 1.53c-.15.49.38.89.77.59l1.25-.95 1.25.95c.4.3.92-.1.77-.59l-.48-1.53 1.25-.94c.4-.3.2-.95-.3-.95Z" fill=""></path></svg>
        <span>Memberships</span>
      </a>
    </li>

      <?php 
        if ($role === 'admin') {
          echo '
            <li>
              <a href="../admin/users">
                <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path class="stroke" fill="none" d="M3 19H1V18C1 16.1362 2.27477 14.57 4 14.126M6 10.8293C4.83481 10.4175 4 9.30623 4 8.00001C4 6.69379 4.83481 5.58255 6 5.17072M21 19H23V18C23 16.1362 21.7252 14.57 20 14.126M18 5.17072C19.1652 5.58255 20 6.69379 20 8.00001C20 9.30623 19.1652 10.4175 18 10.8293M10 14H14C16.2091 14 18 15.7909 18 18V19H6V18C6 15.7909 7.79086 14 10 14ZM15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5C13.6569 5 15 6.34315 15 8Z" stroke="#e8eaed" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Users</span>
              </a>
            </li>

            <li>
              <a href="/chain-fortune/admin/kyc">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 32 32" width="24px" xml:space="preserve"><path d="M10.014,5l-6.012,0c-0.796,0 -1.559,0.316 -2.122,0.879c-0.562,0.562 -0.878,1.325 -0.878,2.121c-0,3.832 -0,12.168 -0,16c-0,0.796 0.316,1.559 0.878,2.121c0.563,0.563 1.326,0.879 2.122,0.879c5.153,0 18.842,0 23.995,0c0.796,0 1.559,-0.316 2.121,-0.879c0.563,-0.562 0.879,-1.325 0.879,-2.121c0,-3.832 0,-12.168 0,-16c0,-0.796 -0.316,-1.559 -0.879,-2.121c-0.562,-0.563 -1.325,-0.879 -2.121,-0.879l-6.012,-0c-0,-0.796 -0.316,-1.559 -0.879,-2.121c-0.563,-0.563 -1.326,-0.879 -2.121,-0.879c-1.736,0 -4.236,0 -5.971,0c-0.796,0 -1.559,0.316 -2.121,0.879c-0.563,0.562 -0.879,1.325 -0.879,2.121Zm11.799,2c-0.148,0.418 -0.387,0.802 -0.707,1.121c-0.563,0.563 -1.326,0.879 -2.121,0.879c-1.736,0 -4.236,0 -5.971,0c-0.796,-0 -1.559,-0.316 -2.121,-0.879c-0.32,-0.319 -0.56,-0.703 -0.708,-1.121l-6.183,0c-0.265,0 -0.52,0.105 -0.707,0.293c-0.188,0.187 -0.293,0.442 -0.293,0.707l-0,16c-0,0.265 0.105,0.52 0.293,0.707c0.187,0.188 0.442,0.293 0.707,0.293c5.153,0 18.842,0 23.995,0c0.265,0 0.52,-0.105 0.707,-0.293c0.188,-0.187 0.293,-0.442 0.293,-0.707l0,-16c0,-0.265 -0.105,-0.52 -0.293,-0.707c-0.187,-0.188 -0.442,-0.293 -0.707,-0.293l-6.184,-0Zm-1.828,-2l-0,1c-0,0.265 -0.106,0.52 -0.293,0.707c-0.188,0.188 -0.442,0.293 -0.707,0.293c-0,-0 -5.971,0 -5.971,0c-0.265,-0 -0.52,-0.105 -0.707,-0.293c-0.188,-0.187 -0.293,-0.442 -0.293,-0.707l-0,-1c-0,-0.265 0.105,-0.52 0.293,-0.707c0.187,-0.188 0.442,-0.293 0.707,-0.293c-0,0 5.971,-0 5.971,-0c0.265,0 0.519,0.105 0.707,0.293c0.187,0.187 0.293,0.442 0.293,0.707Z"/><path d="M9.079,16.313c-2.368,0.799 -4.077,3.043 -4.081,5.686c-0.001,0.551 0.447,1 0.999,1.001c0.552,0.001 1,-0.447 1.001,-0.999c0.003,-2.208 1.791,-4.001 3.993,-4.001c2.203,-0 3.99,1.793 3.993,4.001c0.001,0.552 0.45,1 1.002,0.999c0.552,-0.001 0.999,-0.45 0.998,-1.001c-0.004,-2.631 -1.697,-4.866 -4.049,-5.675c0.659,-0.551 1.079,-1.378 1.079,-2.303c-0,-1.656 -1.344,-3 -3,-3c-1.656,-0 -3,1.344 -3,3c-0,0.918 0.414,1.741 1.065,2.292Zm1.935,-3.292c0.552,-0 1,0.448 1,1c-0,0.552 -0.448,1 -1,1c-0.552,-0 -1,-0.448 -1,-1c-0,-0.552 0.448,-1 1,-1Z"/><path d="M26,11l-5.994,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1l5.994,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Z"/><path d="M26,16l-5.994,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1l5.994,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Z"/><path d="M26,21l-5.994,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1l5.994,-0c0.552,0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1Z"/><g id="Icon"/></svg>
                <span>KYCs</span>
              </a>
            </li>

            <li>
              <a href="/chain-fortune/admin/ratings">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="" height="26px" width="26px" version="1.1" id="Layer_1" viewBox="0 0 512 512" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M501.108,324.808c-18.078-22.785-51.248-26.095-73.455-7.46l-79.115,66.383h-37.109    c18.518-7.578,31.898-25.423,32.467-46.178c0.797-29.075-22.487-52.931-51.476-52.931H137.134v-15.706    c0-9.222-7.477-16.699-16.699-16.699H16.699C7.477,252.218,0,259.695,0,268.917v213.755c0,9.222,7.477,16.699,16.699,16.699    h103.737c9.222,0,16.699-7.477,16.699-16.699v-27.328l32.695,27.43c9.006,7.557,20.442,11.718,32.199,11.718h156.499    c11.758,0,23.194-4.162,32.201-11.719L493.3,396.711C514.768,378.695,518.272,346.441,501.108,324.808z M103.737,465.972H33.398    V285.615h70.339C103.737,296.354,103.737,458.287,103.737,465.972z M471.83,371.125l-102.571,86.063    c-3.002,2.519-6.814,3.906-10.734,3.906H202.027c-3.919,0-7.73-1.387-10.733-3.906l-54.161-45.44v-93.727h155.286    c10.134,0,18.373,8.324,18.092,18.619c-0.266,9.692-8.706,17.577-18.815,17.577c-7.262,0-59.115,0-65.689,0    c-9.222,0-16.699,7.477-16.699,16.699s7.477,16.699,16.699,16.699h29.59l25.868,21.703c6.005,5.037,13.628,7.813,21.467,7.813    h45.607c7.838,0,15.462-2.774,21.468-7.814l79.115-66.383c7.76-6.511,19.424-5.432,25.824,2.634    C480.972,353.162,479.575,364.628,471.83,371.125z"/>
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M368.08,92.437l-67.065-9.744l-29.992-60.772c-6.113-12.386-23.833-12.393-29.949,0l-29.992,60.772l-67.065,9.744    c-13.669,1.987-19.151,18.836-9.255,28.483l48.528,47.306l-11.457,66.794c-2.336,13.613,11.995,24.034,24.229,17.604    l59.986-31.536l59.984,31.535c12.157,6.392,26.58-3.898,24.229-17.604l-11.457-66.794l48.529-47.305    C387.225,111.279,381.757,94.424,368.08,92.437z M301.626,207.317c-54.351-28.574-36.583-28.69-91.155,0    c10.384-60.549,15.947-43.691-28.169-86.694c60.547-8.798,46.15,2.338,73.747-53.579c27.188,55.09,12.78,44.721,73.745,53.579    C285.814,163.494,291.21,146.586,301.626,207.317z"/>
                    </g>
                  </g>
                </svg>
                <span>View Ratings</span>
              </a>
            </li>

            <li>
              <a href="#">
                <svg width="27px" height="267x" class="fui-Icon-regular ___12fm75w f1w7gpdv fez10in fg4l7m0" fill="currentColor" aria-hidden="true" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 13a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2ZM2 6.75A2.75 2.75 0 0 1 4.75 4h10.5A2.75 2.75 0 0 1 18 6.75v6.5A2.75 2.75 0 0 1 15.25 16H4.75A2.75 2.75 0 0 1 2 13.25v-6.5ZM4.75 5C3.78 5 3 5.78 3 6.75V8h14V6.75C17 5.78 16.22 5 15.25 5H4.75ZM17 9H3v4.25c0 .97.78 1.75 1.75 1.75h10.5c.97 0 1.75-.78 1.75-1.75V9Z" fill="currentColor"></path></svg>
                <span>Payment Options</span>
              </a>
            </li>

            <li>
              <a href="#">
                <svg width="23px" height="23px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 110.8V792H136V270.8l-27.6-21.5 39.3-50.5 42.8 33.3h643.1l42.8-33.3 39.3 50.5-27.7 21.5zM833.6 232L512 482 190.4 232l-42.8-33.3-39.3 50.5 27.6 21.5 341.6 265.6a55.99 55.99 0 0068.7 0L888 270.8l27.6-21.5-39.3-50.5-42.7 33.2z"/></svg>              
                <span>Email</span>
              </a>
            </li>

            <li>
              <a href="/chain-fortune/admin/blocked_IPs">
                <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M464 720a48 48 0 1096 0 48 48 0 10-96 0zm16-304v184c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V416c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8zm475.7 440l-416-720c-6.2-10.7-16.9-16-27.7-16s-21.6 5.3-27.7 16l-416 720C56 877.4 71.4 904 96 904h832c24.6 0 40-26.6 27.7-48zm-783.5-27.9L512 239.9l339.8 588.2H172.2z"/></svg>
                <span>Blocked IPs</span>
              </a>
            </li>
          ';
        }
        $conn->close();
      ?>
        <li>
          <a href="<?php echo $submit_kyc_url; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
            <path d="M4.39254 16.2614C2.64803 13.1941 1.66074 9.71783 1.51646 6.15051C1.50127 5.77507 1.70918 5.42812 2.04153 5.25282L11.5335 0.246091C11.8254 0.0920859 12.1746 0.0920859 12.4665 0.246091L21.9585 5.25282C22.2908 5.42812 22.4987 5.77507 22.4835 6.15051C22.3393 9.71783 21.352 13.1941 19.6075 16.2614C17.8618 19.3307 15.4169 21.8869 12.4986 23.7001C12.1931 23.8899 11.8069 23.8899 11.5014 23.7001C8.58313 21.8869 6.13817 19.3307 4.39254 16.2614Z" fill=""/>
            <path d="M8.25 12.75L11.25 15L17.25 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Account Verification</span>
          </a>
        </li> 
        
      <li>
        <a href="">
          <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M924.8 625.7l-65.5-56c3.1-19 4.7-38.4 4.7-57.8s-1.6-38.8-4.7-57.8l65.5-56a32.03 32.03 0 009.3-35.2l-.9-2.6a443.74 443.74 0 00-79.7-137.9l-1.8-2.1a32.12 32.12 0 00-35.1-9.5l-81.3 28.9c-30-24.6-63.5-44-99.7-57.6l-15.7-85a32.05 32.05 0 00-25.8-25.7l-2.7-.5c-52.1-9.4-106.9-9.4-159 0l-2.7.5a32.05 32.05 0 00-25.8 25.7l-15.8 85.4a351.86 351.86 0 00-99 57.4l-81.9-29.1a32 32 0 00-35.1 9.5l-1.8 2.1a446.02 446.02 0 00-79.7 137.9l-.9 2.6c-4.5 12.5-.8 26.5 9.3 35.2l66.3 56.6c-3.1 18.8-4.6 38-4.6 57.1 0 19.2 1.5 38.4 4.6 57.1L99 625.5a32.03 32.03 0 00-9.3 35.2l.9 2.6c18.1 50.4 44.9 96.9 79.7 137.9l1.8 2.1a32.12 32.12 0 0035.1 9.5l81.9-29.1c29.8 24.5 63.1 43.9 99 57.4l15.8 85.4a32.05 32.05 0 0025.8 25.7l2.7.5a449.4 449.4 0 00159 0l2.7-.5a32.05 32.05 0 0025.8-25.7l15.7-85a350 350 0 0099.7-57.6l81.3 28.9a32 32 0 0035.1-9.5l1.8-2.1c34.8-41.1 61.6-87.5 79.7-137.9l.9-2.6c4.5-12.3.8-26.3-9.3-35zM788.3 465.9c2.5 15.1 3.8 30.6 3.8 46.1s-1.3 31-3.8 46.1l-6.6 40.1 74.7 63.9a370.03 370.03 0 01-42.6 73.6L721 702.8l-31.4 25.8c-23.9 19.6-50.5 35-79.3 45.8l-38.1 14.3-17.9 97a377.5 377.5 0 01-85 0l-17.9-97.2-37.8-14.5c-28.5-10.8-55-26.2-78.7-45.7l-31.4-25.9-93.4 33.2c-17-22.9-31.2-47.6-42.6-73.6l75.5-64.5-6.5-40c-2.4-14.9-3.7-30.3-3.7-45.5 0-15.3 1.2-30.6 3.7-45.5l6.5-40-75.5-64.5c11.3-26.1 25.6-50.7 42.6-73.6l93.4 33.2 31.4-25.9c23.7-19.5 50.2-34.9 78.7-45.7l37.9-14.3 17.9-97.2c28.1-3.2 56.8-3.2 85 0l17.9 97 38.1 14.3c28.7 10.8 55.4 26.2 79.3 45.8l31.4 25.8 92.8-32.9c17 22.9 31.2 47.6 42.6 73.6L781.8 426l6.5 39.9zM512 326c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm79.2 255.2A111.6 111.6 0 01512 614c-29.9 0-58-11.7-79.2-32.8A111.6 111.6 0 01400 502c0-29.9 11.7-58 32.8-79.2C454 401.6 482.1 390 512 390c29.9 0 58 11.6 79.2 32.8A111.6 111.6 0 01624 502c0 29.9-11.7 58-32.8 79.2z"/></svg>
          <span>Settings</span>
        </a>
      </li> 
      <li class="logout" id="logout_btn">
        <a>
          <svg style="transform: rotate(180deg);" width="25px" height="25px" viewBox="64 64 896 896" focusable="false" xmlns="http://www.w3.org/2000/svg"><path d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 01-112.7 75.9A352.8 352.8 0 01512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 01-112.7-75.9 353.28 353.28 0 01-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 000-12.6z" /></svg>
          <span>Logout</span>
        </a>
      </li>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="/chain-fortune/js/sweetalert.min.js"></script>
      <script>
        document.getElementById('logout_btn').addEventListener('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to log out?",
                icon: 'warning',
                background: 'var(--hover-clr)',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: 'var(--negative-text-clr)',
                cancelButtonColor: 'var(--accent-clr)',
                confirmButtonText: 'Yes, log me out',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'swal2-dark-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/chain-fortune/action/logout', {
                        method: 'POST',
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Logout Successful',
                            text: response.message,
                            allowOutsideClick: false,
                            background: 'var(--hover-clr)',
                            color: '#ffffff',
                            confirmButtonColor: '#4caf50',
                            customClass: {
                                popup: 'swal2-dark-popup'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/chain-fortune/page/home';
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Logout Failed',
                            text: 'Something went wrong. Please try again.',
                            background: '#1e1e1e',
                            color: '#ffffff',
                            confirmButtonColor: '#ff4d4d'
                        });
                    });
                }
            });
        });
      </script>


  
  </ul>
</nav>
<?php include "../components/translator.php"; ?>

<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.production.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.production.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/d3@7.4.4/dist/d3.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.7.0/chart.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/sweetconsole.log/2.1.2/sweetconsole.log.min.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/gsap@3.9.1/dist/gsap.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/requirejs/2.3.6/require.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.0/mousetrap.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/p5.js@1.4.0/lib/p5.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/phoenix@2.0.1/phoenix.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/vis-network@9.0.4/dist/vis-network.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/4.1.1/intro.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/babel-polyfill@7.12.1/dist/polyfill.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/resize-observer-polyfill/1.5.1/ResizeObserver.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.3.2/moment-duration-format.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/ionicons@5.5.4/dist/ionicons.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/axios-jsonp@1.0.2/dist/axios-jsonp.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.1/leaflet.markercluster.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.13/dist/jquery.knob.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/foundation-sites/6.6.3/js/foundation.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/sass.js/0.10.10/sass.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/highcharts@9.2.2/highcharts.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/slickgrid/2.4.5/slick.grid.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jasny-bootstrap@4.0.0/dist/js/jasny-bootstrap.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/metro/4.5.8/js/metro.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jquery-circular-progressbar@1.0.0/dist/jquery-circular-progressbar.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/lottie-web@5.7.10/build/player/lottie.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/rickshaw/1.6.4/rickshaw.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/fabric@4.5.0/dist/fabric.min.js"></script>


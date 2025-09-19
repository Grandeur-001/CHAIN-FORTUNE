
<style>
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: none;
    justify-content: space-around;
    background-color: var(--base-clr);
    padding: 0.5rem;
    border-top: 1px solid var(--line-clr);
}

.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: var(--secondary-text-clr);
    padding: 0.5rem;
    position: relative;
    flex: 1;
    transition: color 0.3s ease;
    cursor: pointer;
}
.nav-item svg{
    fill: var(--secondary-text-clr);
    width: 24px;
    height: 24px;
}

.nav-item i {
    font-size: 1.2rem;
    margin-bottom: 0.3rem;
}

.nav-item span {
    font-size: 0.75rem;
    font-weight: 500;
}

.nav-item.active {
    color: var(--accent-clr);
}
.nav-item.active svg{
    fill: var(--accent-clr);

}




.nav-indicator {
    position: absolute;  
    top: 0;
    left: 0;
    height: 3px;
    background-color: var(--accent-clr);
    border-radius: 0 0 4px 4px;
    transition: transform 0.3s ease;
}

.dropdown {
    position: absolute;
    bottom: 100%;
    left: 60%;
    transform: translateX(-50%) translateY(10px);
    background-color: var(--hover-clr);
    border: 1px solid var(--line-clr);
    border-radius: 12px;
    padding: 0.5rem;
    width: 200px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    margin-bottom: 10px;
}

.dropdown::before {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 50%;
    transform: translateX(-50%);
    width: 12px;
    height: 12px;
    background-color: var(--hover-clr);
    border-right: 1px solid var(--line-clr);
    border-bottom: 1px solid var(--line-clr);
    transform-origin: center;
    rotate: 45deg;
}

.dropdown.active {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(0);
}



.dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.75rem 1rem;
    color: var(--secondary-text-clr);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: var(--base-clr);
    color: var(--text-clr);
}


.dropdown-item i {
    font-size: 1rem;
    margin-right: 0.75rem;
    margin-bottom: 0 !important;
}
.dropdown-item svg {
    fill: var(--secondary-text-clr);
    width: 24px;
    height: 24px;
}


.dropdown-item span {
    font-size: 0.9rem !important;
}
@media (max-width: 800px) {
    .bottom-nav{
        display: flex;
    }
}

@media (max-width: 380px) {
    .nav-item span {
        font-size: 0.7rem;
    }
    
    .nav-item i {
        font-size: 1rem;
    }

    .dropdown {
        width: 180px;
        padding: 0.4rem;
    }

    .dropdown-item {
        padding: 0.6rem 0.8rem;
    }

    .dropdown-item i {
        font-size: 0.9rem;
        margin-right: 0.5rem;
    }

    .dropdown-item span {
        font-size: 0.8rem !important;
    }
}

@media (max-width: 320px) {
    .nav-item {
        padding: 0.4rem 0.2rem;
    }

    .nav-item span {
        font-size: 0.65rem;
    }

    .nav-item i {
        font-size: 0.9rem;
    }

    .dropdown-item {
        padding: 0.5rem 0.6rem;
    }

    .dropdown-item i {
        font-size: 0.8rem;
        margin-right: 0.4rem;
    }

    .dropdown-item span {
        font-size: 0.75rem !important;
    }


}
</style>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<nav class="bottom-nav" id="bottom_nav">
    <a href="<?php echo $dashboard_url; ?>" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;" class="svg"  viewBox="0 -960 960 960"  fill=""><path d="M520-640v-160q0-17 11.5-28.5T560-840h240q17 0 28.5 11.5T840-800v160q0 17-11.5 28.5T800-600H560q-17 0-28.5-11.5T520-640ZM120-480v-320q0-17 11.5-28.5T160-840h240q17 0 28.5 11.5T440-800v320q0 17-11.5 28.5T400-440H160q-17 0-28.5-11.5T120-480Zm400 320v-320q0-17 11.5-28.5T560-520h240q17 0 28.5 11.5T840-480v320q0 17-11.5 28.5T800-120H560q-17 0-28.5-11.5T520-160Zm-400 0v-160q0-17 11.5-28.5T160-360h240q17 0 28.5 11.5T440-320v160q0 17-11.5 28.5T400-120H160q-17 0-28.5-11.5T120-160Zm80-360h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z"/></svg>
        <span>Dashboard</span>
    </a>
    <a href="<?php echo $profile_url; ?>" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32zm-40 728H184V184h656v656zM492 400h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H492c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8zm0 144h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H492c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8zm0 144h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H492c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8zM340 368a40 40 0 1080 0 40 40 0 10-80 0zm0 144a40 40 0 1080 0 40 40 0 10-80 0zm0 144a40 40 0 1080 0 40 40 0 10-80 0z"/></svg>
        <span>Profile</span>
    </a>

    <a href="<?php echo $exchange_url; ?>" class="nav-item">
        <svg width="24px" height="24px" viewBox="64 64 896 896" focusable="false">
          <path d="M847.9 592H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h605.2L612.9 851c-4.1 5.2-.4 13 6.3 13h72.5c4.9 0 9.5-2.2 12.6-6.1l168.8-214.1c16.5-21 1.6-51.8-25.2-51.8zM872 356H266.8l144.3-183c4.1-5.2.4-13-6.3-13h-72.5c-4.9 0-9.5 2.2-12.6 6.1L150.9 380.2c-16.5 21-1.6 51.8 25.1 51.8h696c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
        </svg>
        <span>Swap</span>
    </a>

    <a href="<?php echo $exchange_url; ?>" class="nav-item">
        <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M924.8 625.7l-65.5-56c3.1-19 4.7-38.4 4.7-57.8s-1.6-38.8-4.7-57.8l65.5-56a32.03 32.03 0 009.3-35.2l-.9-2.6a443.74 443.74 0 00-79.7-137.9l-1.8-2.1a32.12 32.12 0 00-35.1-9.5l-81.3 28.9c-30-24.6-63.5-44-99.7-57.6l-15.7-85a32.05 32.05 0 00-25.8-25.7l-2.7-.5c-52.1-9.4-106.9-9.4-159 0l-2.7.5a32.05 32.05 0 00-25.8 25.7l-15.8 85.4a351.86 351.86 0 00-99 57.4l-81.9-29.1a32 32 0 00-35.1 9.5l-1.8 2.1a446.02 446.02 0 00-79.7 137.9l-.9 2.6c-4.5 12.5-.8 26.5 9.3 35.2l66.3 56.6c-3.1 18.8-4.6 38-4.6 57.1 0 19.2 1.5 38.4 4.6 57.1L99 625.5a32.03 32.03 0 00-9.3 35.2l.9 2.6c18.1 50.4 44.9 96.9 79.7 137.9l1.8 2.1a32.12 32.12 0 0035.1 9.5l81.9-29.1c29.8 24.5 63.1 43.9 99 57.4l15.8 85.4a32.05 32.05 0 0025.8 25.7l2.7.5a449.4 449.4 0 00159 0l2.7-.5a32.05 32.05 0 0025.8-25.7l15.7-85a350 350 0 0099.7-57.6l81.3 28.9a32 32 0 0035.1-9.5l1.8-2.1c34.8-41.1 61.6-87.5 79.7-137.9l.9-2.6c4.5-12.3.8-26.3-9.3-35zM788.3 465.9c2.5 15.1 3.8 30.6 3.8 46.1s-1.3 31-3.8 46.1l-6.6 40.1 74.7 63.9a370.03 370.03 0 01-42.6 73.6L721 702.8l-31.4 25.8c-23.9 19.6-50.5 35-79.3 45.8l-38.1 14.3-17.9 97a377.5 377.5 0 01-85 0l-17.9-97.2-37.8-14.5c-28.5-10.8-55-26.2-78.7-45.7l-31.4-25.9-93.4 33.2c-17-22.9-31.2-47.6-42.6-73.6l75.5-64.5-6.5-40c-2.4-14.9-3.7-30.3-3.7-45.5 0-15.3 1.2-30.6 3.7-45.5l6.5-40-75.5-64.5c11.3-26.1 25.6-50.7 42.6-73.6l93.4 33.2 31.4-25.9c23.7-19.5 50.2-34.9 78.7-45.7l37.9-14.3 17.9-97.2c28.1-3.2 56.8-3.2 85 0l17.9 97 38.1 14.3c28.7 10.8 55.4 26.2 79.3 45.8l31.4 25.8 92.8-32.9c17 22.9 31.2 47.6 42.6 73.6L781.8 426l6.5 39.9zM512 326c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm79.2 255.2A111.6 111.6 0 01512 614c-29.9 0-58-11.7-79.2-32.8A111.6 111.6 0 01400 502c0-29.9 11.7-58 32.8-79.2C454 401.6 482.1 390 512 390c29.9 0 58 11.6 79.2 32.8A111.6 111.6 0 01624 502c0 29.9-11.7 58-32.8 79.2z"/></svg>
        <span>Settings</span>
    </a>
    
 
    <div class="nav-indicator"></div>
</nav>
<script src="../js/bottom_nav.js"></script>

<script>
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const SideBar = document.querySelector('.sidebar');
    const HideSidebarIcon = document.querySelector('.hide-sidebar');

    hamburgerMenu.addEventListener('click', () => {
        SideBar.classList.toggle('show-sidedar');
    })

    HideSidebarIcon.addEventListener('click', () => {
        SideBar.classList.toggle('show-sidedar');
    })


</script>
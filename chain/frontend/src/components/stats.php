<?php 
        include("../../../backend/connection.php");
        include('../../../backend/fetch_my_total_deposits.php');
        include('../../../backend/fetch_my_total_profits.php');
        
    if ($role === 'admin') {
        include('../../../backend/fetch_disabled_users.php');
        include('../../../backend/fetch_verified_users.php');
        include('../../../backend/fetch_unverified_users.php');
        include('../../../backend/fetch_total_deposits.php');
        include('../../../backend/fetch_total_withdrawals.php');
        include('../../../backend/fetch_total_users.php');
        include('../../../backend/fetch_total_pending_investments.php');
        include('../../../backend/fetch_total_completed_investments.php');
        include('../../../backend/fetch_total_canceled_investments.php');
        include('../../../backend/fetch_total_paused_investments.php');
        include('../../../backend/fetch_total_active_investments.php');

        
    }

?>
<style>
    .stats-container {
        width: 100%;
        max-width: 1200px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1rem;
    }

    .stat-card {
        border: 1px solid var(--line-clr);
        border-radius: 6px;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.2s ease;
        box-shadow: 0 3px 30px rgba(0, 0, 0, 0.212);
 

    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: var(--accent-clr);
    }

    .stat-info h2 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stat-info p {
        color: var(--secondary-text-clr);
        font-size: 0.9rem;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        background-color: var(--hover-clr);
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
   

    .stat-icon svg:not(.stroke) {
        width: 24px;
        height: 24px;
        fill: var(--accent-clr);
    }
    .stat-icon .stroke {
        width: 24px;
        height: 24px;
        stroke: var(--accent-clr);
    }

    .stat-card:hover .stat-icon svg:not(.stroke){
        fill: var(--text-clr);
    }
    .stat-card:hover .stat-icon .stroke{
        stroke: var(--text-clr);
    }

    @media (max-width: 768px) {
        .stats-container {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .stat-card {
            padding: 1rem;
        }

        .stat-info h2 {
            font-size: 1.5rem;
        }

        .stat-info p {
            font-size: 0.8rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
        }

        .stat-icon svg {
            width: 20px;
            height: 20px;
        }
    }
</style>
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-info">
            <h2>$<?php echo htmlspecialchars($user_total_deposits); ?></h2>
            <p>Your total deposits</p>
        </div>
        <div class="stat-icon">
            <svg fill="" width="" height="" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <g data-name="11. Phone" id="_11._Phone">

                <path d="M14,6a1,1,0,0,0,0-2H8A1,1,0,0,0,8,6Z"/>

                <path d="M21,8.84v-4A4.8,4.8,0,0,0,16.21,0H5.79A4.8,4.8,0,0,0,1,4.79V27.21A4.8,4.8,0,0,0,5.79,32H16.21A4.8,4.8,0,0,0,21,27.21v-.05A10,10,0,0,0,21,8.84ZM16.21,30H5.79A2.79,2.79,0,0,1,3,27.21V4.79A2.79,2.79,0,0,1,5.79,2H16.21A2.79,2.79,0,0,1,19,4.79V8.2A10.2,10.2,0,0,0,17,8a9.92,9.92,0,0,0-7,2.89V10a1,1,0,0,0-2,0V26a1,1,0,0,0,2,0v-.89A9.92,9.92,0,0,0,17,28a10.19,10.19,0,0,0,1.93-.19A2.79,2.79,0,0,1,16.21,30ZM17,26a8,8,0,0,1-7-4.14V14.14A8,8,0,1,1,17,26Z"/>

                <path d="M17,15h2a1,1,0,0,0,0-2H18a1,1,0,0,0-2,0v.18A3,3,0,0,0,17,19a1,1,0,0,1,0,2H15a1,1,0,0,0,0,2h1a1,1,0,0,0,2,0v-.18A3,3,0,0,0,17,17a1,1,0,0,1,0-2Z"/>

                <path d="M30,5H27.41l.3-.29a1,1,0,1,0-1.42-1.42l-2,2a1,1,0,0,0,0,1.42l2,2a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L27.41,7H30a1,1,0,0,0,0-2Z"/>
                </g>
            </svg>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h2>$<?php echo $user_total_profits ?></h2>
            <p>Your total profit</p>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:serif="http://www.serif.com/" xmlns:svg="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 512 512" id="svg2793" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve">

                <defs id="defs2797"/>

                <g id="_03-Profit" style="display:inline" transform="translate(-2048,7.53847e-4)">

                <g id="g2756" transform="translate(2132.93,29.6336)">

                <path d="m 0,166.206 c 1.848,0 3.727,-0.344 5.548,-1.069 L 245.19,69.65 234.235,95.126 c -3.272,7.61 0.244,16.433 7.855,19.706 1.931,0.83 3.941,1.224 5.919,1.224 5.812,0 11.345,-3.4 13.787,-9.079 l 25.26,-58.739 c 0.019,-0.046 0.032,-0.092 0.05,-0.137 0.172,-0.41 0.33,-0.825 0.464,-1.249 0.073,-0.226 0.123,-0.455 0.184,-0.682 0.065,-0.245 0.139,-0.487 0.191,-0.735 0.056,-0.26 0.09,-0.521 0.132,-0.781 0.035,-0.222 0.078,-0.443 0.104,-0.668 0.029,-0.258 0.039,-0.515 0.054,-0.773 0.014,-0.233 0.036,-0.463 0.038,-0.696 0.003,-0.246 -0.012,-0.488 -0.02,-0.732 -0.009,-0.246 -0.012,-0.492 -0.032,-0.739 -0.021,-0.239 -0.06,-0.475 -0.091,-0.711 -0.033,-0.248 -0.059,-0.496 -0.106,-0.744 -0.048,-0.267 -0.119,-0.53 -0.183,-0.793 -0.051,-0.212 -0.092,-0.425 -0.153,-0.636 -0.136,-0.475 -0.294,-0.941 -0.478,-1.4 V 36.76 c -0.183,-0.459 -0.391,-0.908 -0.617,-1.348 -0.104,-0.2 -0.224,-0.387 -0.335,-0.581 -0.132,-0.229 -0.258,-0.463 -0.403,-0.686 -0.141,-0.219 -0.298,-0.423 -0.451,-0.633 -0.134,-0.186 -0.262,-0.376 -0.406,-0.557 -0.161,-0.201 -0.335,-0.389 -0.506,-0.582 -0.155,-0.174 -0.304,-0.354 -0.467,-0.521 -0.171,-0.176 -0.354,-0.337 -0.534,-0.504 -0.179,-0.167 -0.353,-0.339 -0.543,-0.498 -0.185,-0.157 -0.381,-0.297 -0.574,-0.444 -0.196,-0.15 -0.387,-0.305 -0.592,-0.447 -0.23,-0.158 -0.471,-0.297 -0.71,-0.442 -0.179,-0.11 -0.352,-0.227 -0.538,-0.33 -0.434,-0.24 -0.88,-0.46 -1.336,-0.656 L 220.461,3.272 C 212.854,0 204.028,3.516 200.755,11.126 c -3.273,7.61 0.244,16.433 7.854,19.706 l 25.468,10.952 -239.634,95.484 c -7.695,3.066 -11.448,11.791 -8.382,19.487 2.341,5.874 7.979,9.451 13.939,9.451" id="path2754" style="fill-rule:nonzero"/>

                </g>

                <g id="g2760" transform="translate(2078,242.827)">

                <path d="m 0,104.978 c 0,-9.826 7.994,-17.819 17.82,-17.819 9.826,0 17.82,7.993 17.82,17.819 V 207.489 H 0 Z M 138.79,41.869 c 0,-4.77 1.85,-9.243 5.225,-12.613 3.353,-3.358 7.826,-5.208 12.595,-5.208 4.763,0 9.232,1.85 12.602,5.226 3.365,3.359 5.218,7.832 5.218,12.595 v 165.62 h -35.64 z m 138.78,-52.88 c 0,-9.826 7.994,-17.821 17.82,-17.821 9.826,0 17.82,7.995 17.82,17.821 v 218.5 h -35.64 z m 138.79,-73.681 c 0,-9.826 7.994,-17.819 17.82,-17.819 9.826,0 17.82,7.993 17.82,17.819 v 292.181 h -35.64 z m 17.82,-47.819 c -26.368,0 -47.82,21.452 -47.82,47.819 v 292.181 h -43.15 v -218.5 c 0,-26.368 -21.452,-47.821 -47.82,-47.821 -26.368,0 -47.82,21.453 -47.82,47.821 v 218.5 H 204.43 V 41.869 c 0,-12.786 -4.98,-24.799 -14.005,-33.808 -9.02,-9.036 -21.029,-14.013 -33.815,-14.013 -12.792,0 -24.805,4.977 -33.808,13.995 -9.036,9.022 -14.012,21.035 -14.012,33.826 v 165.62 H 65.64 V 104.978 C 65.64,78.611 44.188,57.159 17.82,57.159 -8.548,57.159 -30,78.611 -30,104.978 v 117.511 c 0,8.284 6.716,15 15,15 h 482 c 8.284,0 15,-6.716 15,-15 V -84.692 c 0,-26.367 -21.452,-47.819 -47.82,-47.819" id="path2758" style="fill-rule:nonzero"/>

                </g>

                </g>

            </svg>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h2>$0.00</h2>
            <p>Total Bonus</p>
        </div>
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M880 310H732.4c13.6-21.4 21.6-46.8 21.6-74 0-76.1-61.9-138-138-138-41.4 0-78.7 18.4-104 47.4-25.3-29-62.6-47.4-104-47.4-76.1 0-138 61.9-138 138 0 27.2 7.9 52.6 21.6 74H144c-17.7 0-32 14.3-32 32v200c0 4.4 3.6 8 8 8h40v344c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V550h40c4.4 0 8-3.6 8-8V342c0-17.7-14.3-32-32-32zm-334-74c0-38.6 31.4-70 70-70s70 31.4 70 70-31.4 70-70 70h-70v-70zm-138-70c38.6 0 70 31.4 70 70v70h-70c-38.6 0-70-31.4-70-70s31.4-70 70-70zM180 482V378h298v104H180zm48 68h250v308H228V550zm568 308H546V550h250v308zm48-376H546V378h298v104z"/></svg>
        </div>
    </div>

    <?php 
        if ($role === 'admin') {
            echo '
                <div class="stat-card">
                    <div class="stat-info">
                        <h2>$' . $total_deposits . '</h2>
                        <p>Total Amount of Deposits</p>
                    </div>
                    <div class="stat-icon">
                        <svg fill="" width="" height="" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <g data-name="11. Phone" id="_11._Phone">

                            <path d="M14,6a1,1,0,0,0,0-2H8A1,1,0,0,0,8,6Z"/>

                            <path d="M21,8.84v-4A4.8,4.8,0,0,0,16.21,0H5.79A4.8,4.8,0,0,0,1,4.79V27.21A4.8,4.8,0,0,0,5.79,32H16.21A4.8,4.8,0,0,0,21,27.21v-.05A10,10,0,0,0,21,8.84ZM16.21,30H5.79A2.79,2.79,0,0,1,3,27.21V4.79A2.79,2.79,0,0,1,5.79,2H16.21A2.79,2.79,0,0,1,19,4.79V8.2A10.2,10.2,0,0,0,17,8a9.92,9.92,0,0,0-7,2.89V10a1,1,0,0,0-2,0V26a1,1,0,0,0,2,0v-.89A9.92,9.92,0,0,0,17,28a10.19,10.19,0,0,0,1.93-.19A2.79,2.79,0,0,1,16.21,30ZM17,26a8,8,0,0,1-7-4.14V14.14A8,8,0,1,1,17,26Z"/>

                            <path d="M17,15h2a1,1,0,0,0,0-2H18a1,1,0,0,0-2,0v.18A3,3,0,0,0,17,19a1,1,0,0,1,0,2H15a1,1,0,0,0,0,2h1a1,1,0,0,0,2,0v-.18A3,3,0,0,0,17,17a1,1,0,0,1,0-2Z"/>

                            <path d="M30,5H27.41l.3-.29a1,1,0,1,0-1.42-1.42l-2,2a1,1,0,0,0,0,1.42l2,2a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L27.41,7H30a1,1,0,0,0,0-2Z"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_withdrawals["total_withdrawals"] .'</h2>
                        <p>Total Withdrawals</p>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path d="M12 9C11.4477 9 11 9.44771 11 10V15.5856L9.70711 14.2928C9.3166 13.9024 8.68343 13.9024 8.29292 14.2928C7.90236 14.6834 7.90236 15.3165 8.29292 15.7071L11.292 18.7063C11.6823 19.0965 12.3149 19.0968 12.7055 18.707L15.705 15.7137C16.0955 15.3233 16.0955 14.69 15.705 14.2996C15.3145 13.909 14.6814 13.909 14.2908 14.2996L13 15.5903V10C13 9.44771 12.5523 9 12 9Z" fill=""/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21 1C22.6569 1 24 2.34315 24 4V8C24 9.65685 22.6569 11 21 11H19V20C19 21.6569 17.6569 23 16 23H8C6.34315 23 5 21.6569 5 20V11H3C1.34315 11 0 9.65685 0 8V4C0 2.34315 1.34315 1 3 1H21ZM22 8C22 8.55228 21.5523 9 21 9H19V7H20C20.5523 7 21 6.55229 21 6C21 5.44772 20.5523 5 20 5H4C3.44772 5 3 5.44772 3 6C3 6.55229 3.44772 7 4 7H5V9H3C2.44772 9 2 8.55228 2 8V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V8ZM7 7V20C7 20.5523 7.44772 21 8 21H16C16.5523 21 17 20.5523 17 20V7H7Z" fill=""/>
                        </svg>
                        
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'.$row_users["total_users"].'</h2>
                        <p>Total Users</p>
                    </div>
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="stroke" fill="none" d="M3 19H1V18C1 16.1362 2.27477 14.57 4 14.126M6 10.8293C4.83481 10.4175 4 9.30623 4 8.00001C4 6.69379 4.83481 5.58255 6 5.17072M21 19H23V18C23 16.1362 21.7252 14.57 20 14.126M18 5.17072C19.1652 5.58255 20 6.69379 20 8.00001C20 9.30623 19.1652 10.4175 18 10.8293M10 14H14C16.2091 14 18 15.7909 18 18V19H6V18C6 15.7909 7.79086 14 10 14ZM15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5C13.6569 5 15 6.34315 15 8Z" stroke="#e8eaed" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_verified['verified_user_count'] .'</h2>
                        <p>Verified Users</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="stroke" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-check "><path d="M2 21a8 8 0 0 1 13.292-6"></path><circle cx="10" cy="8" r="5"></circle><path d="m16 19 2 2 4-4"></path></svg>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_unverified['unverified_user_count'].'</h2>
                        <p>Unverified Users</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-x "><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="17" x2="22" y1="8" y2="13"></line><line x1="22" x2="17" y1="8" y2="13"></line></svg>
                        <!-- <svg class="stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-x "><path d="M2 21a8 8 0 0 1 11.873-7"></path><circle cx="10" cy="8" r="5"></circle><path d="m17 17 5 5"></path><path d="m22 17-5 5"></path></svg> -->
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_disabled_users['disabled_user_count'].'</h2>
                        <p>Disabled Users</p>
                    </div>
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="stroke" fill="none" d="M3 19H1V18C1 16.1362 2.27477 14.57 4 14.126M6 10.8293C4.83481 10.4175 4 9.30623 4 8.00001C4 6.69379 4.83481 5.58255 6 5.17072M21 19H23V18C23 16.1362 21.7252 14.57 20 14.126M18 5.17072C19.1652 5.58255 20 6.69379 20 8.00001C20 9.30623 19.1652 10.4175 18 10.8293M10 14H14C16.2091 14 18 15.7909 18 18V19H6V18C6 15.7909 7.79086 14 10 14ZM15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5C13.6569 5 15 6.34315 15 8Z" stroke="#e8eaed" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>48</h2>
                        <p>Testimony Requests</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-person-standing "><circle cx="12" cy="5" r="1"></circle><path d="m9 20 3-6 3 6"></path><path d="m6 8 6 2 6-2"></path><path d="M12 10v4"></path></svg>
                    
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_completed_investments['completed'].'</h2>
                        <p>Completed Investment</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-square "><path d="m9 11 3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_pending_investments['pending'].'</h2>
                        <p>Pending Investment</p>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke" viewBox="0 0 24 24"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"/></g></svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_canceled_investments['canceled'].'</h2>
                        <p>Canceled Investment</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="cancel-svg" fill-rule="evenodd" viewBox="64 64 896 896" focusable="false">
                            <path d="M512 64c247.4 0 448 200.6 448 448S759.4 960 512 960 64 759.4 64 512 264.6 64 512 64zm127.98 274.82h-.04l-.08.06L512 466.75 384.14 338.88c-.04-.05-.06-.06-.08-.06a.12.12 0 00-.07 0c-.03 0-.05.01-.09.05l-45.02 45.02a.2.2 0 00-.05.09.12.12 0 000 .07v.02a.27.27 0 00.06.06L466.75 512 338.88 639.86c-.05.04-.06.06-.06.08a.12.12 0 000 .07c0 .03.01.05.05.09l45.02 45.02a.2.2 0 00.09.05.12.12 0 00.07 0c.02 0 .04-.01.08-.05L512 557.25l127.86 127.87c.04.04.06.05.08.05a.12.12 0 00.07 0c.03 0 .05-.01.09-.05l45.02-45.02a.2.2 0 00.05-.09.12.12 0 000-.07v-.02a.27.27 0 00-.05-.06L557.25 512l127.87-127.86c.04-.04.05-.06.05-.08a.12.12 0 000-.07c0-.03-.01-.05-.05-.09l-45.02-45.02a.2.2 0 00-.09-.05.12.12 0 00-.07 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_paused_investments['paused'].'</h2>
                        <p>Paused Investment</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="cancel-svg" fill-rule="evenodd" viewBox="64 64 896 896" focusable="false">
                            <path d="M512 64c247.4 0 448 200.6 448 448S759.4 960 512 960 64 759.4 64 512 264.6 64 512 64zm127.98 274.82h-.04l-.08.06L512 466.75 384.14 338.88c-.04-.05-.06-.06-.08-.06a.12.12 0 00-.07 0c-.03 0-.05.01-.09.05l-45.02 45.02a.2.2 0 00-.05.09.12.12 0 000 .07v.02a.27.27 0 00.06.06L466.75 512 338.88 639.86c-.05.04-.06.06-.06.08a.12.12 0 000 .07c0 .03.01.05.05.09l45.02 45.02a.2.2 0 00.09.05.12.12 0 00.07 0c.02 0 .04-.01.08-.05L512 557.25l127.86 127.87c.04.04.06.05.08.05a.12.12 0 00.07 0c.03 0 .05-.01.09-.05l45.02-45.02a.2.2 0 00.05-.09.12.12 0 000-.07v-.02a.27.27 0 00-.05-.06L557.25 512l127.87-127.86c.04-.04.05-.06.05-.08a.12.12 0 000-.07c0-.03-.01-.05-.05-.09l-45.02-45.02a.2.2 0 00-.09-.05.12.12 0 00-.07 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h2>'. $row_active_investments['active'].'</h2>
                        <p>Active Investment</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="cancel-svg" fill-rule="evenodd" viewBox="64 64 896 896" focusable="false">
                            <path d="M512 64c247.4 0 448 200.6 448 448S759.4 960 512 960 64 759.4 64 512 264.6 64 512 64zm127.98 274.82h-.04l-.08.06L512 466.75 384.14 338.88c-.04-.05-.06-.06-.08-.06a.12.12 0 00-.07 0c-.03 0-.05.01-.09.05l-45.02 45.02a.2.2 0 00-.05.09.12.12 0 000 .07v.02a.27.27 0 00.06.06L466.75 512 338.88 639.86c-.05.04-.06.06-.06.08a.12.12 0 000 .07c0 .03.01.05.05.09l45.02 45.02a.2.2 0 00.09.05.12.12 0 00.07 0c.02 0 .04-.01.08-.05L512 557.25l127.86 127.87c.04.04.06.05.08.05a.12.12 0 00.07 0c.03 0 .05-.01.09-.05l45.02-45.02a.2.2 0 00.05-.09.12.12 0 000-.07v-.02a.27.27 0 00-.05-.06L557.25 512l127.87-127.86c.04-.04.05-.06.05-.08a.12.12 0 000-.07c0-.03-.01-.05-.05-.09l-45.02-45.02a.2.2 0 00-.09-.05.12.12 0 00-.07 0z"/>
                        </svg>
                    </div>
                </div>

            ';
        }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .stat-chart-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .stat-chart-card {
        background-color: var(--base-clr);
        border: 1px solid var(--line-clr);
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .stat-chart-card:hover {
        /* background-color: var(--hover-clr); */
        border-color: var(--accent-clr);
    }

    .stat-chart-card-header {
        margin-bottom: 1.5rem;
    }

    .stat-chart-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-clr);
        margin-bottom: 0.5rem;
    }

    .stat-chart-card-description {
        font-size: 0.875rem;
        color: var(--secondary-text-clr);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-clr);
        display: block;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--secondary-text-clr);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin-top: 1rem;
    }

    .legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: var(--secondary-text-clr);
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    .pending-color { background-color: var(--pending-text-clr); }
    .declined-color { background-color: var(--negative-text-clr); }
    .approved-color { background-color: var(--positive-text-clr); }
    .total-color { background-color: var(--accent-clr); }

    /* Responsive Design */
    @media (min-width: 768px) {
        .stat-chart-container {
            grid-template-columns: 1fr 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 480px) {
      
        
        .start-chart-card {
            padding: 1rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
        
        .card-title {
            font-size: 1.1rem;
        }
        
        .chart-container {
            height: 250px;
        }
        
        .legend {
            gap: 0.5rem;
        }
        
        .legend-item {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 320px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
        
        .stat-number {
            font-size: 1.25rem;
        }
        
        .stat-label {
            font-size: 0.65rem;
        }
        
        .chart-container {
            height: 200px;
        }
        
        .legend {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
</style>

<?php
    if ($role === 'admin') {
        echo(<<<HTML
            <br>
        HTML);
    }
    function getCount($table, $status) {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table` WHERE `status` = ?");
        $stmt->bind_param('s', $status);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count;
    }
    if ($role === 'admin') {
        $deposit_pending   = getCount('deposit_transactions', 'Pending');
        $deposit_confirmed = getCount('deposit_transactions', 'Approved');
        $deposit_declined  = getCount('deposit_transactions', 'Declined');
        $deposit_total     = $deposit_pending + $deposit_confirmed + $deposit_declined;
    
        $withdraw_pending   = getCount('withdrawal_transactions', 'Pending');
        $withdraw_confirmed = getCount('withdrawal_transactions', 'Approved');
        $withdraw_declined  = getCount('withdrawal_transactions', 'Declined');
        $withdraw_total     = $withdraw_pending + $withdraw_confirmed + $withdraw_declined;
    
        
    
        echo <<<HTML
            <div class="stat-chart-container">
                <!-- Deposit Transactions Card -->
                <div class="stat-chart-card">
                    <div class="stat-chart-card-header">
                        <h2 class="stat-chart-card-title">Deposit Transactions</h2>
                        <p class="stat-chart-card-description">All deposit transactions made by your users</p>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{$deposit_total}</span>
                            <span class="stat-label">Total</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{$deposit_pending}</span>
                            <span class="stat-label">Pending</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{$deposit_confirmed}</span>
                            <span class="stat-label">Confirm</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{$deposit_declined}</span>
                            <span class="stat-label">Declined</span>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="depositChart"></canvas>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color pending-color"></div>
                            <span>Deposit Counts</span>
                        </div>
                    </div>
                </div>
    
                <!-- Withdrawal Transactions Card -->
                <div class="stat-chart-card">
                    <div class="stat-chart-card-header">
                        <h2 class="stat-chart-card-title">Withdrawal Transactions</h2>
                        <p class="stat-chart-card-description">All withdrawal transactions made by your users</p>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{$withdraw_total}</span>
                            <span class="stat-label">Total</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{$withdraw_pending}</span>
                            <span class="stat-label">Pending</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{$withdraw_confirmed}</span>
                            <span class="stat-label">Confirm</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{$withdraw_declined}</span>
                            <span class="stat-label">Declined</span>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="withdrawalChart"></canvas>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color pending-color"></div>
                            <span>Withdrawal Counts</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <script>
                Chart.defaults.color = '#b0b3c1';
                Chart.defaults.borderColor = '#42434a';
                Chart.defaults.backgroundColor = '#11121a';
    
                const depositCtx = document.getElementById('depositChart').getContext('2d');
                const depositChart = new Chart(depositCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Pending', 'Declined', 'Approved', 'Total'],
                        datasets: [{
                            data: [{$deposit_pending}, {$deposit_declined}, {$deposit_confirmed}, {$deposit_total}],
                            backgroundColor: ['#f39c12', '#e74c3c', '#10B981', '#5e63ff'],
                            borderColor: ['#f39c12', '#e74c3c', '#10B981', '#5e63ff'],
                            borderWidth: 1,
                            borderRadius: 4,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#222533',
                                titleColor: '#e6e6ef',
                                bodyColor: '#e6e6ef',
                                borderColor: '#42434a',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#42434a', drawBorder: false },
                                ticks: { color: '#b0b3c1', font: { size: 11 } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#b0b3c1', font: { size: 11 } }
                            }
                        },
                        interaction: { intersect: false, mode: 'index' },
                        animation: { duration: 1000, easing: 'easeInOutQuart' }
                    }
                });
    
                const withdrawalCtx = document.getElementById('withdrawalChart').getContext('2d');
                const withdrawalChart = new Chart(withdrawalCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Pending', 'Declined', 'Approved', 'Total'],
                        datasets: [{
                            data: [{$withdraw_pending}, {$withdraw_declined}, {$withdraw_confirmed}, {$withdraw_total}],
                            backgroundColor: ['#f39c12', '#e74c3c', '#10B981', '#5e63ff'],
                            borderColor: ['#f39c12', '#e74c3c', '#10B981', '#5e63ff'],
                            borderWidth: 1,
                            borderRadius: 4,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#222533',
                                titleColor: '#e6e6ef',
                                bodyColor: '#e6e6ef',
                                borderColor: '#42434a',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#42434a', drawBorder: false },
                                ticks: { color: '#b0b3c1', font: { size: 11 } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#b0b3c1', font: { size: 11 } }
                            }
                        },
                        interaction: { intersect: false, mode: 'index' },
                        animation: { duration: 1000, easing: 'easeInOutQuart' }
                    }
                });
    
                window.addEventListener('resize', () => {
                    depositChart.resize();
                    withdrawalChart.resize();
                });
            </script>
        HTML;
    }
?>





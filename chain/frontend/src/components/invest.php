<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune../styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[5]
            sideBarItem.classList.add("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[0];
            navItem.classList.add("active");
        });
    </script>
    <style>
        #main{
            margin-top: 11rem;
            margin-left: 17rem;
            transition: all 300ms ease-in-out;

        }
        .app-container {
            width: 100%;
            padding: 20px;
        }



        /* reusable styles */
        .plan-dropdown-btn{
            border: none;
            outline: none;
            background: var(--hover-clr);
            cursor: pointer;
            display: grid;
            place-content: center;
            padding: 3px;
            border-radius: 3px;
        }
        .plan-dropdown-btn.clicked{
            background: var(--accent-clr);
        }

        .btn-group {
            position: relative;
            border-radius: 50%;
        }

        .action-dropdown-menu {
            position: absolute;
            right: 10%;
            top: 100%;
            background: var(--hover-clr);
            border-radius: 12px;
            padding: 8px 10px;
            margin-top: 13px;
            min-width: 130px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 900;
        
        }
        
        .action-dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            padding: 12px 16px;
            display: block;
            color: var(--secondary-text);
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease;
            border-radius: 0px;
            border: none;
            background: transparent;
            width: 100%;
            display: flex;
            cursor: pointer;
        }
        
        .dropdown-item:hover {
            border-radius: 10px;
            background-color: var(--hover-color);
            color: var(--text-color);
        }






        /* Header Styles */
        .header-section {
            margin-bottom: 4rem;
        }

        .header-section h1 {
            font-size: 2.3rem;
            font-weight: 700;
            margin-left: 14px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .investment-intro {
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        .investment-intro h2 {
            font-size: 2rem;
            text-align:center;
            
        }

        .investment-intro p {
            color: var(--secondary-text-clr);
            font-size: 1.1rem;
            line-height: 1.6;
            margin: auto;
            padding-bottom: 10px;
            max-width: 600px;
            text-align: center;
        }

        .account-balance,
        .plans-header {
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .balance-label {
            font-size: 0.799rem;
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        .balance-amount {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-clr);
        }

        .plans-header{

            .wrapper{
                display: flex;
                align-items: center;
                justify-content: space-between;

                span p{
                    color: var(--secondary-text-clr);
                }
            }
        }




        










        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            width: 100%;
        }

        .card {
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: 2rem;
            transition: all 0.6s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border-color: var(--accent-clr);
        }

        .card-header{
            display: flex;
            flex-direction: column;
            gap: 10px;
            
            > div{
                display: flex;
                width: 100%;
                justify-content: space-between;

                > span{
                    color: var(--accent-clr);
                    font-weight: 600;
                    text-transform: uppercase;
                }
                > button{
                    border: none;
                    outline: none;
                    background: var(--hover-clr);
                    cursor: pointer;
                    display: grid;
                    place-content: center;
                    padding: 3px;
                    border-radius: 3px;
                }
               
            }

            > h1{
                padding-bottom: 10px;
                display: block;
                font-size: calc(1.495rem + 1.7vw);
            }
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-top: 10px;
        }

        .amount-group, .duration-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--line-clr);
        }

        .label {
            color: var(--secondary-text-clr);
            font-size: 1rem;
        }

        .value {
            color: var(--text-clr);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .includes-group{

            display: flex;
            flex-direction: column;
            gap: 8px;

            h6{
                font-size: 1.4rem;
                color: var(--accent-clr);
            }
            ul{
                display: flex;
                gap: 13px;
                flex-direction: column;
                list-style-type: disc;
                margin-left: 10px;

                li{
                    font-size: 0.9rem;
                    list-style-type: disc;
                    color: var(--secondary-text-clr);
                }
            }
        }

        .invest-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }

        .invest-section label {
            color: var(--secondary-text-clr);
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .currency {
            position: absolute;
            left: 1rem;
            color: var(--secondary-text-clr);
        }

        input {
            width: 100%;
            padding: 1rem;
            padding-left: 2.5rem;
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            color: var(--text-clr);
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--accent-clr);
            box-shadow: 0 0 0 4px var(--input-focus-clr);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .invest-btn {
            background-color: var(--accent-clr);
            color: var(--text-clr);
            border: none;
            border-radius: 7px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .invest-btn:hover {
            background-color: #4a4fff;
        }

        @media (max-width: 800px) {
            #main{
                margin-left: 0;
            }
            .app-container {
                padding: 0.7rem;
            }
        }
        @media (max-width: 768px) {

            .header-section h1 {
                font-size: 2.5rem;
                margin-bottom: 2rem;
            }

            .investment-intro {
                padding: 2rem;
            }

            .investment-intro h2 {
                font-size: 1.75rem;
            }

            .investment-intro p {
                font-size: 1rem;
            }

            .card-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem 0.5rem;
            }

            .header-section h1 {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }

            .investment-intro {
                padding: 1.5rem;
            }

            .investment-intro h2 {
                font-size: 1.5rem;
            }

            .balance-amount {
                font-size: 1.75rem;
            }

            .card {
                padding: 1.25rem;
            }

            h2 {
                font-size: 1.25rem;
            }

            .value {
                font-size: 1rem;
            }

            .create_plan_section{
                padding-top: 4rem;
            }
        }

        @media (max-width: 320px) {
            .header-section h1 {
                font-size: 1.75rem;
            }

            .investment-intro {
                padding: 1rem;
            }

            .investment-intro h2 {
                font-size: 1.25rem;
            }

            .investment-intro p {
                font-size: 0.9rem;
            }

            .card-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 1rem;
            }

            .amount-group, .duration-group {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style> 


</head>


<body>
    <?php include "../../../backend/fetch_plans.php"; ?>
    <?php include "../components/toastify.php"; ?>
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>

    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweetalert.min.js"></script>

    <main class="main" id="main">
        <div class="app-container">
            <header class="header-section">
                <h1>Investment Plans / Features</h1>
                <div class="investment-intro">
                    <h2>Invest in a Plan</h2>
                    <p>Make your money work for you and earn profits by investing in our world-class auto-trading packages.</p>
                    <div class="account-balance">
                        <span class="balance-label">My Balance:</span>
                        <?php
                            if (!isset($_SESSION['user_id'])) {
                                die('Session user_id not set!');
                            }

                            include('../../../backend/connection.php');

                            function getTotalBalance($userId, $conn) {
                                $query = "SELECT SUM(uw.amount) AS total_balance FROM users_wallet uw WHERE uw.user_id = ?";

                                $stmt = $conn->prepare($query);
                                if (!$stmt) {
                                    error_log("Prepare failed: " . $conn->error);
                                    return 0;
                                }

                                $stmt->bind_param("i", $userId);
                                $stmt->execute();
                                $stmt->bind_result($total);
                                $stmt->fetch();
                                $stmt->close();

                                return $total ?? 0;
                            }

                            $user_id = $_SESSION['user_id'];
                            $totalBalance = getTotalBalance($user_id, $conn);
                            
                            $formatted = number_format($totalBalance, 2);
                            list($intPart, $decimalPart) = explode('.', $formatted);
                            echo '<span class="balance-amount">$' . $intPart . '.<span class="decimal">' . $decimalPart . '</span></span>';
                        ?>
                    </div>
                </div>
            </header>

            <!-- plans header -->
            <div class="plans-header create-plan">
                <div class="wrapper">

                   <span>
                    <h2>
                        All Plans
                    </h2>
                    <p>
                        Start With a Plan Now!
                    </p>
                   </span>

                    <div class="btn-group">
                        <?php 
                            if ($role === 'admin') {
                                echo(<<<HTML
                                    <button type="button" class="plan-dropdown-btn dropdown-toggle" onclick="toggleDropdown(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                            <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"></path>
                                        </svg>
                                    </button>
                                HTML);
                            }
                        ?>
                        <div class="action-dropdown-menu">
                            <button class="dropdown-item create_plan" id="show-create-plan" name="create_plan" onclick="openCreatePlan('create-plan-modal')">
                                <?= $plan === false ? 'Create Plan' : 'Add Plan'?>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="side-modal create-plan-modal" id="create-plan-modal">
                    <div class="side-modal-overlay">
                        <div class="side-modal-dialog">
                            <div class="side-modal-content">
                                <div class="side-modal-header">
                                    <div class="side-modal-title">
                                        <h5>Create New Plan</h5>
                                    </div>

                                    <div class="close-side-modal-btn close-side-modal">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="side-modal-body">
                                    <div class="side-modal-body-wrapper">

                                        <label for="plan_name">Plan name*</label>
                                        <input id="plan_name" name="plan_name" type="text" placeholder="Enter Plan name" style="width: 100%;">
                                        
                                        <label for="percentage">Percentage*</label>
                                        <input id="percentage" name="percentage" type="text" placeholder="Enter Percentage name" style="width: 100%;">
                                        
                                        <label for="minimum">Minimum Amount*</label>
                                        <div class="input-wrapper">
                                            <span class="currency"></span>
                                            <input  type="number" name="minimum" id="minimum" placeholder="0.00">
                                        </div>

                                        <label for="maximum">Maximum Amount*</label>
                                        <div class="input-wrapper">
                                            <span class="currency"></span>
                                            <input  type="number" name="maximum" id="maximum" placeholder="0.00">
                                        </div>

                                        <label for="duration">Duration</label>
                                        <select id="duration" name="duration" style="width: 100%;" required="">
                                            <option value="">Choose</option>
                                            <option disabled value="5">Every Five Minutes</option>
                                            <option disabled value="10">Every Ten Minutes</option>
                                            <option disabled value="30">Every Thirty Minutes</option>
                                            <option disabled value="60">Hourly</option>
                                            <option disabled value="360">Every Six Hours</option>
                                            <option disabled value="720">Twice Daily</option>
                                            <option disabled value="1440">Daily</option>
                                            <option value="4320">72 Hours</option>
                                            <option value="20160">Two Weeks</option>
                                            <option value="10080">7 Days</option>
                                            <option style="color: var(--negative-text-clr);" value="43200">Monthly</option>
                                            <option style="color: var(--negative-text-clr);" value="129600">Three Months</option>
                                            <option style="color: var(--negative-text-clr);" value="259200">Six Months</option>
                                        </select>

                                        <label for="duration_timeframe">Duration Timeframe*</label>
                                        <input disabled readonly id="duration_timeframe" name="duration_timeframe" value="" type="text" placeholder="Enter Duration Timeframe" style="width: 100%;" required>
                                        


                                        <label for="roi">ROI*</label>
                                        <input id="roi" name="roi" type="text" placeholder="Enter ROI" style="width: 100%;">

                                        
                                        
                                        <label for="commission">Commission*</label>
                                        <div class="input-wrapper">
                                            <span class="currency"></span>
                                            <input  type="number" name="commission" id="commission" placeholder="0.00">
                                        </div>

                                        <label for="benefit">Benefit*</label>
                                        <input id="benefit" name="benefit" type="text" placeholder="Enter Benefit" style="width: 100%;">
                                    

                                    </div>
                                </div>
                                <div class="side-modal-footer">
                                    <div class="side-modal-footer-wrapper">
                                        <button class="btn btn-danger close-side-modal">Close</button>
                                        <button class="btn btn-primary create-plan-btn" id="create-plan-btn">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function openCreatePlan(sectionId) {
                        const $section = $(`#${sectionId}`);
                        const $sideModalOverlay = $section.find('.side-modal-overlay');

                        if ($section.length === 0) return;

                        $section.css({
                            visibility: 'visible',
                        });

                        $(".side-modal-dialog").css({
                            transform: "translateX(0)",
                        });
                    };

                    $(document).ready(function() {
                        $('#create-plan-btn').click(function() {
                            const modal = $('#create-plan-modal');
                            const plan_name = modal.find('input[name="plan_name"]').val().trim();
                            const percentage = modal.find('input[name="percentage"]').val().trim();
                            const minimum = modal.find('input[name="minimum"]').val().trim();
                            const maximum = modal.find('input[name="maximum"]').val().trim();
                            const duration = modal.find('select[name="duration"]').val();
                            const duration_timeframe = modal.find('input[name="duration_timeframe"]').val();
                            const roi = modal.find('input[name="roi"]').val().trim();
                            const commission = modal.find('input[name="commission"]').val().trim();
                            const benefit = modal.find('input[name="benefit"]').val().trim();

                            

                            if (!plan_name || !percentage || !minimum || !maximum || !duration || !duration_timeframe || !roi || !commission || !benefit) {
                                showToast('error', 'Fill All fields');
                            }
                            else{
                                $('#create-plan-btn').prop('disabled', true).html('<svg xmlns="http://www.w3.org/2000/svg" width="20" class="stroke" stroke="var(--text-clr)" viewBox="0 0 24 24"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"></animate><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"></animate></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"></animateTransform></g></svg>');
                                $.ajax({
                                    url: '/chain-fortune/action/create_plan',
                                    type: 'POST',
                                    data: {
                                        plan_name,
                                        percentage,
                                        minimum,
                                        maximum,
                                        duration,
                                        duration_timeframe,
                                        roi,
                                        commission,
                                        benefit,
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        const data = response;
                                        if (data.status === 'success') {
                                            $('.side-modal').each(function () {
                                                $(this).css('visibility', 'hidden');
                                            });

                                            $(".side-modal-dialog").each(function () {
                                                $(this).css('transform', 'translateX(-100%)');
                                            });
                                            setTimeout(() => {
                                                showToast('success', data.message);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'New Plan Added',
                                                    text: data.message,
                                                    background: '#1e1e1e',
                                                    color: '#ffffff',
                                                    confirmButtonColor: '#4caf50',
                                                    customClass: {
                                                        popup: 'swal2-dark-popup'
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        location.reload();
                                                    }
                                                });
                                            }, 1000);
                                        } else {
                                            showToast('error', data.message);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("AJAX Error:", status, error);
                                        showToast('error', 'Server error. Please try again.');
                                    }
                                });
                            }
                          
                        });
                    });
                </script>
            </div>
            
            <div class="no-plan" style="display: <?= $plan === false ? 'flex' : 'none'?>; margin-top: <?= $plan === false ? '6rem' : '1rem'?>; gap: 2rem; justify-content:center; flex-direction:column;">
                <h1 style="text-align: center; font-size: calc(1.195rem + 1.2vw);"><?= $plan === false ? 'No Investment Plans Available!' : ''?></h1>
                <button style=" background: var(--accent-clr); margin: auto;" class="btn btn-primary show_create_plan" name="add_balance">Create Now </button>
            </div>

            <div class="card-grid">
                <?php foreach ($plans as $plan): ?>
                    <div class="card plan-card" id="plan-card-<?= htmlspecialchars($plan['plan_id']) ?>">
                        <div class="card-header">
                            <div>
                                <span>
                                    <?= htmlspecialchars($plan['plan_name']." "."plan") ?>
                                </span>

                                <div class="btn-group">
                                    <?php 
                                        if ($role === 'admin') {
                                            echo(<<<HTML
                                                <button type="button" class="plan-dropdown-btn dropdown-toggle" onclick="toggleDropdown(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                                        <path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"></path>
                                                    </svg>
                                                </button>
                                            HTML);
                                        }
                                    ?>
                                    <div class="action-dropdown-menu">
                                        <button class="dropdown-item edit_plan" id="show_edit_plan" name="edit_plan"  onclick="openEditPlan('edit-plan-modal-<?= htmlspecialchars($plan['plan_id']) ?>')">Edit Plan</button>
                                        <button class="dropdown-item delete_plan" id="show_delete_plan" name="delete_plan" onclick="openDeletePlan('delete_plan_<?= htmlspecialchars($plan['plan_id']) ?>')">Delete Plan</button>
                                    </div>
                                </div>
                            </div>
                            <h1><span><?= htmlspecialchars($plan['roi']) ?></span>%</h1>
                        </div>
                        <div class="card-content">
                            <div class="amount-group">
                                <p class="label">Minimum Amount:</p>
                                <p class="value">$<?= number_format($plan['minimum']) ?>.00</p>
                            </div>
                            <div class="amount-group">
                                <p class="label">Maximum Amount:</p>
                                <p class="value">$<?= number_format($plan['maximum']) ?>.00</p>
                            </div>
                            <div class="duration-group">
                                <p class="label">Duration:</p>
                                <p class="value"><?= htmlspecialchars($plan['duration_timeframe']) ?></p>
                            </div>

                            <div class="includes-group">
                                <h6>
                                    Includes:
                                </h6>

                                <ul style="font-weight: 500;">
                                    <li>Return on Investment: <span><?= htmlspecialchars($plan['roi']) ?></span>%</li>
                                    <li>Referal Commission: <?= htmlspecialchars($plan['commission']) ?>%</li>
                                    <li>Benefit: <?= htmlspecialchars($plan['benefit']) ?></li>
                                </ul>
                            </div>
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
                            <input type="hidden" name="plan_id" value="<?= htmlspecialchars($plan['plan_id']) ?>">
                            <input type="hidden" name="plan_name" value="<?= htmlspecialchars($plan['plan_name']) ?>">
                            <input type="hidden" name="plan_percentage" value="<?= htmlspecialchars($plan['percentage']) ?>">
                            <input type="hidden" name="plan_minimum" value="<?= htmlspecialchars($plan['minimum']) ?>">
                            <input type="hidden" name="plan_maximum" value="<?= htmlspecialchars($plan['maximum']) ?>">
                            <input type="hidden" name="plan_duration" value="<?= htmlspecialchars($plan['duration']) ?>">
                            <input type="hidden" name="plan_duration_timeframe" value="<?= htmlspecialchars($plan['duration_timeframe']) ?>">
                            <input type="hidden" name="plan_roi" value="<?= htmlspecialchars($plan['roi']) ?>">
                            <input type="hidden" name="plan_commission" value="<?= htmlspecialchars($plan['commission']) ?>">
                            <input type="hidden" name="plan_benefit" value="<?= htmlspecialchars($plan['benefit']) ?>">

                            <div class="invest-section">
                                <label for="platinum-amount">Amount to invest</label>
                                <div class="input-wrapper">
                                    <span class="currency">$</span>
                                    <input type="number" id="platinum-amount-<?= htmlspecialchars($plan['plan_id']) ?>" placeholder="0">
                                </div>
                                <button id="invest-btn-<?= htmlspecialchars($plan['plan_id']) ?>" class="invest-btn" data-plan-id="<?= htmlspecialchars($plan['plan_id']) ?>">Invest</button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- action modals for the cards - here -->
            <?php foreach ($plans as $plan): ?>
                <div class="side-modal edit-plan-modal" id="edit-plan-modal-<?= htmlspecialchars($plan['plan_id']) ?>">
                    <div class="side-modal-overlay">
                        <div class="side-modal-dialog">
                            <div class="side-modal-content">
                                <div class="side-modal-header">
                                    <div class="side-modal-title">
                                        <h5>Edit <?= htmlspecialchars($plan['plan_name']) ?> plan</h5>
                                    </div>

                                    <div class="close-side-modal-btn close-side-modal">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="side-modal-body">
                                    <div class="side-modal-body-wrapper">

                                        <label for="plan_name">Plan name*</label>
                                        <input id="plan_name" value="<?= htmlspecialchars($plan['plan_name']) ?>" name="plan_name" type="text" placeholder="Enter Plan name" style="width: 100%;">
                                        
                                        <label for="percentage">Percentage*</label>
                                        <input id="percentage" value="<?= htmlspecialchars($plan['roi']) ?>" name="percentage" type="text" placeholder="Enter Percentage" style="width: 100%;">
                                        
                                        <label for="minimum">Minimum Amount*</label>
                                        <div class="input-wrapper">
                                            <span class="currency"></span>
                                            <input  type="number" value="<?= htmlspecialchars($plan['minimum']) ?>" name="minimum" id="minimum" placeholder="0.00">
                                        </div>

                                        <label for="maximum">Maximum Amount*</label>
                                        <div class="input-wrapper">
                                            <span class="currency"></span>
                                            <input  type="number" value="<?= htmlspecialchars($plan['maximum']) ?>" name="maximum" id="maximum" placeholder="0.00">
                                        </div>

                                        <label for="duration">Duration</label>
                                        <select class="duration" id="duration" name="duration" style="width: 100%;" required="">
                                            <option value="">Choose</option>
                                            <option value="5" <?= $plan['duration'] === "5" ? 'selected' : '' ?>>Every Five Minutes</option>
                                            <option value="10" <?= $plan['duration'] === "10" ? 'selected' : '' ?>>Every Ten Minutes</option>
                                            <option value="30" <?= $plan['duration'] === "30" ? 'selected' : '' ?>>Every Thirty Minutes</option>
                                            <option value="60" <?= $plan['duration'] === "60" ? 'selected' : '' ?>>Hourly</option>
                                            <option value="360" <?= $plan['duration'] === "360" ? 'selected' : '' ?>>Every Six Hours</option>
                                            <option value="720" <?= $plan['duration'] === "720" ? 'selected' : '' ?>>Twice Daily</option>
                                            <option value="1440" <?= $plan['duration'] === "1440" ? 'selected' : '' ?>>Daily</option>
                                            <option value="2880" <?= $plan['duration'] === "2880" ? 'selected' : '' ?>>3 Days</option>
                                            <option value="4320" <?= $plan['duration'] === "4320" ? 'selected' : '' ?>>4 Days</option>
                                            <option value="7200" <?= $plan['duration'] === "7200" ? 'selected' : '' ?>>5 Days</option>
                                            <option value="11520" <?= $plan['duration'] === "11520" ? 'selected' : '' ?>>8 Days</option>
                                            <option value="2880" <?= $plan['duration'] === "2880" ? 'selected' : '' ?>>2 Days</option>
                                            <option value="10080" <?= $plan['duration'] === "10080" ? 'selected' : '' ?>>Two Weeks</option>
                                            <option value="20160" <?= $plan['duration'] === "20160" ? 'selected' : '' ?>>7 Days</option>
                                            <option style="color: var(--negative-text-clr);" value="43200" <?= $plan['duration'] === "43200" ? 'selected' : '' ?>>Monthly</option>
                                            <option style="color: var(--negative-text-clr);" value="129600" <?= $plan['duration'] === "129600" ? 'selected' : '' ?>>Three Months</option>
                                            <option style="color: var(--negative-text-clr);" value="259200" <?= $plan['duration'] === "259200" ? 'selected' : '' ?>>Six Months</option>
                                        </select>



                                        <label for="duration_timeframe">Duration Timeframe*</label>
                                        <input disabled readonly class="duration_timeframe" id="duration_timeframe" name="duration_timeframe" value="<?= htmlspecialchars($plan['duration_timeframe']) ?>" type="text" placeholder="Enter Duration Timeframe" style="width: 100%;" required>

                                        <label for="roi">ROI*</label>
                                        <input id="roi" name="roi" type="text" value="<?= htmlspecialchars($plan['roi']) ?>" placeholder="Enter ROI" style="width: 100%;">
                                        
                                        <label for="commission">Commission*</label>
                                        <div class="input-wrapper">
                                            <span class="currency"></span>
                                            <input  type="number" name="commission" value="<?= htmlspecialchars($plan['commission']) ?>" id="commission" placeholder="0.00">
                                        </div>

                                        <label for="benefit">Benefit*</label>
                                        <input id="benefit" name="benefit" value="<?= htmlspecialchars($plan['benefit']) ?>" type="text" placeholder="Enter Benefit" style="width: 100%;">
                                        

                                    </div>
                                </div>
                                <div class="side-modal-footer">
                                    <div class="side-modal-footer-wrapper">
                                        <button class="btn btn-danger close-side-modal">Close</button>
                                        <button class="btn btn-primary edit-plan-btn" data-plan-id="<?= htmlspecialchars($plan['plan_id']) ?>">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function openEditPlan(sectionId) {
                        const $section = $(`#${sectionId}`);
                        const $sideModalOverlay = $section.find('.side-modal-overlay');

                        if ($section.length === 0) return;

                        $section.css({
                            visibility: 'visible',
                        });

                        $(".side-modal-dialog").css({
                            transform: "translateX(0)",
                        });
                    };

                    $('.close-side-modal').on('click', function () {
                        $('.side-modal').each(function () {
                            $(this).css('visibility', 'hidden');
                        });

                        $(".side-modal-dialog").each(function () {
                            $(this).css('transform', 'translateX(-100%)');
                        });
                    });

                    $('.edit-plan-btn').off('click').on('click', function() {
                            const planId = $(this).data('plan-id');
                            const editPlanModal = $('#edit-plan-modal-'+planId);

                            const plan_name = editPlanModal.find('input[name="plan_name"]').val().trim();
                            const percentage = editPlanModal.find('input[name="percentage"]').val().trim();
                            const minimum = editPlanModal.find('input[name="minimum"]').val().trim();
                            const maximum = editPlanModal.find('input[name="maximum"]').val().trim();
                            const duration = editPlanModal.find('select[name="duration"]').val();
                            const duration_timeframe = editPlanModal.find('input[name="duration_timeframe"]').val();
                            const roi = editPlanModal.find('input[name="roi"]').val().trim();
                            const commission = editPlanModal.find('input[name="commission"]').val().trim();
                            const benefit = editPlanModal.find('input[name="benefit"]').val().trim();

                            const loader = `<div style="width:100%; height: 100%; margin: auto;"><svg xmlns="http://www.w3.org/2000/svg" stroke="#fff" width="20px" viewBox="0 0 24 24"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"></animate><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"></animate></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"></animateTransform></g></svg></div>`;
                            const editPlanBtn = $('.edit-plan-btn');
                            
                            if (!plan_name || !percentage || !minimum || !maximum || !duration || !duration_timeframe || !roi || !commission || !benefit) {
                                showToast('error', 'Fill All fields');
                            }
                            else{   
                                $.ajax({
                                    url: '../action/edit_plan_logic',
                                    type: 'POST',
                                    data: {
                                        planId,
                                        plan_name,
                                        percentage,
                                        minimum,
                                        maximum,
                                        duration,
                                        duration_timeframe,
                                        roi,
                                        commission,
                                        benefit,
                                    },
                                    success: function(response) {
                                        try {
                                            const data = JSON.parse(response);
                                            if (data.status === 'success') {
                                                showToast('success', data.message);
                                                editPlanBtn.html= loader;
                                                editPlanBtn.disabled = true;
                                                
                                                setTimeout(() =>{
                                                    location.reload();
                                                },3000);
                                            } else {
                                                showToast('error', data.message);
                                            }
                                        } catch (error) {
                                            console.error('Backend says:', response);
                                            showToast('error', 'An unexpected error occurred.');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                        showToast('error', 'An unexpected error occurred. Please try again later.');
                                    }
                                });
                            }

                            
                        });

                        
                </script>

                <div class="action-modal overlay delete_plan_section" id="delete_plan_<?= htmlspecialchars($plan['plan_id']) ?>" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="action-modal-content">
                        <div class="action-modal-header">
                            <h5 class="action-modal-title" id="modalTitle">Delete Plan</h5>
                            <button class="action-modal-close close_action" aria-label="Close">&times;</button>
                        </div>
                        <div class="action-modal-body">
                            <span style="margin-block: 10px; display: flex; align-items:center; gap:12px; color: var(--negative-text-clr); background:var(--negative-bg-clr);border: 1px solid var(--negative-text-clr); padding: 10px; display: flex; align-items:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width='3rem' fill="var(--negative-text-clr)" viewBox="64 64 896 896" focusable="false"><path d="M464 720a48 48 0 1096 0 48 48 0 10-96 0zm16-304v184c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V416c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8zm475.7 440l-416-720c-6.2-10.7-16.9-16-27.7-16s-21.6 5.3-27.7 16l-416 720C56 877.4 71.4 904 96 904h832c24.6 0 40-26.6 27.7-48zm-783.5-27.9L512 239.9l339.8 588.2H172.2z"/></svg>
                                <samp>You can delete this plan, if you no longer need it.</samp>
                            </span>
                            <p style="display: block;">Plan Name:
                                <br>
                                <div style="margin-block: 10px;"></div>
                                <strong style="color: var(--text-clr);">
                                    <?= htmlspecialchars($plan['plan_name']) ?> 
                                </strong> 
                                
                            </p>
                        </div>
                        <div class="action-modal-footer">
                            <button class="btn btn-secondary close_action" id="closeModal">Close</button>
                            <button 
                                style="background: var(--negative-text-clr);" 
                                class="btn btn-primary delete-plan-btn" 
                                name="delete_plan" 
                                id="delete_plan" 
                                data-plan-id="<?= htmlspecialchars($plan['plan_id']) ?>">
                                Delete
                            </button>
                        </div>
                    </div>

                    <script>
                        function openDeletePlan(sectionId) {
                            const $section = $(`#${sectionId}`);
                            if ($section.length === 0) return;

                            $('.delete_plan_section').css({
                                visibility: 'hidden',
                                opacity: '0'
                            });

                            $(".action-modal-content").css({
                                animation: "bounce-in 0.7s ease-out forwards"
                            });

                            $section.css({
                                visibility: 'visible',
                                opacity: '1'
                            });
                        };

                        $('.delete-plan-btn').each(function() {
                            $(this).on('click', function() {
                                const planId = $(this).data('plan-id'); 

                                $.ajax({
                                    url: '/chain-fortune/action/delete_plan_logic',
                                    type: 'POST',
                                    data: { delete_plan: true, plan_id: planId },

                                    success: function(response) {
                                        try {
                                            const data = JSON.parse(response);
                                            if (data.status === 'success') {
                                                showToast('success', data.message);

                                                setTimeout(() =>{
                                                    const planCard = $("#plan-card-"+planId);
                                                    if (planCard.length) {
                                                        planCard.remove();
                                                    }
                                                    $('.delete_plan_section').css({
                                                        visibility: 'hidden',
                                                        opacity: '0'
                                                    });
                                                    $(".action-modal-content").css({
                                                        animation: "bounce-in 0.7s ease-out forwards"
                                                    });
                                                },2000);

                                                if (data.last_plan === true) {
                                                    setTimeout(() =>{
                                                        $('.no-plan').css({
                                                            display: 'flex',
                                                            marginTop: '6rem'
                                                        });
                                                        $('.no-plan h1').text("No Investment Plans Available!");
                                                    },2000);
                                                }
                                            } else {
                                                showToast('error', data.message);
                                            }
                                        } catch (error) {
                                            console.error('Invalid JSON response:', response);
                                            showToast('error', 'An unexpected error occurred.');

                                        }
                                    },
                                    error: function() { 
                                        showToast('error', 'Error deleting Plan. Please try again.');
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            <?php endforeach; ?>



            
        </div>
    </main>



    


    <!-- modal styling included here -->
    <?php include "../components/modal_style.php"; ?>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    <style>
        .side-modal{
            overflow-x: hidden;
            overflow-y: auto;
            position: fixed;
            visibility: hidden;
            top: 0;
            left: 0;
            z-index: 980000;
            /* display: none; */
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;


            .side-modal-overlay{
                height: 100%;
                width:100%;
                background-color: #11121ac4; 
                /* backdrop-filter: blur(8px);  */
            }

            .side-modal-dialog{
                top: 0;
                left: 0;
                background: red;
                bottom: 0;
                width: 360px;
                max-width: 100%;
                margin: 0;
                transform: translateX(-100%);
                -webkit-transition: all 1s cubic-bezier(0.19, 0.8, 0.22, 1);
                transition: all 0.8s cubic-bezier(0.19, 0.8, 0.22, 1);
                height: 100%;

                .side-modal-content{
                    height: 100%;
                    background: var(--hover-clr);
                    width: 100%;
                    overflow-y: scroll;

                    &::-webkit-scrollbar {
                        width: 6px;
                    }

                    &::-webkit-scrollbar-track {
                        background: var(--black-clr);
                        border-radius: 4px;
                    }

                    &::-webkit-scrollbar-thumb {
                        background: var(--line-clr);
                        border-radius: 4px;
                    }

                    &::-webkit-scrollbar-thumb:hover {
                        background: var(--accent-clr);
                    }



                    .side-modal-header{
                        display: flex;
                        flex-shrink: 0;
                        align-items: center;
                        justify-content: space-between;
                        padding: 1rem 1rem;
                        border-bottom: 1px solid var(--line-clr);
                        border-top-left-radius: calc(0.3rem - 1px);
                        border-top-right-radius: calc(0.3rem - 1px);

                        .side-modal-title{
                            font-size: 1.3rem;
                        }
                    }

                    .side-modal-body{
                        position: relative;
                        flex: 1 1 auto;
                        padding: 1rem;

                        .side-modal-body-wrapper{
                            height: 100%;
                            strong {
                                color: var(--text-clr);
                            }
                            input[type=number] {
                                -moz-appearance: textfield;
                            }
                            input,
                            select,
                            textarea{
                                background-color: var(--base-clr);
                                border: 1px solid var(--line-clr);
                                padding: 0.75rem 1rem;
                                border-radius: 8px;
                                color: var(--text-clr);
                                font-size: 1rem;
                                transition: all 0.3s ease;
                                width: 100%;
                                margin-bottom: 10px;
                                margin-top: 5px;
                            }
                            textarea{
                                max-width: 100%;
                                min-width: 100%;
                                max-height: 200px;
                                min-height: 200px;
                            }
                            label{
                                font-size: 13px;
                                margin-left: 3px;
                            }

                            input:focus,
                            select:focus,
                            textarea:focus{
                                outline: none;
                                border-color: var(--accent-clr);
                                box-shadow: 0 0 0 4px var(--input-focus-clr);
                            }

                        }
                    }

                    .side-modal-footer{
                        flex-wrap: wrap;
                        flex-shrink: 0;
                        border-top: 1px solid var(--line-clr);
                        border-bottom-right-radius: calc(0.3rem - 1px);
                        border-bottom-left-radius: calc(0.3rem - 1px);
                        padding: 0.75rem;

                        .side-modal-footer-wrapper{
                            padding: 0.75rem;
                            display: flex;
                            justify-content: space-between;
                            width: 100%;

                            @media screen and (max-width: 324px) {
                                flex-direction: column;
                                gap: 13px;
                            }

                        }
                    }
                }
            }

            .side-modal-dialog.show{
                -webkit-transform: translate(0) !important;
                transform: translate(0) !important;
            }
        }

        .side-modal.show{
            display: block;
        }
    </style>

 


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <!-- <script src="/chain-fortune/js/toggle_action_dropdown.js"></script> -->
    <script src="/chain-fortune/js/show_action_modal.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script>
        const PlanCardDropdownBtn = document.querySelectorAll('.plan-dropdown-btn');
        PlanCardDropdownBtn.forEach((btn) => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('clicked');
            });

            $(document).on('click', (event) => {
                const $target = $(event.target);
                const isDropdownButton = $target.closest('.dropdown-toggle').length > 0;
                const isDropdownMenu = $target.closest('.action-dropdown-menu').length > 0;

                if (!isDropdownButton && !isDropdownMenu) {
                    $('.plan-dropdown-btn.clicked').removeClass('clicked');
                    $('.action-dropdown-menu.show').removeClass('show');
                }
            });
        });

        const toggleDropdown = (button) => {
            const $dropdown = $(button).next('.action-dropdown-menu');
            $('.action-dropdown-menu.show').not($dropdown).removeClass('show');
            $dropdown.toggleClass('show');
        };
  
    </script>
    <script>
        document.querySelectorAll('.duration').forEach(function(selectElement, index) {
            selectElement.addEventListener('change', function () {
                const selectedText = this.options[this.selectedIndex].text;
                const correspondingInput = document.querySelectorAll('.duration_timeframe')[index];
                if (correspondingInput) {
                    correspondingInput.value = selectedText;
                }
            });
        });
    </script>
    <script>
        $(function() {
            const $cryptoGrid = $('#cryptoGrid');
            const $selectedCrypto = $('#selectedCrypto');
            const $walletAddressInput = $('#wallet-address');
            const $cryptoSymbol = $('#crypto-symbol');
            const $qrCodeInput = $('#qr_code');
            let $selectedCard = null;
            let isAnimating = false;

            function fetchCryptocurrencies() {
                $.ajax({
                    url: '/chain-fortune/action/get_user_cryptos',
                    method: 'GET',
                    dataType: 'json',
                    success: function(cryptocurrencies) {
                        if (cryptocurrencies.error) {
                            console.error(cryptocurrencies.error);
                            return;
                        }
                        initializeCryptoGrid(cryptocurrencies);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to load cryptocurrencies:', textStatus, errorThrown);
                    }
                });
            }

            function initializeCryptoGrid(cryptocurrencies) {
                $cryptoGrid.empty(); 
                $.each(cryptocurrencies, function(_, crypto) {
                    const $card = createCryptoCard(crypto);
                    $cryptoGrid.append($card);
                });
            }

            function createCryptoCard(crypto) {
                const $card = $(`
                    <div class="crypto-card" data-id="${crypto.id}">
                        <div class="crypto-icon">
                            <img src="${crypto.iconUrl}" alt="${crypto.name} icon">
                        </div>
                        <div class="crypto-symbol">${crypto.symbol}</div>
                        <div class="crypto-name">${crypto.name}</div>
                    </div>
                `);

                $card.on('click', function() {
                    if (isAnimating) return;
                    selectCryptoCard($card, crypto);
                });

                return $card;
            }

            function selectCryptoCard($card, crypto) {
                isAnimating = true;

                if ($selectedCard) {
                    $selectedCard.removeClass('selected');
                }

                $selectedCard = $card;
                $card.addClass('selected');

                const cardRect = $card[0].getBoundingClientRect();
                const selectedRect = $selectedCrypto[0].getBoundingClientRect();

                const $clone = $card.clone();
                $clone.css({
                    width: cardRect.width + 'px',
                    height: cardRect.height + 'px',
                    position: 'fixed',
                    left: cardRect.left + 'px',
                    top: cardRect.top + 'px',
                    margin: 0,
                    zIndex: 9999,
                    transition: 'transform 0.6s ease, opacity 0.6s ease',
                }).addClass('clone-card');

                $('body').append($clone);

                setTimeout(() => {
                    const targetX = selectedRect.left + (selectedRect.width / 2) - (cardRect.width / 2);
                    const targetY = selectedRect.top + (selectedRect.height / 2) - (cardRect.height / 2);
                    const scaleX = 2;
                    const scaleY = 2;

                    $clone.css({
                        transform: `translate(${targetX - cardRect.left}px, ${targetY - cardRect.top}px) scale(${scaleX}, ${scaleY})`,
                        opacity: 0
                    });

                    updateSelectedView(crypto);

                    // $walletAddressInput.val(crypto.wallet_address || '');
                    $qrCodeInput.val(crypto.qr_code || '');
                    $cryptoSymbol.val(crypto.symbol || '');

                    setTimeout(() => {
                        $clone.remove();
                        isAnimating = false;
                    }, 600);
                }, 50);
            }

            function updateSelectedView(crypto) {
                $selectedCrypto.html(`
                    <div class="selected-content animate-flyout">
                        <div class="selected-icon">
                            <img src="${crypto.iconUrl}" alt="${crypto.name} icon">
                        </div>
                        <div class="selected-symbol">${crypto.symbol}</div>
                        <div class="selected-name">${crypto.name}</div>
                        <!-- <div class="selected-price">${crypto.price}</div> -->
                    </div>
                `);
            }
            fetchCryptocurrencies();

            $('#withdraw-btn').on('click', function() {
                const userId = $('#user_id').val();
                const amount = $('#deposit-amount').val();
                const walletAddress = $walletAddressInput.val();
                const qrCode = $('#qr_code').val();
                const cryptoSymbol = $cryptoSymbol.val();

                if (!amount || amount <= 0) {
                    showToast('error','Please enter a deposit amount');
                    return;
                }
                if (!walletAddress) {
                    showToast('error','Please enter a wallet address');
                    return;
                }
                Swal.fire({
                    title: 'Please wait...',
                    text: 'Processing your request',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    background: 'var(--hover-clr)',
                    color: '#ffffff',
                    didOpen: () => {
                    Swal.showLoading();
                    }
                });
                setTimeout(() => {
                    $.ajax({
                        url: '/chain-fortune/action/validate_withdrawal',
                        method: 'POST',
                        data: {
                            user_id: userId,
                            amount: amount,
                            wallet_address: walletAddress,
                            qr_code: qrCode,
                            crypto_symbol: cryptoSymbol
                        },
                        dataType: 'json',
                        success: function(response) {
                            const data = response;
                            if (data.status === 'success') {
                                showToast('success', data.message);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#4caf50',
                                    allowOutsideClick: false,
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = response.redirect;
                                    }
                                });
                            } else {
                                showToast('error', data.message);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            showToast('error', 'Server error. Please try again.');
                        }
                    });
                }, 2000);
            }); 

            $('.invest-btn').off('click').on('click', function() {
                const planId = $(this).data('plan-id');
                const planCard = $('#plan-card-' + planId);
                const planName = planCard.find('input[name="plan_name"]').val();
                const amount = $('#platinum-amount-' + planId).val().trim();

                if(!planId || !planName) {
                    showToast('error', 'Invalid plan or user information');
                    return;
                }
                if(amount === '' || amount <= 0) {
                    showToast('error', 'Please enter a valid amount to invest');
                    return;
                }
                Swal.fire({
                    title: 'Please wait...',
                    text: 'Processing your request...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    background: 'var(--hover-clr)',
                    color: '#ffffff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                setTimeout(() => {
                    $.ajax({
                        url: '/chain-fortune/action/validate_investment',
                        method: 'POST',
                        data: {
                            plan_id: planId,
                            amount: amount,
                            plan_name: planName
                        },
                        dataType: 'json',
                        success: function(response) { 
                            const data = response;
                            if (data.status === 'success') {
                                showToast('success', data.message);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: data.message,
                                    allowEscapeKey: false,
                                    background: 'var(--hover-clr)',
                                    color: '#ffffff',
                                    confirmButtonColor: '#4caf50',
                                    allowOutsideClick: false,

                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = response.redirect;
                                    }
                                })
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 2000);
                            } else {
                                showToast('error', data.message);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message,
                                    background: 'var(--hover-clr)',
                                    allowEscapeKey: false,
                                    color: '#ffffff',
                                    confirmButtonColor: '#f44336',
                                    customClass: {
                                        popup: 'swal2-dark-popup'
                                    }
                                })
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            showToast('error', 'Server error. Please try again.');
                        }
                    });
                }, 2000);

                

         

                
            });
        });
    </script>

</body>
</html>


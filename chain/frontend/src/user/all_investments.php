<?php
    include("../../../backend/section_handler.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chain Fortune</title>
    <link rel="stylesheet" href="/chain-fortune/styles/style.css">
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
            padding: 20px;
        }
        @media (max-width: 800px) {
            #main{
                margin-left: 0;
            }
            .app-container {
                padding: 0.7rem;
            }
        }
        
        .investments-container {
            .header {
                text-align: center;
                margin-bottom: 40px;
            }

            .header h1 {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--text-clr);
                margin-bottom: 10px;
            }

            .header p {
                color: var(--secondary-text-clr);
                font-size: 1.1rem;
            }

            .action-bar{
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                gap: 20px;
                width: 100%;
            }  
            .search-box {
                position: relative;
                width: 300px;

            }
            
            .search-box input {
                background-color: var(--base-clr);
                border: 1px solid var(--line-clr);
                padding: 0.75rem 1rem;
                border-radius: 7px;
                color: var(--text-clr);
                font-size: 1rem;
                transition: all 0.3s ease;
                width: 100%;
                box-sizing: border-box;

            }

            .search-box input:focus {
                outline: none;
                border-color: var(--accent-clr);
                box-shadow: 0 0 0 4px var(--input-focus-clr);
            }

            .search-box svg {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--secondary-text-clr);
            }

            .loading {
                display: none;
                justify-content: center;
                align-items: center;
                height: 100px;
                background: var(--base-clr);
                width: 100%;
                margin-top: 10px;
            }

            .spinner {
                width: 3rem;
                height: 3rem;
                margin: auto;
                border: 3px solid var(--line-clr);
                border-top-color: var(--accent-clr);
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            .filter-section {
                width: 300px;
            }

            .filter-label {
                display: block;
                margin-bottom: 0.75rem;
                font-weight: 600;
                color: var(--text-clr);
                font-size: 0.95rem;
            }

            .custom-dropdown {
                position: relative;
                width: 100%;
                max-width: 300px;
            }

            .dropdown-button {
                width: 100%;
                padding: 0.75rem 1rem;
                background: var(--base-clr);
                border: 1px solid var(--line-clr);
                border-radius: 7px;
                color: var(--text-clr);
                font-size: 1rem;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .dropdown-button::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, transparent, var(--input-focus-clr));
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .dropdown-button:hover {
                border-color: var(--accent-clr);
                background: var(--hover-clr);
            }

            .dropdown-button:hover::before {
                opacity: 1;
            }

            .dropdown-arrow {
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 6px solid var(--secondary-text-clr);
                transition: transform 0.3s ease;
                z-index: 1;
            }

            .dropdown-button.active .dropdown-arrow {
                transform: rotate(180deg);
            }

            .dropdown-menu {
                position: absolute;
                top: calc(100% + 0.5rem);
                left: 0;
                right: 0;
                background: var(--base-clr);
                border: 1px solid var(--line-clr);
                border-radius: 12px;
                overflow: hidden;
                z-index: 1000;
                opacity: 0;
                transform: translateY(-10px);
                visibility: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            }

            .dropdown-menu.active {
                opacity: 1;
                transform: translateY(0);
                visibility: visible;
            }

            .dropdown-option {
                padding: 1rem 1.25rem;
                cursor: pointer;
                transition: all 0.2s ease;
                border-bottom: 1px solid var(--line-clr);
                position: relative;
                overflow: hidden;
            }

            .dropdown-option:last-child {
                border-bottom: none;
            }

            .dropdown-option::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, var(--accent-clr), transparent);
                opacity: 0.1;
                transition: left 0.5s ease;
            }

            .dropdown-option:hover {
                background: var(--hover-clr);
                color: var(--accent-clr);
            }

            .dropdown-option:hover::before {
                left: 100%;
            }

        }
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }



        .investments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 24px;
            width: 100%;
        }

        .investment-card {
            background: var(--black-clr);
            border: 1px solid var(--line-clr);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .investment-card:hover {
            border-color: var(--accent-clr);
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(94, 99, 255, 0.1);
        }

        .card-header {
            display: flex;
            /* justify-content: ; */
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .investment-ids {
            flex: 1;
            min-width: 200px;
        }

        .user-id {
            font-size: 0.85rem;
            color: var(--secondary-text-clr);
            margin-bottom: 4px;
        }

        .investment-id {
            font-size: 1rem;
            color: var(--text-clr);
            font-weight: 600;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-paused {
            background: var(--pending-bg-clr);
            color: var(--pending-text-clr);
        }

        .status-active {
            background: var(--positive-bg-clr);
            color: var(--positive-text-clr);
        }

        .status-completed {
            background: var(--info-clr);
            color: white;
        }

        .status-failed {
            background: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }
        .status-canceled {
            background: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }

        .plan-crypto {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 16px;
            background: var(--hover-clr);
            border-radius: 12px;
        }

        .plan-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-clr);
        }

        .crypto-symbol {
            background: var(--accent-clr);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .investment-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: var(--base-clr);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--line-clr);
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--secondary-text-clr);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-clr);
        }

        .amount {
            color: var(--accent-clr);
        }

        .profit-positive {
            color: var(--positive-text-clr);
        }

        .profit-negative {
            color: var(--negative-text-clr);
        }

        .change-positive {
            color: var(--positive-text-clr);
        }

        .change-negative {
            color: var(--negative-text-clr);
        }

        .dates-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-start {
            background: var(--positive-text-clr);
            color: white;
        }

        .btn-start:hover {
            background: #0d9668;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: transparent;
            color: var(--negative-text-clr);
            border: 1px solid var(--negative-text-clr);
        }
        .btn-pause {
            background: transparent;
            color: var(--pending-text-clr);
            border: 1px solid var(--pending-text-clr);
        }

        .btn-cancel:hover {
            background: var(--negative-bg-clr);
            transform: translateY(-1px);
        }

        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background-color: var(--black-clr);
            color: var(--text-clr);
            border: 1px solid var(--line-clr);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-btn:hover {
            background-color: var(--hover-clr);
        }

        .page-btn.active {
            background-color: var(--accent-clr);
            border-color: var(--accent-clr);
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .investments-container {
                .header h1 {
                    font-size: 2rem;
                }
                .action-bar{
                    flex-direction: column;
                    align-items: flex-start;
                }
                .search-box{
                    width: 100%;
                }
                .filter-section{
                    width: 100%;

                    .custom-dropdown {
                        max-width: 100%;
                    }
                }
            }

            

            .investments-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .investment-card {
                padding: 20px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .investment-ids {
                min-width: auto;
                width: 100%;
            }

            .plan-crypto {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .investment-details {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .dates-section {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .investments-container {
                .header h1 {
                    font-size: 1.75rem;
                }
            }

           

            .investment-card {
                padding: 16px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                padding: 14px 20px;
            }
        }

        @media (max-width: 320px) {
            .investments-container {
                .header h1 {
                    font-size: 1.5rem;
                }
            }
            .investment-card {
                padding: 12px;
            }

            .plan-crypto {
                padding: 12px;
            }

            .detail-item {
                padding: 8px;
            }
        }
    </style>
</head>


<body>
    
    <?php include "../components/header.php"; ?>
    <?php include "../components/sidebar.php"; ?>
    <?php include "../components/toastify.php"; ?>

    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweet_alert.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <div class="investments-container">
                <div class="header">
                    <h1>Investment Portfolio</h1>
                    <p>Track and manage your cryptocurrency investments</p>
                </div>

                <div class="action-bar">
                    <div class="search-box">
                        <input type="text" class="search-input" id="searchInput" placeholder="Search by plan name or crypto symbol">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    
                    <div class="filter-section">
                        <div class="custom-dropdown">
                            <div class="dropdown-button" id="dropdownButton">
                                <span id="selectedOption">All Investments</span>
                                <div class="dropdown-arrow"></div>
                            </div>
                            <div class="dropdown-menu" id="dropdownMenu">
                                <div class="dropdown-option" data-value="all">All Investments</div>
                                <div class="dropdown-option" data-value="completed">Completed Only</div>
                                <div class="dropdown-option" data-value="active">Active Only</div>
                                <div class="dropdown-option" data-value="pending">Pending Only</div>
                                <div class="dropdown-option" data-value="paused">Paused Only</div>
                                <div class="dropdown-option" data-value="canceled">Canceled Only</div>
                                <div class="dropdown-option" data-value="failed">Failed Only</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                </div>
                
                <div class="investments-grid" id="investmentsGrid">
                    <?php
                        include("../../../backend/connection.php");

                        if (!isset($_SESSION['user_id'])) {
                            echo "<p class='empty-state'>User not logged in.</p>";
                            exit;
                        }

                        $user_id = $_SESSION['user_id'];

                        $sql_investment = "
                            SELECT * FROM investments 
                            WHERE user_id = ? 
                            ORDER BY started_at DESC
                        ";

                        $stmt = $conn->prepare($sql_investment);
                        $stmt->bind_param("s", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0) {
                            while ($investment = $result->fetch_assoc()) {
                                $amountInvested = number_format($investment['amount_invested'], 2);
                                $totalProfit = number_format($investment['total_profit'], 2);
                                $roi = $investment['roi'] . '%';
                                $changeValue = $investment['change_value'];
                                $changeClass = ($changeValue >= 0) ? 'change-positive' : 'change-negative';
                                $changeValueFormatted = ($changeValue >= 0 ? '+' : '') . number_format($changeValue, 2) . '%';
                                $statusClass = 'status-' . strtolower($investment['status']);
                                $startedAt = date('M j, Y', strtotime($investment['started_at']));
                                $completedAt = $investment['completed_at'] ? date('M j, Y', strtotime($investment['completed_at'])) : '—';

                                $investmentIdDisplay = htmlspecialchars($investment['investment_id']);
                                $planName = htmlspecialchars($investment['plan_name']);
                                $cryptoSymbol = htmlspecialchars($investment['crypto_symbol']);

                                $changeValueDiv = (strtolower($investment['status']) === 'active') ?
                                    "<div class='detail-value {$changeClass}' data-investment-id='{$investmentIdDisplay}'></div>" :
                                    "<div class='detail-value {$changeClass}'>{$changeValueFormatted}</div>";

                                echo <<<HTML
                                    <div class="investment-card" 
                                         data-investment-id="{$investmentIdDisplay}" 
                                         data-status="{$investment['status']}"
                                         data-plan-name="{$planName}"
                                         data-crypto-symbol="{$cryptoSymbol}"
                                         data-amount="{$investment['amount_invested']}"
                                         data-profit="{$investment['total_profit']}"
                                         data-roi="{$investment['roi']}">
                                        <div class="card-header">
                                            <div class="status-badge {$statusClass}">{$investment['status']}</div>
                                        </div>

                                        <div class="plan-crypto">
                                            <div class="plan-name">{$planName} Plan</div>
                                            <div class="crypto-symbol">{$cryptoSymbol}</div>
                                        </div>

                                        <div class="investment-details">
                                            <div class="detail-item">
                                                <div class="detail-label">Amount Invested</div>
                                                <div class="detail-value amount">\${$amountInvested}</div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-label">Total Profit</div>
                                                <div class="detail-value profit-positive">\${$totalProfit}</div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-label">ROI</div>
                                                <div class="detail-value profit-positive">{$roi}</div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-label">Live Profit</div>
                                                {$changeValueDiv}
                                            </div>
                                        </div>

                                        <div class="dates-section">
                                            <div class="detail-item">
                                                <div class="detail-label">Start Date</div>
                                                <div class="detail-value">{$startedAt}</div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-label">End Date</div>
                                                <div class="detail-value">{$completedAt}</div>
                                            </div>
                                        </div>
                                    </div>
                                HTML;
                            }
                        } else {
                        }
                    ?>
                </div>
                
                <div class="results-info" id="resultsInfo" style="text-align: center; margin: 20px 0; color: #666;"></div>
                <div class="pagination" id="pagination"></div>
            </div>
        </div>
    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>

        // Dropdown functionality
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const selectedOption = document.getElementById('selectedOption');
        const dropdownOptions = document.querySelectorAll('.dropdown-option');
        
        dropdownButton.addEventListener('click', function() {
            dropdownButton.classList.toggle('active');
            dropdownMenu.classList.toggle('active');
        });
        
        document.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownButton.classList.remove('active');
                dropdownMenu.classList.remove('active');
            }
        });

        // Live change values fetching
        function fetchLiveChangeValues() {
            $('.detail-value[data-investment-id]').each(function () {
                const $changeDiv = $(this);
                const investmentId = $changeDiv.data('investment-id');

                $.ajax({
                    url: '/chain-fortune/action/fetch_live_change_value',
                    method: 'POST',
                    data: { investment_id: investmentId },
                    success: function (response) {
                        if (response.status === 'success') {
                            $changeDiv.text(response.data.change_value);
                            if (parseFloat(response.data.change_value) >= 0) {
                                $changeDiv.removeClass('change-negative').addClass('change-positive');
                            } else {
                                $changeDiv.removeClass('change-positive').addClass('change-negative');
                            }
                        } else {
                            $changeDiv.text('');
                        }
                    },
                    error: function () {
                        console.error('Failed to fetch change value for investment:', investmentId);
                    }
                });
            });
            setTimeout(fetchLiveChangeValues, 2000); 
        }

        $(document).ready(function() {
            // Global variables
            let allInvestmentCards = [];
            let filteredInvestmentCards = [];
            let currentPage = 1;
            let currentStatusFilter = 'all';
            let currentSearchTerm = '';
            const itemsPerPage = 6;
            const $loading = $('#loading');

            // Initialize cards array
            function initializeCards() {
                allInvestmentCards = $('.investment-card').toArray();
                filteredInvestmentCards = [...allInvestmentCards];
            }

            // Enhanced search functionality
            $("#searchInput").on("keyup", function() {
                currentSearchTerm = $(this).val().toLowerCase().trim();
                applyFilters();
            });

            // Apply both search and status filters
            function applyFilters() {
                // First filter by status
                let statusFiltered = [];
                if (currentStatusFilter === 'all') {
                    statusFiltered = [...allInvestmentCards];
                } else {
                    statusFiltered = allInvestmentCards.filter(card => 
                        $(card).data('status').toLowerCase() === currentStatusFilter.toLowerCase()
                    );
                }
                
                // Then filter by search term
                if (currentSearchTerm === '') {
                    filteredInvestmentCards = [...statusFiltered];
                } else {
                    filteredInvestmentCards = statusFiltered.filter(card => {
                        const $card = $(card);
                        const investmentId = $card.data('investment-id').toString().toLowerCase();
                        const planName = $card.data('plan-name').toString().toLowerCase();
                        const cryptoSymbol = $card.data('crypto-symbol').toString().toLowerCase();
                        const status = $card.data('status').toString().toLowerCase();
                        const amount = $card.data('amount').toString();
                        const profit = $card.data('profit').toString();
                        const roi = $card.data('roi').toString();
                        
                        return investmentId.includes(currentSearchTerm) || 
                               planName.includes(currentSearchTerm) ||
                               cryptoSymbol.includes(currentSearchTerm) ||
                               status.includes(currentSearchTerm) ||
                               amount.includes(currentSearchTerm) ||
                               profit.includes(currentSearchTerm) ||
                               roi.includes(currentSearchTerm);
                    });
                }
                
                currentPage = 1; // Reset to first page
                displayCards();
                
                // Show loading and toast if no results found
                if (filteredInvestmentCards.length === 0 && (currentSearchTerm !== '' || currentStatusFilter !== 'all')) {
                    $loading.show();
                    showToast('error', 'No investments found matching your criteria');
                    setTimeout(() => $loading.hide(), 1000);
                } else {
                    $loading.hide();
                }
            }

            // Display cards for current page
            function displayCards() {
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const cardsToShow = filteredInvestmentCards.slice(startIndex, endIndex);

                // Hide all cards first
                $('.investment-card').hide();

                // Show only the cards for current page
                cardsToShow.forEach(card => {
                    $(card).show();
                });

                // Update results info
                updateResultsInfo();

                // Update pagination
                updatePagination();

                // Handle empty state
                if (filteredInvestmentCards.length === 0) {
                    if ($('.empty-state').length === 0) {
                        // $('.investments-grid').append("<p class='empty-state'>No investments found.</p>");
                    }
                    $('.empty-state').show();
                    $('#pagination').hide();
                } else {
                    $('.empty-state').hide();
                    $('#pagination').show();
                }
            }

            // Update results information
            function updateResultsInfo() {
                const totalCards = filteredInvestmentCards.length;
                
                if (totalCards === 0) {
                    $('#resultsInfo').text('No investments found');
                    return;
                }
                
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, totalCards);
                
                $('#resultsInfo').text(`Showing ${startIndex}-${endIndex} of ${totalCards} investments`);
            }

            // Enhanced pagination
            function updatePagination() {
                const totalPages = Math.ceil(filteredInvestmentCards.length / itemsPerPage);
                const $pagination = $("#pagination");
                $pagination.empty();

                if (totalPages <= 1) return;

                // Previous button
                const prevBtn = $(`<button class="page-btn prev-next" ${currentPage === 1 ? 'disabled' : ''}>«</button>`);
                prevBtn.on('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        displayCards();
                    }
                });
                $pagination.append(prevBtn);

                // Page numbers with smart display
                const startPage = Math.max(1, currentPage - 2);
                const endPage = Math.min(totalPages, currentPage + 2);

                // First page if not in range
                if (startPage > 1) {
                    const firstBtn = $('<button class="page-btn">1</button>');
                    firstBtn.on('click', function() {
                        currentPage = 1;
                        displayCards();
                    });
                    $pagination.append(firstBtn);

                    if (startPage > 2) {
                        $pagination.append('<span style="padding: 12px;">...</span>');
                    }
                }

                // Page range
                for (let i = startPage; i <= endPage; i++) {
                    const pageBtn = $(`<button class="page-btn ${i === currentPage ? 'active' : ''}">${i}</button>`);
                    pageBtn.on('click', function() {
                        currentPage = parseInt($(this).text());
                        displayCards();
                    });
                    $pagination.append(pageBtn);
                }

                // Last page if not in range
                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        $pagination.append('<span style="padding: 12px;">...</span>');
                    }

                    const lastBtn = $(`<button class="page-btn">${totalPages}</button>`);
                    lastBtn.on('click', function() {
                        currentPage = totalPages;
                        displayCards();
                    });
                    $pagination.append(lastBtn);
                }

                // Next button
                const nextBtn = $(`<button class="page-btn prev-next" ${currentPage === totalPages ? 'disabled' : ''}>»</button>`);
                nextBtn.on('click', function() {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayCards();
                    }
                });
                $pagination.append(nextBtn);
            }

            // Update statistics for user dashboard
            function updateStats(filter) {
                const cards = $('.investment-card');
                let total = cards.length;
                let completed = cards.filter(function() { return $(this).data('status').toLowerCase() === 'completed'; }).length;
                let pending = cards.filter(function() { return $(this).data('status').toLowerCase() === 'pending'; }).length;
                let paused = cards.filter(function() { return $(this).data('status').toLowerCase() === 'paused'; }).length;
                let active = cards.filter(function() { return $(this).data('status').toLowerCase() === 'active'; }).length;
                let canceled = cards.filter(function() { return $(this).data('status').toLowerCase() === 'canceled'; }).length;
                let failed = cards.filter(function() { return $(this).data('status').toLowerCase() === 'failed'; }).length;
                
                // Calculate total investment amount and profit
                let totalInvestment = 0;
                let totalProfit = 0;
                
                cards.each(function() {
                    const $card = $(this);
                    totalInvestment += parseFloat($card.data('amount')) || 0;
                    totalProfit += parseFloat($card.data('profit')) || 0;
                });
                
                // You can update your UI stats here if needed
                console.log(`Portfolio Stats - Total: ${total}, Active: ${active}, Completed: ${completed}, Pending: ${pending}`);
                console.log(`Financial Stats - Total Investment: $${totalInvestment.toFixed(2)}, Total Profit: $${totalProfit.toFixed(2)}`);
            }

            // Handle dropdown option selection
            dropdownOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;
                    
                    selectedOption.textContent = text;
                    dropdownButton.classList.remove('active');
                    dropdownMenu.classList.remove('active');
                    
                    currentStatusFilter = value;
                    applyFilters();
                    updateStats(value);
                });
            });

            // Initialize the system
            initializeCards();
            displayCards();
            fetchLiveChangeValues();
            updateStats('all');
        });
    </script>
  




</body>
</html>



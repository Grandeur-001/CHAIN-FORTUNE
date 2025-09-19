<?php
    include("../../../backend/section_handler.php");
    include("../../../backend/check_role.php");
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

        .ip-container {
            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                flex-wrap: wrap;
                gap: 1rem;
            }

            h1 {
                font-size: 1.8rem;
                font-weight: 700;
            }
        }



        .block-form {
            width: 100%;
            background-color: var(--black-clr);
            border-radius: 7px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--line-clr);
            box-shadow: var(--card-shadow);
        }

        .block-form-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-clr);
        }

        .form-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--secondary-text-clr);
        }

        .form-input {
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

        .form-input:focus {
            outline: none;
            border-color: var(--accent-clr);
            background-color: var(--input-focus-clr);
        }

        .form-select {
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            padding: 0.75rem 1rem;
            border-radius: 7px;
            color: var(--text-clr);
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23b0b3c1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--accent-clr);
            background-color: var(--input-focus-clr);
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            color: var(--text-clr);
            font-size: 0.9rem;
            transition: var(--transition);
            resize: vertical;
            min-height: 80px;
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--accent-clr);
            background-color: var(--input-focus-clr);
        }

        .form-submit {
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
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

    
        .stats {
            display: flex;
            gap: clamp(1rem, 3vw, 2rem);
            margin-bottom: clamp(2rem, 4vw, 3rem);
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat-card {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 7px;
            padding: clamp(1rem, 3vw, 1.5rem);
            text-align: center;
            flex: 1;
            min-width: clamp(120px, 25vw, 180px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-clr);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--accent-clr);
            transform: translateY(-2px);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-title {
            color: var(--secondary-text-clr);
            font-size: clamp(0.8rem, 2.5vw, 0.9rem);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 700;
            color: var(--accent-clr);
            margin-bottom: 0.25rem;
        }

        .ip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .loading {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100px;
            background: var(--base-clr);
            width: 100%;
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

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .ip-card {
            background-color: var(--black-clr);
            border-radius: 7px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;;
            border: 1px solid var(--line-clr);
        }

        .ip-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            border-color: var(--accent-clr);
        }

        .ip-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--line-clr);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ip-address {
            font-size: 1.1rem;
            font-weight: 600;
            font-family: monospace;
        }

        .ip-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .permanent {
            background-color: var(--negative-bg-clr);
            color: var(--negative-text-clr);
        }

        .temporary {
            background-color: var(--pending-bg-clr);
            color: var(--pending-text-clr);
        }

        .ip-body {
            padding: 1.25rem;
        }

        .ip-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .info-row {
            background: var(--base-clr);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--line-clr);
        }

        .info-label {
            font-size: 0.8rem;
            color: var(--secondary-text-clr);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-clr);
        }

        .reason-container {
            margin-top: 1.25rem;
            border-top: 1px dashed var(--line-clr);
            padding-top: 1.25rem;
        }

        .reason-label {
            color: var(--secondary-text-clr);
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .reason {
            background-color: var(--hover-clr);
            padding: 0.75rem;
            border-radius:7px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .ip-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--line-clr);
            display: flex;
            justify-content: flex-end;
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

        .btn-primary {
            background-color: var(--accent-clr);
            color: white;
        }

        .btn-primary:hover {
            background-color: #4a4fd9;
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-clr);
            border: 1px solid var(--line-clr);
        }

        .btn-secondary:hover {
            background-color: var(--hover-clr);
        }

        .btn-danger {
            background-color: transparent;
            color: var(--negative-text-clr);
            border: 1px solid var(--negative-text-clr);
        }

        .btn-danger:hover {
            background-color: var(--negative-bg-clr);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--secondary-text-clr);
            grid-column: 1 / -1;
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

        @media (max-width: 768px) {
         
            
            .ip-grid {
                grid-template-columns: 1fr;
            }
            
            .ip-info {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
       
            
            h1 {
                font-size: 1.3rem;
            }
            
            .stat-card {
                padding: 1rem;
            }
            
            .stat-value {
                font-size: 1.3rem;
            }
            
            .ip-header, .ip-body, .ip-footer {
                padding: 1rem;
            }
            
            .block-form {
                padding: 1rem;
            }
        }

        @media (max-width: 320px) {
         
            h1 {
                font-size: 1.2rem;
            }
            
            .search-bar input {
                padding: 0.6rem 1rem 0.6rem 2.25rem;
                font-size: 0.85rem;
            }
            
            .ip-address {
                font-size: 1rem;
            }
            
            .ip-badge {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }
            
            .btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
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
    <script src="/chain-fortune/js/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <div class="ip-container">
                <header>
                    <h1>Blocked IP Addresses</h1>
                    <div class="search-box">
                        <input type="text" class="search-input" id="searchInput" placeholder="Search Users name">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                </header>

                <section class="block-form">
                    <h2 class="block-form-title">Block New IP Address</h2>
                    <div id="blockIpForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="ipAddress" class="form-label">IP Address</label>
                                <input type="text" id="ipAddress" class="form-input" placeholder="Enter IP address" required>
                            </div>
                            <div class="form-group">
                                <label for="blockType" class="form-label">Block Type</label>
                                <select id="blockType" class="form-select">
                                    <option value="0">Temporary</option>
                                    <option value="1">Permanent</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea id="reason" class="form-textarea" value="Testing Purpose" aria-valuetext="Testing Purpose"></textarea>
                        </div>
                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary" id="block-ip-btn">Block IP</button>
                        </div>
                    </div>
                </section>
                    <?php
                        include("../../../backend/connection.php");

                        $countSql = "
                            SELECT 
                                COUNT(*) AS total,
                                SUM(is_permanent = 1) AS permanent,
                                SUM(is_permanent = 0) AS temporary
                            FROM blocked_ip
                        ";
                        $countResult = mysqli_query($conn, $countSql);
                        $stats = mysqli_fetch_assoc($countResult);

                        $totalBlocked = $stats['total'] ?? 0;
                        $permanentBlocks = $stats['permanent'] ?? 0;
                        $temporaryBlocks = $stats['temporary'] ?? 0;

                        // Render stats
                        echo <<<HTML
                        <section class="stats">
                            <div class="stat-card">
                                <div class="stat-value" id="totalBlocked">{$totalBlocked}</div>
                                <div class="stat-title">Total Blocked</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value" id="permanentBlocks">{$permanentBlocks}</div>
                                <div class="stat-title">Permanent Blocks</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value" id="temporaryBlocks">{$temporaryBlocks}</div>
                                <div class="stat-title">Temporary Blocks</div>
                            </div>
                        </section>
                        HTML;
                    ?>
                <section class="ip-grid" id="ipGrid">
                    <div id="loading" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                    <?php
                        $sql = "SELECT * FROM blocked_ip ORDER BY blocked_at DESC";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $ipAddress = htmlspecialchars($row['ip_address']);
                                $country = htmlspecialchars($row['country']);
                                $reason = htmlspecialchars($row['reason']);
                                $blockedAt = date('M j, Y', strtotime($row['blocked_at']));
                                $isPermanent = $row['is_permanent'] == 1;
                                $badgeClass = $isPermanent ? 'permanent' : 'temporary';
                                $badgeLabel = $isPermanent ? 'Permanent' : 'Temporary';
                                $unblockAt = $isPermanent ? 'Never' : date('M j, Y', strtotime('+30 days', strtotime($row['blocked_at'])));
                                $status = 'Active';

                                echo <<<HTML
                                    <div class="ip-card" data-ip="{$ipAddress}" data-country="{$country}" data-reason="{$reason}" data-block-type="{$row['is_permanent']}">
                                        <div class="ip-header">
                                            <div class="ip-address">{$ipAddress}</div>
                                            <div class="ip-badge {$badgeClass}">{$badgeLabel}</div>
                                        </div>
                                        <div class="ip-body">
                                            <div class="ip-info">
                                                <div class="info-row">
                                                    <div class="info-label">Country</div>
                                                    <div class="info-value">{$country}</div>
                                                </div>
                                                <div class="info-row">
                                                    <div class="info-label">Blocked At</div>
                                                    <div class="info-value">{$blockedAt}</div>
                                                </div>
                                                <div class="info-row">
                                                    <div class="info-label">Unblock At</div>
                                                    <div class="info-value">{$unblockAt}</div>
                                                </div>
                                                <div class="info-row">
                                                    <div class="info-label">Status</div>
                                                    <div class="info-value" style="color: var(--negative-text-clr);">{$status}</div>
                                                </div>
                                            </div>
                                            <div class="reason-container">
                                                <div class="reason-label">Reason for Blocking</div>
                                                <div class="reason">{$reason}</div>
                                            </div>
                                        </div>
                                        <div class="ip-footer">
                                            <button class="btn btn-danger unblock-btn">Unblock</button>
                                        </div>
                                    </div>
                                HTML;
                            }
                        } else {    
                            echo "<p class='empty-state'>No blocked IPs found.</p>";
                        }
                    ?>
                </section>

            <div class="pagination" id="pagination">
            <div class="results-info" id="resultsInfo" style="text-align: center; margin: 20px 0; color: #666;"></div>
                
            </div>
        </div>




    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        $(document).ready(function() {
            // Store all IP cards for filtering
            let allIpCards = [];
            let filteredIpCards = [];
            let currentPage = 1;
            const itemsPerPage = 6;
            const $loading = $('#loading');

            // Initialize cards array
            function initializeCards() {
                allIpCards = $('.ip-card').toArray();
                filteredIpCards = [...allIpCards];
            }

            // Enhanced search functionality
            $("#searchInput").on("keyup", function() {
                const searchValue = $(this).val().toLowerCase().trim();
                filterCards(searchValue);
            });

            // Filter cards based on search term
            function filterCards(searchTerm) {
                if (searchTerm === '') {
                    filteredIpCards = [...allIpCards];
                } else {
                    filteredIpCards = allIpCards.filter(card => {
                        const $card = $(card);
                        const ipAddress = $card.data('ip').toString().toLowerCase();
                        const country = $card.data('country').toString().toLowerCase();
                        const reason = $card.data('reason').toString().toLowerCase();
                        
                        return ipAddress.includes(searchTerm) || 
                               country.includes(searchTerm) || 
                               reason.includes(searchTerm);
                    });
                }
                
                currentPage = 1; // Reset to first page
                displayCards();
                
                // Show loading and toast if no results found
                if (filteredIpCards.length === 0 && searchTerm !== '') {
                    $loading.show();
                    showToast('error', 'No IPs found matching your search');
                    setTimeout(() => $loading.hide(), 1000);
                } else {
                    $loading.hide();
                }
            }

            // Display cards for current page
            function displayCards() {
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const cardsToShow = filteredIpCards.slice(startIndex, endIndex);

                // Hide all cards first
                $('.ip-card').hide();

                // Show only the cards for current page
                cardsToShow.forEach(card => {
                    $(card).show();
                });

                // Update results info
                updateResultsInfo();

                // Update pagination
                updatePagination();

                // Handle empty state
                if (filteredIpCards.length === 0) {
                    if ($('.empty-state').length === 0) {
                        $('#ipGrid').append("<p class='empty-state'>No blocked IPs found.</p>");
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
                const totalCards = filteredIpCards.length;
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, totalCards);

                if (totalCards === 0) {
                    $('#resultsInfo').text('No IPs found');
                } else {
                    $('#resultsInfo').text(`Showing ${startIndex}-${endIndex} of ${totalCards} blocked IPs`);
                }
            }

            // Enhanced pagination
            function updatePagination() {
                const totalPages = Math.ceil(filteredIpCards.length / itemsPerPage);
                const $pagination = $("#pagination");
                $pagination.empty();

                if (totalPages <= 1) return;

                // Previous button
                const prevBtn = $(`<button class="page-btn prev-next" ${currentPage === 1 ? 'disabled' : ''}>«</button>`);
                prevBtn.on('click', () => {
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
                    firstBtn.on('click', () => {
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
                    pageBtn.on('click', () => {
                        currentPage = i;
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
                    lastBtn.on('click', () => {
                        currentPage = totalPages;
                        displayCards();
                    });
                    $pagination.append(lastBtn);
                }

                // Next button
                const nextBtn = $(`<button class="page-btn prev-next" ${currentPage === totalPages ? 'disabled' : ''}>»</button>`);
                nextBtn.on('click', () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayCards();
                    }
                });
                $pagination.append(nextBtn);
            }

            // Update cards array after removal
            function updateCardsAfterRemoval(removedIp) {
                allIpCards = allIpCards.filter(card => $(card).data('ip') !== removedIp);
                filteredIpCards = filteredIpCards.filter(card => $(card).data('ip') !== removedIp);
                
                // Adjust current page if necessary
                const totalPages = Math.ceil(filteredIpCards.length / itemsPerPage);
                if (currentPage > totalPages && totalPages > 0) {
                    currentPage = totalPages;
                } else if (totalPages === 0) {
                    currentPage = 1;
                }
                
                displayCards();
                updateBlockStatsUI();
            }

            // Your existing block IP functionality
            $('#block-ip-btn').on('click', function() {
                const ipAddress = $('#ipAddress').val().trim();
                const blockType = $('#blockType').val();
                const reason = $('#reason').val().trim();

                if (!ipAddress || !blockType || !reason) {
                    showToast('error', 'Please fill in all fields');
                    return;
                }

                Swal.fire({
                    title: 'Blocking IP...',
                    text: 'Please wait while we process your request.',
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
                        url: '/chain-fortune/action/block_ip_address_logic',
                        method: 'POST',
                        data: {
                            ip_address: ipAddress,
                            block_type: blockType,
                            reason: reason
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
                                        location.reload();
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
                            Swal.close();
                            console.error("AJAX Error:", status, error);
                            showToast('error', 'Server error. Please try again.');
                        }
                    });
                }, 2000);
            });

            // Your existing update stats function
            function updateBlockStatsUI() {
                const cards = $('.ip-card:visible');
                const total = allIpCards.length;
                const permanent = $(allIpCards).filter('[data-block-type="1"]').length;
                const temporary = $(allIpCards).filter('[data-block-type="0"]').length;

                $('#totalBlocked').text(total);
                $('#permanentBlocks').text(permanent);
                $('#temporaryBlocks').text(temporary);
            }

            // Enhanced unblock functionality
            $(document).on('click', '.unblock-btn', function() {
                const ipCard = $(this).closest('.ip-card');
                const ipAddress = ipCard.data('ip');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you want to unblock ${ipAddress}?`,
                    icon: 'warning',
                    background: 'var(--hover-clr)',
                    color: '#fff',
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#f44336',
                    confirmButtonText: 'Yes, unblock it!',
                    customClass: {
                        popup: 'swal2-dark-popup'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Unblocking IP...',
                            text: 'Please wait while we process your request.',
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
                                url: '/chain-fortune/action/unblock_ip_address_logic',
                                method: 'POST',
                                data: { ip_address: ipAddress },
                                dataType: 'json',
                                success: function(response) {
                                    const data = response;
                                    if (data.status === 'success') {
                                        // Remove from DOM and update arrays
                                        ipCard.remove();
                                        updateCardsAfterRemoval(ipAddress);
                                        
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
                    }
                });
            });

            // Initialize the system
            initializeCards();
            displayCards();
        });
    </script>




</body>
</html>



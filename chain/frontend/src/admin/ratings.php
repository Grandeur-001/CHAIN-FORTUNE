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
    <link rel="stylesheet" href="../styles/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const sideBarItem = document.querySelectorAll("#sidebar ul li")[5]
            sideBarItem.classList.add("active");

            const navItem = document.querySelectorAll("#bottom_nav a")[0];
            navItem.classList.add("active");
        });
    </script>
    <style>
        *{
            font-family: var(--index-font);
        }
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
        .ratings-container {
            .header {
                text-align: center;
                margin-bottom: clamp(2rem, 5vw, 3rem);
                padding: clamp(1rem, 3vw, 2rem);
                /* background: var(--base-clr); */
                /* border: 1px solid var(--line-clr); */
                border-radius: 16px;
                backdrop-filter: blur(20px);
                position: relative;
                overflow: hidden;
            }

            .header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, 
                    rgba(94, 99, 255, 0.05) 0%, 
                    transparent 50%, 
                    rgba(16, 185, 129, 0.03) 100%);
                pointer-events: none;
            }

            .header h1 {
                font-size: clamp(2rem, 6vw, 3rem);
                font-weight: 700;
                margin-bottom: 0.5rem;
                color: var(--text-clr);
            }

            .header p {
                color: var(--secondary-text-clr);
                font-size: clamp(1rem, 3vw, 1.2rem);
                position: relative;
                z-index: 1;
            }

        }

        
        .stats-bar {
            display: flex;
            gap: clamp(1rem, 3vw, 2rem);
            margin-bottom: clamp(2rem, 4vw, 3rem);
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat-item {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 12px;
            padding: clamp(1rem, 3vw, 1.5rem);
            text-align: center;
            flex: 1;
            min-width: clamp(120px, 25vw, 180px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-item::before {
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

        .stat-item:hover {
            border-color: var(--accent-clr);
            transform: translateY(-2px);
        }

        .stat-item:hover::before {
            transform: scaleX(1);
        }

        .stat-number {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 700;
            color: var(--accent-clr);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--secondary-text-clr);
            font-size: clamp(0.8rem, 2.5vw, 0.9rem);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filters {
            display: flex;
            gap: clamp(0.5rem, 2vw, 1rem);
            margin-bottom: clamp(1.5rem, 3vw, 2rem);
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-btn {
            padding: clamp(0.5rem, 2vw, 0.75rem) clamp(1rem, 3vw, 1.5rem);
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 25px;
            color: var(--secondary-text-clr);
            font-size: clamp(0.8rem, 2.5vw, 0.9rem);
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--accent-clr);
            border-color: var(--accent-clr);
            color: white;
            transform: translateY(-1px);
        }

        .ratings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(clamp(280px, 40vw, 350px), 1fr));
            gap: clamp(1rem, 3vw, 1.5rem);
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .rating-cards {
            background: var(--base-clr);
            border: 1px solid var(--line-clr);
            border-radius: 16px;
            padding: clamp(1.25rem, 4vw, 1.75rem);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .rating-cards.hidden {
            display: none;
        }

        .rating-cards::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-clr), var(--positive-text-clr));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .rating-cards:hover {
            border-color: var(--accent-clr);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(94, 99, 255, 0.15);
        }

        .rating-cards:hover::before {
            transform: scaleX(1);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: clamp(0.75rem, 2vw, 1rem);
            margin-bottom: clamp(1rem, 3vw, 1.25rem);
        }

        .user-avatar {
            width: clamp(40px, 10vw, 50px);
            height: clamp(40px, 10vw, 50px);
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-clr), var(--info-clr));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: clamp(1rem, 3vw, 1.1rem);
            font-weight: 600;
            color: var(--text-clr);
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-id {
            font-size: clamp(0.75rem, 2vw, 0.85rem);
            color: var(--secondary-text-clr);
            font-family: 'Courier New', monospace;
        }

        .rating-display {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: clamp(0.75rem, 2vw, 1rem);
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .stars {
            display: flex;
            gap: clamp(0.1rem, 0.5vw, 0.2rem);
            font-size: clamp(1.2rem, 4vw, 1.5rem);
        }

        .star {
            color: #ffd700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
            transition: all 0.2s ease;
        }

        .star.empty {
            color: var(--line-clr);
            text-shadow: none;
        }

        .rating-number {
            background: var(--hover-clr);
            color: var(--accent-clr);
            padding: clamp(0.25rem, 1vw, 0.4rem) clamp(0.5rem, 2vw, 0.75rem);
            border-radius: 20px;
            font-size: clamp(0.75rem, 2vw, 0.85rem);
            font-weight: 600;
            border: 1px solid var(--line-clr);
        }

        .date-info {
            color: var(--secondary-text-clr);
            font-size: clamp(0.75rem, 2vw, 0.85rem);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .date-icon {
            width: 16px;
            height: 16px;
            opacity: 0.7;
        }

        .empty-state {
            text-align: center;
            padding: clamp(3rem, 8vw, 5rem);
            color: var(--secondary-text-clr);
            grid-column: 1 / -1;
        }

        .empty-state-icon {
            font-size: clamp(3rem, 8vw, 4rem);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Enhanced mobile responsiveness */
        @media (max-width: 480px) {
            .stats-bar {
                gap: 0.75rem;
            }
            
            .stat-item {
                min-width: 100px;
                padding: 0.75rem;
            }
            
            .filters {
                gap: 0.5rem;
            }
            
            .ratings-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 360px) {
            .stats-bar {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .stat-item {
                min-width: auto;
            }
            
            .rating-display {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }

        @media (max-width: 320px) {
          
            .ratings-container{
                .header {
                    padding: 1rem;
                }
            
            }
          
            .rating-cards {
                padding: 1rem;
            }
            
            .card-header {
                gap: 0.75rem;
            }
            
            .user-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.8rem;
            }
            
            .stars {
                font-size: 1.1rem;
            }
        }
    </style>
</head>


<body>
    
    <!-- <?php include "../components/header.php"; ?> -->
    <?php include "../components/sidebar.php"; ?>
    <?php include "../components/toastify.php"; ?>

    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toastify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/chain-fortune/js/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <main class="main" id="main">
        <div class="app-container">
            <div class="ratings-container">
                <div class="header">
                    <h1>User Ratings</h1>
                    <p>Customer feedback and ratings overview</p>
                </div>

                <div class="stats-bar">
                    <div class="stat-item">
                        <div class="stat-number" id="totalRatings">5</div>
                        <div class="stat-label">Total Ratings</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="avgRating">4.2</div>
                        <div class="stat-label">Average Rating</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="fiveStars">3</div>
                        <div class="stat-label">5 Star Reviews</div>
                    </div>
                    <?php
                        include '../../../backend/connection.php';
                        $currentMonth = date('Y-m'); // Get current year and month
                        $stmt = $conn->prepare("SELECT COUNT(*) AS total_ratings FROM ratings WHERE DATE_FORMAT(created_at, '%Y-%m') = ?");
                        $stmt->bind_param("s", $currentMonth);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        $totalRatings = $row['total_ratings'] ?? 0;

                        echo "<div class='stat-item'>
                                <div class='stat-number' id='thisMonth'>{$totalRatings}</div>
                                <div class='stat-label'>This Month</div>
                            </div>";
                    ?>

                </div>

                <div class="filters">
                    <button class="filter-btn active" data-filter="all">All Ratings</button>
                    <button class="filter-btn" data-filter="5">5 Stars</button>
                    <button class="filter-btn" data-filter="4">4 Stars</button>
                    <button class="filter-btn" data-filter="3">3 Stars</button>
                    <button class="filter-btn" data-filter="2">2 Stars</button>
                    <button class="filter-btn" data-filter="1">1 Star</button>
                </div>

                <div class="ratings-grid" id="ratingsGrid">
                <?php
                    include '../../../backend/connection.php';

                    $stmt = $conn->prepare("SELECT r.user_id, r.rating, r.created_at, u.firstname, u.lastname, u.profile_picture FROM ratings r JOIN users u ON r.user_id = u.user_id ORDER BY r.created_at DESC");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $userInitials = strtoupper(substr($row['firstname'], 0, 1) . substr($row['lastname'], 0, 1));
                        if ($row['profile_picture']) {
                            $userInitials = '<img src="/chain-fortune/img/' . htmlspecialchars($row['profile_picture']) . '" alt="User Avatar" class="user-avatar">';
                        } else {
                            $userInitials = '<div class="user-avatar">' . $userInitials . '</div>';
                        }
                        $fullName = $row['firstname'] . " " . $row['lastname'];
                        $rating = $row['rating'];
                        $userId = $row['user_id'];
                        $date = date("jS F Y", strtotime($row['created_at']));

                        $starsHtml = '';
                        for ($i = 1; $i <= 5; $i++) {
                            $starsHtml .= $i <= $rating ? '<span class="star">★</span>' : '<span class="star empty">☆</span>';
                        }

                        echo <<<HTML
                        <div class="rating-cards" data-rating="{$rating}">
                            <div class="card-header">
                                <div class="user-avatar">{$userInitials}</div>
                                <div class="user-info">
                                    <div class="user-name">{$fullName}</div>
                                    <div class="user-id"><b>USR-</b>{$userId}</div>
                                </div>
                            </div>
                            <div class="rating-display">
                                <div class="stars">{$starsHtml}</div>
                                <div class="rating-number">{$rating}/5</div>
                            </div>
                            <div class="date-info">
                                <svg class="date-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                {$date}
                            </div>
                        </div>
                    HTML;
                    }

                    $stmt->close();
                    $conn->close();
                ?>

                </div>
            </div>
        </div>
    </main>



    <?php include "../components/footer.php"; ?>
    <?php include "../components/bottom_nav.php"; ?>


    
    <script src="/chain-fortune/js/jquery-3.6.0.min.js"></script>
    <script src="/chain-fortune/js/toggle_sidebar.js"></script>
    <script>
        // Get all rating cards
        const ratingCards = document.querySelectorAll('.rating-cards');
        
        // Update statistics based on visible cards
        function updateStats() {
            const visibleCards = document.querySelectorAll('.rating-cards:not(.hidden)');
            const total = visibleCards.length;
            
            if (total === 0) {
                document.getElementById('totalRatings').textContent = '0';
                document.getElementById('avgRating').textContent = '0.0';
                document.getElementById('fiveStars').textContent = '0';
                return;
            }
            
            let sum = 0;
            let fiveStarCount = 0;
            
            visibleCards.forEach(card => {
                const rating = parseInt(card.dataset.rating);
                sum += rating;
                if (rating === 5) fiveStarCount++;
            });
            
            const average = (sum / total).toFixed(1);
            
            document.getElementById('totalRatings').textContent = total;
            document.getElementById('avgRating').textContent = average;
            document.getElementById('fiveStars').textContent = fiveStarCount;
        }

        // Filter ratings
        function filterRatings(filter) {
            const ratingsGrid = document.getElementById('ratingsGrid');
            
            // Remove any existing empty state
            const existingEmptyState = ratingsGrid.querySelector('.empty-state');
            if (existingEmptyState) {
                existingEmptyState.remove();
            }
            
            let visibleCount = 0;
            
            ratingCards.forEach(card => {
                const rating = parseInt(card.dataset.rating);
                
                if (filter === 'all' || rating === parseInt(filter)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });
            
            // Show empty state if no cards are visible
            if (visibleCount === 0) {
                const emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.innerHTML = `
                    <div class="empty-state-icon">📊</div>
                    <h3>No ratings found</h3>
                    <p>No ratings match the current filter.</p>
                `;
                ratingsGrid.appendChild(emptyState);
            }
            
            updateStats();
        }

        // Handle filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                // Filter ratings
                filterRatings(btn.dataset.filter);
            });
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateStats();
        });
    </script>




</body>
</html>



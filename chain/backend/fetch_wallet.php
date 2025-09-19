<?php
if (!isset($_SESSION['user_id'])) {
    die('Session user_id not set!');
}
include('../../../backend/connection.php');


function getUserWallets($userId, $conn) {
    $query = "
        SELECT c.crypto_name AS crypto_name, c.crypto_symbol AS crypto_symbol, c.crypto_icon AS crypto_icon, c.crypto_id AS crypto_id, uw.amount
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ?
        ORDER BY c.id
    ";


    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return [];
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $wallets = [];

    while ($row = $result->fetch_assoc()) {
        $wallets[] = $row;
    }

    $stmt->close();
    return $wallets;
}


$user_id = $_SESSION['user_id'];
$wallets = getUserWallets($user_id, $conn);

foreach ($wallets as $wallet) {
    echo '
        <div class="coin-card" id="' . htmlspecialchars($wallet['crypto_symbol']) . '">
            <div class="coin-info">
                <img src="' . htmlspecialchars($wallet['crypto_icon']) . '" alt="' . htmlspecialchars($wallet['crypto_name']) . '" class="coin-image">
                <div class="coin-name-container">
                    <h2>' . htmlspecialchars($wallet['crypto_name']) . '</h2>
                    <span class="coin-symbol" data-symbol="' . htmlspecialchars($wallet['crypto_symbol']) . '">
                        ' . htmlspecialchars($wallet['crypto_symbol']) . '
                        <code class="coin-change" style="margin-left:5px; margin-top:2.4px; border-radius:3px; font-size:0.7rem;">
                            Loading...
                         </code>
                        
                    </span>
                </div>
            </div>
            <div class="price-container">
                <span class="converted-price" data-symbol="' . htmlspecialchars($wallet['crypto_symbol']) . '" data-usd="' . htmlspecialchars($wallet['amount']) . '" data-id="' . htmlspecialchars($wallet['crypto_id']) . '">
                        Loading...
                 </span>
                <div class="wallet-amount ">' . htmlspecialchars($wallet['amount']) . ' USD</div>
                <input type="hidden" class="wallet-amount-hidden" name="" value="' . htmlspecialchars($wallet['amount']) . '">
            </div>
        </div>
    ';
}

// Convert PHP array to JSON for JavaScript
$walletsJson = json_encode($wallets);
?>

<!-- Add Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Add Chart.js plugin for gradient fills -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-gradient"></script>

<!-- Add container for the chart -->
<div class="chart-container">
    <h3 class="chart-title">Portfolio Distribution</h3>
    <canvas id="walletChart"></canvas>
</div>

<script>
    // Initialize the chart with wallet data
    document.addEventListener('DOMContentLoaded', function() {
        const walletData = <?php echo $walletsJson; ?>;
        
        // Get the canvas element
        const ctx = document.getElementById('walletChart').getContext('2d');
        
        // Define vibrant colors for the chart (similar to the image)
        const chartColors = [
            { line: 'rgba(255, 66, 176, 1)', fill: 'rgba(255, 66, 176, 0.3)' },  // Magenta
            { line: 'rgba(255, 177, 66, 1)', fill: 'rgba(255, 177, 66, 0.3)' },  // Gold
            { line: 'rgba(66, 214, 164, 1)', fill: 'rgba(66, 214, 164, 0.3)' },  // Green
            { line: 'rgba(66, 135, 255, 1)', fill: 'rgba(66, 135, 255, 0.3)' },  // Blue
            { line: 'rgba(194, 66, 255, 1)', fill: 'rgba(194, 66, 255, 0.3)' }   // Purple
        ];
        
        // Sort wallets by amount for better visualization
        walletData.sort((a, b) => parseFloat(b.amount) - parseFloat(a.amount));
        
        // Prepare data for the chart
        const labels = walletData.map(wallet => wallet.crypto_symbol);
        const data = walletData.map(wallet => parseFloat(wallet.amount));
        
        // Create mock historical data for area chart (since we only have current values)
        // This simulates the look of the example image with area charts
        const datasets = [];
        
        // Create a dataset for each wallet
        walletData.forEach((wallet, index) => {
            const colorIndex = index % chartColors.length;
            const baseValue = parseFloat(wallet.amount);
            
            // Create simulated data points for the area chart
            // This creates a wave-like pattern similar to the example
            const simulatedData = [
                baseValue * (0.9 + Math.random() * 0.2),
                baseValue * (0.85 + Math.random() * 0.2),
                baseValue * (0.95 + Math.random() * 0.2),
                baseValue * (1.1 + Math.random() * 0.2),
                baseValue * (0.9 + Math.random() * 0.2),
                baseValue * (1.0 + Math.random() * 0.2),
                baseValue
            ];
            
            datasets.push({
                label: wallet.crypto_symbol,
                data: simulatedData,
                borderColor: chartColors[colorIndex].line,
                backgroundColor: chartColors[colorIndex].fill,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: chartColors[colorIndex].line,
                pointBorderColor: '#000',
                pointBorderWidth: 1,
                tension: 0.4,
                fill: true
            });
        });
        
        // Create the chart
        const walletChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: 'rgba(255, 255, 255, 0.8)',
                            font: {
                                family: "'Segoe UI', Roboto, Arial, sans-serif",
                                size: 12
                            },
                            boxWidth: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        padding: 10,
                        titleFont: {
                            family: "'Segoe UI', Roboto, Arial, sans-serif",
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: "'Segoe UI', Roboto, Arial, sans-serif",
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: $${context.parsed.y.toFixed(2)}`;
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)',
                            font: {
                                family: "'Segoe UI', Roboto, Arial, sans-serif",
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)',
                            font: {
                                family: "'Segoe UI', Roboto, Arial, sans-serif",
                                size: 12
                            },
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0.4
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
        
        // Make the chart responsive to window resize
        window.addEventListener('resize', function() {
            walletChart.resize();
        });
    });
</script>

<style>
    /* Modern styling for the chart */
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        margin-top: 30px;
        border-radius: 7px;
        padding: 20px;
        background-color: var(--base-clr);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        border: 1px solid var(--line-clr);
        transition: all 0.3s ease;
    }

    .chart-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background: radial-gradient(circle at top right, rgba(66, 66, 255, 0.1), transparent 70%), */
                    /* radial-gradient(circle at bottom left, rgba(255, 66, 176, 0.1), transparent 70%); */
        pointer-events: none;
    }

    .chart-title {
        color: #fff;
        font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        text-align: left;
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 300px;
            padding: 15px;
        }
        
        .chart-title {
            font-size: 16px;
        }
    }
</style>


<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const priceSpans = document.querySelectorAll('.converted-price');
    //     const changeCodes = document.querySelectorAll('.coin-change');

    //     const uniqueIds = new Set();
    //     priceSpans.forEach(span => {
    //         const id = span.dataset.id;
    //         if (id) uniqueIds.add(id);
    //     });

    //     if (uniqueIds.size === 0) return;

    //     const idsQuery = Array.from(uniqueIds).join(',');

    //     fetch(`https://api.coingecko.com/api/v3/simple/price?ids=${idsQuery}&vs_currencies=usd&include_24hr_change=true`)
    //         .then(res => res.json())
    //         .then(prices => {
    //             priceSpans.forEach((span, index) => {
    //                 const id = span.dataset.id;
    //                 const symbol = span.dataset.symbol;
    //                 const usdAmount = parseFloat(span.dataset.usd);

    //                 const data = prices[id];
    //                 if (data && data.usd && data.usd_24h_change !== undefined) {
    //                     const coinPrice = data.usd;
    //                     const priceChange = parseFloat(data.usd_24h_change).toFixed(2);
    //                     const converted = (usdAmount / coinPrice).toFixed(6);

    //                     span.textContent = `${converted} ${symbol}`;

    //                     const code = changeCodes[index];
    //                     const color = priceChange >= 0 ? 'var(--positive-text-clr)' : 'var(--negative-text-clr)';
    //                     const prefix = priceChange >= 0 ? '+' : '';
    //                     code.textContent = `${prefix}${priceChange}%`;
    //                     code.style.color = color;
    //                 } else {
    //                     span.textContent = 'N/A';
    //                     if (changeCodes[index]) changeCodes[index].textContent = 'N/A';
    //                 }
    //             });
    //         })
    //         .catch(err => {
    //             console.error("Price fetch failed:", err);
    //             priceSpans.forEach(span => span.innerHTML = 'N/A');
    //             changeCodes.forEach(code => code.textContent = 'N/A');
    //         });
    // });
    $(document).ready(function () {
        const priceSpans = $('.converted-price');
        const changeCodes = $('.coin-change');

        const uniqueIds = new Set();
        priceSpans.each(function () {
            const id = $(this).data('id');
            if (id) uniqueIds.add(id);
        });

        if (uniqueIds.size === 0) return;

        const idsQuery = Array.from(uniqueIds).join(',');

        $.getJSON(`https://api.coingecko.com/api/v3/simple/price?ids=${idsQuery}&vs_currencies=usd&include_24hr_change=true`)
            .done(function (prices) {
                priceSpans.each(function (index) {
                    const $span = $(this);
                    const id = $span.data('id');
                    const symbol = $span.data('symbol');
                    const usdAmount = parseFloat($span.data('usd'));

                    const data = prices[id];
                    if (data && data.usd && data.usd_24h_change !== undefined) {
                        const coinPrice = data.usd;
                        const priceChange = parseFloat(data.usd_24h_change).toFixed(2);
                        const converted = (usdAmount / coinPrice).toFixed(6);

                        $span.text(`${converted} ${symbol}`);

                        const $code = $(changeCodes[index]);
                        const color = priceChange >= 0 ? 'var(--positive-text-clr)' : 'var(--negative-text-clr)';
                        const prefix = priceChange >= 0 ? '+' : '';
                        $code.text(`${prefix}${priceChange}%`);
                        $code.css('color', color);
                    } else {
                        $span.text('N/A');
                        if (changeCodes[index]) $(changeCodes[index]).text('N/A');
                    }
                });
            })
            .fail(function (err) {
                console.error("Price fetch failed:", err);
                priceSpans.each(function () {
                    $(this).html('N/A');
                });
                changeCodes.each(function () {
                    $(this).text('N/A');
                });
            });
    });

</script>

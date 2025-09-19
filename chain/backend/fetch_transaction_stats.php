<?php
require_once 'connection.php'; 

function getStats($conn, $table) {
    $stats = [
        'total' => 0,
        'pending' => 0,
        'approved' => 0,
        'declined' => 0
    ];

    $query = "SELECT status, COUNT(*) as count FROM $table GROUP BY status";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $status = strtolower($row['status']);
        $count = (int)$row['count'];

        if (isset($stats[$status])) {
            $stats[$status] = $count;
        }
        $stats['total'] += $count;
    }

    return $stats;
}

$depositStats = getStats($conn, 'deposit_transactions');
$withdrawalStats = getStats($conn, 'withdrawal_transactions');

echo json_encode([
    'deposit' => $depositStats,
    'withdrawal' => $withdrawalStats
]);

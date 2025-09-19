<?php
header('Content-Type: application/json');
require_once 'connection.php';

$sql = "
    SELECT
        id,
        crypto_name,
        crypto_symbol,
        crypto_icon,
        wallet_address,
        qr_code      
    FROM currencies
    ORDER BY id
";

$result = $conn->query($sql);
if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch cryptocurrencies.']);
    exit;
}

$cryptos = [];
while ($row = $result->fetch_assoc()) {

    $cryptos[] = [
        'id'             => (int) $row['id'],
        'crypto_name'    => $row['crypto_name'],
        'crypto_symbol'  => strtoupper($row['crypto_symbol']),
        'crypto_icon'    => $row['crypto_icon'] ?: '',

        'wallet_address' => $row['wallet_address'] ?: '',
        'qr_code'        => $row['qr_code'] ?: ''      
    ];
}

echo json_encode($cryptos, JSON_UNESCAPED_SLASHES);

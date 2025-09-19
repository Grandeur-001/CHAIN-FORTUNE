<?php
    session_start();
    header('Content-Type: application/json');

    require_once __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    include('connection.php');

    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        echo json_encode(['error' => 'User not authenticated']);
        exit;
    }

    $query = "
        SELECT c.crypto_name AS name, c.crypto_symbol AS symbol, c.crypto_icon AS iconUrl, c.crypto_id AS crypto_id,
            c.wallet_address, c.qr_code, uw.amount
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ?
        ORDER BY c.id
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $cryptos = [];
    while ($row = $result->fetch_assoc()) {
        $cryptos[] = [
            'id' => strtolower($row['symbol']),
            'name' => $row['name'],
            'symbol' => $row['symbol'],
            'iconUrl' => $row['iconUrl'],
            'wallet_address' => $row['wallet_address'],
            'qr_code' => $row['qr_code'],
            'price' => '$' . number_format($row['amount']),
            'crypto_id' => $row['crypto_id'],
        ];
    }

    echo json_encode($cryptos);
?>





<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;

    header('Content-Type: application/json');

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $adminUserId = trim($_ENV['ADMIN_USER_ID']);

    include('connection.php');

    function sendResponse($status, $message) {
        echo json_encode(['status' => $status, 'message' => $message]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_POST['userId'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $wallet = $_POST['wallet'] ?? '';

        if (empty($userId) || empty($amount) || empty($wallet)) {
            sendResponse('error', 'All fields are required.');
        }

        if (!ctype_digit($amount) || intval($amount) <= 0) {
            sendResponse('error', 'Enter a valid  amount.');
        }

        $amount = floatval($amount);
        $wallet = strtoupper(trim($wallet));

        $stmt = $conn->prepare("
            SELECT uw.amount, c.id AS currency_id 
            FROM users_wallet uw
            JOIN currencies c ON uw.currency_id = c.id
            WHERE uw.user_id = ? AND c.crypto_symbol = ?
        ");
        $stmt->bind_param('is', $userId, $wallet);
        $stmt->execute();
        $userResult = $stmt->get_result();

        if ($userResult->num_rows === 0) {
            sendResponse('error', 'Selected wallet not found for user.');
        }
        $userWallet = $userResult->fetch_assoc();
        $currencyId = $userWallet['currency_id'];

        $stmt = $conn->prepare("
            SELECT uw.amount 
            FROM users_wallet uw
            WHERE uw.user_id = ? AND uw.currency_id = ?
        ");
        $stmt->bind_param('ii', $adminUserId, $currencyId);
        $stmt->execute();
        $adminResult = $stmt->get_result();

        if ($adminResult->num_rows === 0) {
            sendResponse('error', 'Admin wallet not found.');
        }

        $adminWallet = $adminResult->fetch_assoc();
        $adminBalance = $adminWallet['amount'];

        if ($adminBalance < $amount) {
            sendResponse('error', "Insufficient balance in Admin's $wallet wallet.");

        }

        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare("
                UPDATE users_wallet
                SET amount = amount - ?
                WHERE user_id = ? AND currency_id = ?
            ");
            $stmt->bind_param('dii', $amount, $adminUserId, $currencyId);
            $stmt->execute();
        
            $stmt = $conn->prepare("
                UPDATE users_wallet
                SET amount = amount + ?
                WHERE user_id = ? AND currency_id = ?
            ");
            $stmt->bind_param('dii', $amount, $userId, $currencyId);
            $stmt->execute();
        
            $stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE user_id = ?");
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $fullName = $user['firstname'] . ' ' . $user['lastname'];
            } else {
                $fullName = 'User';
            }
        
            $stmt = $conn->prepare("SELECT amount FROM users_wallet WHERE user_id = ? AND currency_id = ?");
            $stmt->bind_param('ii', $userId, $currencyId);
            $stmt->execute();
            $userBalanceResult = $stmt->get_result();
            $userNewBalance = $userBalanceResult->fetch_assoc()['amount'];
        
            $stmt = $conn->prepare("SELECT amount FROM users_wallet WHERE user_id = ? AND currency_id = ?");
            $stmt->bind_param('ii', $adminUserId, $currencyId);
            $stmt->execute();
            $adminBalanceResult = $stmt->get_result();
            $adminNewBalance = $adminBalanceResult->fetch_assoc()['amount'];
        
            $notification_message = "Your {$wallet} Wallet has been credited with \$" . number_format($amount, 0) . ", your new {$wallet} balance is \$" . number_format($userNewBalance, 0);
            $notification_symbol = "https://cdn-icons-png.flaticon.com/512/4957/4957559.png";
        
            $insert_notification = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_notification);
            $stmt->bind_param("iss", $userId, $notification_message, $notification_symbol);
            $stmt->execute();
        
            $notification_message = "You have sent \$" . number_format($amount, 0) . " to {$fullName}'s {$wallet} Wallet, your new {$wallet} balance is \$" . number_format($adminNewBalance, 0);
            $notification_symbol = "https://cdn-icons-png.flaticon.com/512/6200/6200329.png";
        
            $stmt = $conn->prepare($insert_notification);
            $stmt->bind_param("iss", $adminUserId, $notification_message, $notification_symbol);
            $stmt->execute();
        
            $conn->commit();
        
            sendResponse('success', "Successfully sent $" . number_format($amount, 0) . " in $wallet to $fullName.");
        } catch (Exception $e) {
            $conn->rollback();
            sendResponse('error', 'Transaction failed: ' . $e->getMessage());
        }
    } else {
        sendResponse('error', 'Invalid request method.');
    }
?>

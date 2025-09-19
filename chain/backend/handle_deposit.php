
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    header('Content-Type: application/json');

    require 'connection.php';
    require_once __DIR__ . '/vendor/autoload.php'; 

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Label\Label;
    use Endroid\QrCode\Logo\Logo;
    use Endroid\QrCode\Writer\Result\Result;



    function sendResponse($status, $message, $redirect = null) {
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'redirect' => $redirect
        ]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendResponse('error', 'Invalid request method.');
    }

    $userId = trim($_POST['user_id'] ?? '');
    $cryptoSymbol = strtoupper(trim($_POST['crypto_symbol'] ?? ''));
    $walletAddress = trim($_POST['wallet_address'] ?? '');
    $amount = trim($_POST['amount'] ?? '');

    if (empty($userId) || empty($cryptoSymbol) || empty($walletAddress) || empty($amount)) {
        sendResponse('error', 'All fields are required.');
    }

    if (!is_numeric($amount) || $amount <= 0) {
        sendResponse('error', 'Invalid deposit amount.');
    }

    $stmt = $conn->prepare("
        SELECT c.crypto_name, c.crypto_symbol, c.wallet_address, c.qr_code, uw.amount AS user_wallet_balance
        FROM users_wallet uw
        JOIN currencies c ON uw.currency_id = c.id
        WHERE uw.user_id = ? AND c.crypto_symbol = ?
        LIMIT 1
    ");
    $stmt->bind_param("ss", $userId, $cryptoSymbol);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'Invalid user or cryptocurrency.');
    }

    $data = $result->fetch_assoc();

    if ($walletAddress !== $data['wallet_address']) {
        sendResponse('error', 'Wallet address does not match.');
    }

    $randomHash = bin2hex(random_bytes(16));
    $transactionId = 'txn_' . $randomHash;

    $minerPreference = 'Medium';
    $status = 'Pending';
    $transactionType = 'Credit';

    $qrContent = "Deposit Request\nTransaction ID: $transactionId\nUser ID: $userId\nCrypto: $cryptoSymbol\nAmount: $amount\nWallet: $walletAddress";
    $deposit_QRCODE_Dir = __DIR__ . '/code/deposit_qr_code/';
    if (!is_dir($deposit_QRCODE_Dir)) {
        mkdir($deposit_QRCODE_Dir, 0777, true); 
    }
    $qrFilename = "deposit_qr_{$userId}_{$transactionId}.png";
    $qrFilePath = $deposit_QRCODE_Dir . $qrFilename;
    $qrPublicUrl = "$qrFilename";

    
    $qrCode = QrCode::create($qrContent)
    ->setSize(300)
    ->setMargin(10);

    $logoPath = __DIR__ . '/../frontend/src/images/logo/logo_5.png';
    $logo = Logo::create($logoPath)->setResizeToWidth(60);

    $writer = new PngWriter();
    $result = $writer->write($qrCode, $logo);
    $result->saveToFile($qrFilePath);
    

    $insert = $conn->prepare("
        INSERT INTO deposit_transactions (
            user_id, transaction_id, wallet_address, crypto_symbol, amount, 
            miner_preference, status, transaction_type, qr_code
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insert->bind_param(
        "ssssdssss",
        $userId,
        $transactionId,
        $walletAddress,
        $cryptoSymbol,
        $amount,
        $minerPreference,
        $status,
        $transactionType,
        $qrPublicUrl
    );
    

    $user_id = $userId; 
    $adminUserId = trim($_ENV['ADMIN_USER_ID']);
    $roleQuery = "SELECT role FROM users WHERE user_id = ?";
    $roleStmt = $conn->prepare($roleQuery);
    $roleStmt->bind_param("i", $user_id);
    $roleStmt->execute();
    $roleResult = $roleStmt->get_result();
    $userRole = null;
    
    if ($roleRow = $roleResult->fetch_assoc()) {
        $userRole = $roleRow['role'];
    } else {
        sendResponse('error', 'User not found');
    }
    
    $redirect = ($user_id == $adminUserId && $userRole  === 'admin')  
        ? '/chain-fortune/admin/dashboard'  
        : '/chain-fortune/dashboard';


    if ($insert->execute()) {
        $notification_message = "Deposit of \$" . number_format($amount, 0) ." in $cryptoSymbol is pending approval. Transaction ID: $transactionId, Please wait for Admin approval.";
        $notification_symbol = "https://cdn-icons-png.flaticon.com/512/10135/10135469.png";
    
        $insert_notification = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_notification);
        $stmt->bind_param("iss", $user_id, $notification_message, $notification_symbol);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
        if (
            isset($_SESSION['deposit_crypto_name']) ||
            isset($_SESSION['deposit_crypto_symbol']) ||
            isset($_SESSION['deposit_wallet_address']) ||
            isset($_SESSION['deposit_qr_code']) ||
            isset($_SESSION['deposit_amount']) ||
            isset($_SESSION['deposit_icon'])
        ) {
            unset(
                $_SESSION['deposit_crypto_name'],
                $_SESSION['deposit_crypto_symbol'],
                $_SESSION['deposit_wallet_address'],
                $_SESSION['deposit_qr_code'],
                $_SESSION['deposit_amount'],
                $_SESSION['deposit_icon']
            );
        }
        sendResponse('success', 'Deposit pending, please wait for admin approval.', $redirect);
    } else {
        sendResponse('error', 'Failed to log deposit. Please try again.');
    }
?>



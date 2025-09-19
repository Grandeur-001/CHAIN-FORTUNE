<?php
    ini_set('display_errors', 0); 
    ini_set('log_errors', 1);
    include "connection.php";
    header('Content-Type: application/json');
    require_once __DIR__ . '/vendor/autoload.php'; 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    function sendResponse($status, $message, $redirect = null) {
        ob_clean();
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'redirect' => $redirect
        ]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cryptoId = $_POST['crypto_id'] ?? null;
        $cryptoSymbol = $_POST['crypto_symbol'] ?? null;
        $walletAddress = trim($_POST['wallet_address'] ?? '');

        if (!$cryptoId || !$cryptoSymbol || !$walletAddress) {
            sendResponse('error', 'Missing required data.');
        }

        $stmt = $conn->prepare("SELECT * FROM currencies WHERE id = ? AND crypto_symbol = ?");
        $stmt->bind_param("is", $cryptoId, $cryptoSymbol);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            sendResponse('error', 'Cryptocurrency not found.');
        }
        $cryptoData = $result->fetch_assoc();

        $qrCodeFileName = null;
        $uploadDir = __DIR__ . '/code/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!empty($_FILES['qr_code']['tmp_name'])) {
            $file = $_FILES['qr_code']['tmp_name'];
            $originalFileName = basename($_FILES['qr_code']['name']);
            $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];

            if (!in_array($fileExtension, $allowedExtensions)) {
                sendResponse('error', 'Only PNG, JPG, JPEG, or WEBP QR codes are allowed.');
            }

            if ($_FILES['qr_code']['size'] > 2 * 1024 * 1024) {
                sendResponse('error', 'QR code image exceeds 2MB size limit.');
            }

            if (!empty($cryptoData['qr_code'])) {
                $oldQrPath = realpath($uploadDir . $cryptoData['qr_code']);
                if ($oldQrPath && file_exists($oldQrPath)) {
                    unlink($oldQrPath);
                }
            }

            $qrCodeFileName = strtolower($cryptoSymbol) . '_qr_' . time() . '.' . $fileExtension;
            $uploadPath = $uploadDir . $qrCodeFileName;

            if (!move_uploaded_file($file, $uploadPath)) {
                sendResponse('error', 'Failed to upload QR code image.');
            }
        }

        if ($qrCodeFileName) {
            $updateStmt = $conn->prepare("UPDATE currencies SET wallet_address = ?, qr_code = ? WHERE id = ?");
            $updateStmt->bind_param("ssi", $walletAddress, $qrCodeFileName, $cryptoId);
        } else {
            $updateStmt = $conn->prepare("UPDATE currencies SET wallet_address = ? WHERE id = ?");
            $updateStmt->bind_param("si", $walletAddress, $cryptoId);
        }

        if ($updateStmt->execute()) {
            sendResponse('success', 'Wallet updated successfully.', '/chain-fortune/admin/edit_wallet');
        } else {
            sendResponse('error', 'Failed to update wallet. Please try again.');
        }

        $stmt->close();
        $updateStmt->close();
    }else{
        sendResponse('error', 'Invalid request method.');
    }
?>

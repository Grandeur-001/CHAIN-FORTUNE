<?php
    ini_set('display_errors', 0); 
    ini_set('log_errors', 1);     
    session_start();
    header('Content-Type: application/json');

    require_once __DIR__ . '/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    include('connection.php');

    function sendResponse($status, $message, $redirect = null) {
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'redirect' => $redirect
        ]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = trim($_POST['user_id'] ?? '');
        $transactionId = trim($_POST['transaction_id'] ?? '');
        $amount = trim($_POST['amount'] ?? '');
        $cryptoSymbol = strtoupper(trim($_POST['crypto_symbol'] ?? ''));
        $status = trim($_POST['status'] ?? '');

        if (empty($userId) || empty($transactionId) || empty($amount) || empty($cryptoSymbol) || empty($status)) {
            sendResponse('error', 'Missing required fields.');
        }

        if (!is_numeric($amount) || $amount <= 0) {
            sendResponse('error', 'Invalid amount.');
        }

        $conn->begin_transaction();

        try {
            $txStmt = $conn->prepare("
                SELECT * FROM deposit_transactions
                WHERE transaction_id = ? LIMIT 1
            ");
            $txStmt->bind_param("s", $transactionId);
            $txStmt->execute();
            $txResult = $txStmt->get_result();

            if ($txResult->num_rows === 0) {
                $conn->rollback();
                sendResponse('error', 'Transaction not found.');
            }

            $txData = $txResult->fetch_assoc();

            if ($txData['status'] !== 'Pending') {
                $conn->rollback();
                sendResponse('error', 'Transaction already processed.');
            }

            $walletStmt = $conn->prepare("
                SELECT uw.amount AS user_balance
                FROM users_wallet uw
                JOIN currencies c ON uw.currency_id = c.id
                WHERE uw.user_id = ? AND c.crypto_symbol = ?
                LIMIT 1
            ");
            $walletStmt->bind_param("is", $userId, $cryptoSymbol);
            $walletStmt->execute();
            $walletResult = $walletStmt->get_result();

            if ($walletResult->num_rows === 0) {
                $conn->rollback();
                sendResponse('error', 'User wallet not found.');
            }

            $walletData = $walletResult->fetch_assoc();
            $newBalance = $walletData['user_balance'] + $amount;

            $updateTx = $conn->prepare("
                UPDATE deposit_transactions
                SET status = 'Approved'
                WHERE transaction_id = ?
            ");
            $updateTx->bind_param("s", $transactionId);
            if (!$updateTx->execute()) {
                $conn->rollback();
                sendResponse('error', 'Failed to update transaction status.');
            }

            $updateWallet = $conn->prepare("
                UPDATE users_wallet uw
                JOIN currencies c ON uw.currency_id = c.id
                SET uw.amount = ?
                WHERE uw.user_id = ? AND c.crypto_symbol = ?
            ");
            $updateWallet->bind_param("dis", $newBalance, $userId, $cryptoSymbol);
            if (!$updateWallet->execute()) {
                $conn->rollback();
                sendResponse('error', 'Failed to update user wallet.');
            }



            $conn->commit();


            $userStmt = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE user_id = ? LIMIT 1");
            $userStmt->bind_param("i", $userId);
            $userStmt->execute();
            $userResult = $userStmt->get_result();

            if ($userResult->num_rows === 0) {
                sendResponse('error', 'User not found for email notification.');
            }

            $user = $userResult->fetch_assoc();
            $fullName = htmlspecialchars($user['firstname'] . ' ' . $user['lastname']);
            $userEmail = htmlspecialchars($user['email']);
            $subject = 'Deposit Confirmed on Chain Fortune';

            $details = "
                <ul style='padding-left: 18px; margin-top: 15px; display: flex; flex-direction: column; gap: 10px;'>
                    <li style='margin-bottom:10px;'><strong>Transaction ID:</strong> {$txData['transaction_id']}</li>
                    <li style='margin-bottom:10px;'><strong>Amount:</strong> {$txData['amount']} USD in {$txData['crypto_symbol']}</li>
                    <li style='margin-bottom:10px;'><strong>Wallet Address:</strong> {$txData['wallet_address']}</li>
                    <li style='margin-bottom:10px;'><strong>Status:</strong> Confirmed</li>
                    <li style='margin-bottom:10px;'><strong>Date:</strong> " . date('F j, Y, g:i a', strtotime($txData['created_at'])) . "</li>
                </ul>
            ";
            $emailBody = "Your deposit has been successfully confirmed and credited to your wallet. You can find the transaction details below: $details";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($_ENV['MAIL_USERNAME'], 'Chain Fortune');
            $mail->addAddress($userEmail, $fullName);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = <<<HTML
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Chain Fortune Official Message</title>
                    <style>
                        @media only screen and (max-width: 600px) {
                            body { font-size: 14px; }
                            .container { width: 100% !important; padding: 10px !important; }
                        }
                    </style>
                </head>
                <body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #07070a; color: #e6e6ef;">
                    <table align="center" cellpadding="0" cellspacing="0" class="container" width="100%" style="max-width: 600px; background-color: #11121a; margin: 20px auto; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                        <tr>
                            <td align="center" style="padding: 40px 0 30px 0; border-bottom: 1px solid #222533;">
                                <img src="https://imghost.online/ib/WcbyDZGmGG5u5vH_1747394599.png" alt="Chain Fortune Logo" width="97" height="97" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 30px 30px;">
                                <h1 style="color: #5e63ff; font-size: 28px; text-align: center;">$subject</h1>
                                <p style="font-size: 16px; line-height: 1.6;">Dear {$user['firstname']} {$user['lastname']},</p>
                                <p style="font-size: 16px; line-height: 1.6;">$emailBody</p>
                                <br><br>
                                <p style="font-size: 13px; line-height: 1.6;">If you have any questions or concerns, please contact our <a href="mailto:support@chainfortune.com" style="color: #5e63ff; text-decoration: none; font-weight: bold; border-bottom: 1px solid #5e63ff;">support team</a>.</p>
                                <p style="font-size: 13px; line-height: 1.6;">Thank you for using Chain Fortune,</p>
                                <p style="font-size: 13px; font-weight: bold; color: #5e63ff;">Chain Fortune Admin Team</p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 25px 30px; background-color: #07070a; border-top: 1px solid #222533; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                <p style="font-size: 12px; color: #b0b3c1; text-align: center; margin: 0;">This is an official communication from Chain Fortune.</p>
                                <p style="font-size: 12px; color: #b0b3c1; text-align: center; margin: 10px 0 0;">© 2025 Chain Fortune. All rights reserved.</p>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
            HTML;


            $mail->AltBody = strip_tags($emailBody);
            $mail->send();


            $notification_message = " Your deposit transaction of \$" . number_format($amount, 2) . " in " . $cryptoSymbol . " has been approved, Transaction ID: " . $transactionId . " and your new $cryptoSymbol balance is \$". number_format($newBalance, 2) . ".";
            $notification_symbol = "https://cdn0.iconfinder.com/data/icons/approval-flat/60/Approve-Stamp-stamped-approved-passed-1024.png";
        
            $insert_notification = "INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_notification);
            $stmt->bind_param("iss", $userId, $notification_message, $notification_symbol);
            $stmt->execute();
            sendResponse('success', 'Deposit approved successfully.', '/chain-fortune/admin/dashboard');

        } catch (Exception $e) {
            $conn->rollback();
            sendResponse('error', 'Transaction failed: ' . $e->getMessage());
        }
    } else {
        sendResponse('error', 'Invalid request method.');
    }
?>

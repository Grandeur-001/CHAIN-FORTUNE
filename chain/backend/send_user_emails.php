<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

header('Content-Type: application/json');

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

include 'connection.php';

function sendResponse($status, $message, $redirect = null) {
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'redirect' => $redirect
    ]);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = trim($_POST['userId'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($userId) || empty($email) || empty($subject) || empty($message)) {
        sendResponse('error', 'All fields are required.');
    }

    $stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE user_id = ? AND email = ?");
    $stmt->bind_param('ss', $userId, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        sendResponse('error', 'User not found.');
    }

    $user = $result->fetch_assoc();
    $fullName = $user['firstname'] . ' ' . $user['lastname'];
    $dateSent = date('Y-m-d H:i:s');

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($_ENV['MAIL_USERNAME'], 'Chain Fortune');
        $mail->addAddress($email, $fullName);

        $mail->isHTML(true);
        $mail->Subject = $subject;

        $trackingPixel = "<img src='http://localhost/chain-fortune/action/track_opened_email?email=" . urlencode($email) . "&user_id=" . urlencode($userId) . "&subject=" . urlencode($subject) . "' width='1' height='1' style='display:none;'>";

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
            <body style="margin:0; padding:0; background:#07070a; color:#e6e6ef; font-family:Arial, Helvetica, sans-serif;">
                <table align="center" cellpadding="0" cellspacing="0" style="max-width:600px; margin:20px auto; background:#11121a; border-radius:12px;">
                    <tr>
                        <td align="center" style="padding:40px 0; border-bottom:1px solid #222533;">
                            <img src="https://imghost.online/ib/WcbyDZGmGG5u5vH_1747394599.png" width="97" height="97" alt="Chain Fortune Logo">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;">
                            <h1 style="color:#5e63ff; font-size:28px; text-align:center;">$subject</h1>
                            <p>Dear {$user['firstname']} {$user['lastname']},</p>
                            <p>$message</p>
                            <br>
                            <p style="font-size:13px;">We value your continued support. If you have any questions, contact our <a href="mailto:support@chainfortune.com" style="color:#5e63ff;">support team</a>.</p>
                            <p style="font-size:13px;">Thank you,<br><strong style="color:#5e63ff;">Chain Fortune Admin Team</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px; background:#07070a; text-align:center; font-size:12px; color:#b0b3c1;">
                            This is an official communication from Chain Fortune.<br>
                            &copy; 2025 Chain Fortune. All rights reserved.
                        </td>
                    </tr>
                </table>
                $trackingPixel
            </body>
            </html>
        HTML;

        $mail->AltBody = strip_tags($message);

        if ($mail->send()) {
            $status = 'Delivered';
            $insert = $conn->prepare("INSERT INTO email_tracking (user_id, recipient, subject, delivery_status, checked, clicks, date_sent) VALUES (?, ?, ?, ?, 0, 0, ?)");
            $insert->bind_param("sssss", $userId, $email, $subject, $status, $dateSent);
            $insert->execute();

            sendResponse('success', "Email sent to $fullName successfully.", "/chain-fortune/admin/users");
        } else {
            throw new Exception('Failed to send.');
        }

    } catch (Exception $e) {
        $status = 'Failed';
        $insert = $conn->prepare("INSERT INTO email_tracking (user_id, recipient, subject, delivery_status, checked, clicks, date_sent) VALUES (?, ?, ?, ?, 0, 0, ?)");
        $insert->bind_param("sssss", $userId, $email, $subject, $status, $dateSent);
        $insert->execute();

        sendResponse('error', 'Mailer Error: ' . $mail->ErrorInfo);
    }
} else {
    sendResponse('error', 'Invalid request method.');
}


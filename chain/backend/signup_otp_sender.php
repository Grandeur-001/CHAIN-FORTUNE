<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

header('Content-Type: application/json');

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

include 'connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    if(!isset($data['user_id']) || empty($data['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User ID is required.']);
        exit;
    }
    if (!isset($data['email']) || empty($data['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
        exit;
    }

    $email = urldecode(trim($data['email']));
    $userId = urldecode(trim($data['user_id']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        exit;
    }

    $otp = random_int(100000, 999999);
    $expires_at = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($_ENV['MAIL_DEFAULT_SENDER'], 'Chain Fortune');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Your OTP Code for Chain Fortune Login, $email";
        $mail->Body = <<<HTML
            <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Chain Fortune OTP Verification</title>
                        <style>
                            @media only screen and (max-width: 600px) {{
                                body {{
                                    font-size: 14px;
                                }}
                                .container {{
                                    width: 100% !important;
                                    padding: 10px !important;
                                }}
                            }}
                        </style>
                    </head>
                    <body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #07070a; color: #e6e6ef;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="container" width="100%" style="max-width: 600px; background-color: #11121a; margin: 20px auto; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                            <tr>
                                <td align="center" style="padding: 40px 0 30px 0; border-bottom: 1px solid #222533;">
                                    <img src="https://i.postimg.cc/5NwmTC8L/logo-2.png" alt="Chain Fortune Logo" width="180" height="60" style="display: block; border: 0;" />
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 30px 30px;">
                                    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #5e63ff; margin-top: 0; font-size: 28px; text-align: center; letter-spacing: 0.5px;">Welcome to Chain Fortune!</h1>
                                    
                                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px; color: #e6e6ef;">Thank you for signing up! We are excited to have you join our platform.</p>
                                    
                                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px; color: #e6e6ef;">To complete your registration and confirm your identity, please use the One-Time Password (OTP) below:</p>
                                    
                                    <div style="background-color: #222533; border: 1px solid #42434a; border-radius: 12px; padding: 25px; margin: 30px 0; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                        <p style="font-size: 14px; color: #b0b3c1; margin: 0 0 15px 0;">Your OTP Code:</p>
                                        <h2 style="font-family: 'Courier New', monospace; font-size: 36px; letter-spacing: 8px; margin: 0; color: #5e63ff; font-weight: bold; text-shadow: 0 0 10px rgba(94, 99, 255, 0.3);">$otp</h2>
                                        <p style="font-size: 12px; color: #b0b3c1; margin: 15px 0 0 0;">This code will expire in 10 minutes</p>
                                    </div>
                                    
                                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px; color: #e6e6ef;">This OTP is valid for a limited time, so be sure to enter it promptly. If you did not request this OTP or if you believe this is a mistake, please disregard this email.</p>
                                    
                                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 30px; color: #e6e6ef;">If you have any issues or need further assistance, feel free to reach out to our <a href="support@chainfortune.com" style="color: #5e63ff; text-decoration: none; font-weight: bold; border-bottom: 1px solid #5e63ff;">support team</a>.</p>
                                    
                                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 5px; color: #e6e6ef;">Best regards,</p>
                                    <p style="font-size: 16px; line-height: 1.6; font-weight: bold; margin-top: 0; color: #5e63ff;">The Chain Fortune Team</p>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 25px 30px; background-color: #07070a; border-top: 1px solid #222533; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <p style="font-size: 12px; color: #b0b3c1; text-align: center; margin: 0;">If you did not request this, please ignore this email.</p>
                                    <p style="font-size: 12px; color: #b0b3c1; text-align: center; margin: 10px 0 0 0;">© 2025 Chain Fortune. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>
        HTML;
        $mail->AltBody = "Your OTP code is: $otp";
        $mail->send();


        $deleteStmt = $conn->prepare("DELETE FROM verification_codes WHERE email = ? AND purpose = 'signup'");
        $deleteStmt->bind_param("s", $email);
        $deleteStmt->execute();
        $deleteStmt->close();

        $stmt = $conn->prepare("INSERT INTO verification_codes (email, code, created_at, expires_at, purpose) VALUES (?, ?, NOW(), ?, 'signup')");
        $stmt->bind_param("sss", $email, $otp, $expires_at);
        $stmt->execute();
        $stmt->close();


        $adminUserId = trim($_ENV['ADMIN_USER_ID']); 
        $admin_id = $adminUserId;
        $message = "Signup OTP sent to $userId: - $email: - " . $otp;
        $icon = "https://sbma.comitatensian.com/assets/OTP.b3204a71.png";
    
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, message, notification_symbol) VALUES (?, ?, ?)");
        if (!$stmt) {
            error_log("Notification insert prepare failed: " . $conn->error);
            sendResponse('error', 'Internal error');
        }
        $stmt->bind_param("iss", $admin_id, $message, $icon);
        if (!$stmt->execute()) {
            error_log("Notification insert failed: " . $stmt->error);
            sendResponse('error', 'Internal error');
        } 
        $stmt->close();

        echo json_encode(['status' => 'success', 'message' => 'OTP sent and saved.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send email: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

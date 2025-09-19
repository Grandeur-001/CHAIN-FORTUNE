<?php
session_start();
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

    if (!isset($data['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
        exit;
    }

    $email = urldecode(trim($data['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'No account found with this email.']);
        exit;
    }

    $token = bin2hex(random_bytes(32));
    $resetLink = "http://localhost/chain-fortune/auth/reset_password?token=$token";
    $expiresAt = date("Y-m-d H:i:s", strtotime("+30 minutes"));

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
        $mail->Subject = "Password Reset Request";
        $mail->Body = <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Chain Fortune | Reset Password Link</title>
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
                                <img src="https://freeimghost.net/i/logo-2.x8tiMq" alt="Chain Fortune Logo" width="180" height="60" style="display: block; border: 0;" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 30px 30px;">
                                <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #5e63ff; margin-top: 0; font-size: 28px; text-align: center; letter-spacing: 0.5px;">Hello, Welcome to Chain Fortune!</h1>
                                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px; color: #e6e6ef;">You requested to reset your password. Click the button below to proceed:</p>
                                <div style="background-color: #222533; border: 1px solid #42434a; border-radius: 12px; padding: 25px; margin: 30px 0; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                    <p style="font-size: 14px; color: #b0b3c1; margin: 0 0 15px 0;">Your Password Reset Link:</p>
                                    <br>
                                    <a href="$resetLink" style="display:inline-block;padding:12px 24px;background-color:#5e63ff;color:white;border-radius:6px;text-decoration:none;">Reset Password</a>
                                    <br><br>
                                    <p style="font-size: 12px; color: #b0b3c1; margin: 15px 0 0 0;">This link will expire in 20 minutes</p>
                                </div>
                                
                                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px; color: #e6e6ef;">This Link is valid for a limited time, so be sure to use it promptly. If you did not request this link or if you believe this is a mistake, please disregard this email.</p>
                                
                                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 30px; color: #e6e6ef;">If you have any issues or need further assistance, feel free to reach out to our <a href="support@chainfortune.com" style="color: #5e63ff; text-decoration: none; font-weight: bold; border-bottom: 1px solid #5e63ff;">support team</a>.</p>
                                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 5px; color: #e6e6ef;">Thank you for being a part of our community!</p>
                                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 5px; color: #e6e6ef;">Best regards,</p>
                                <p style="font-size: 16px; line-height: 1.6; font-weight: bold; margin-top: 0; color: #5e63ff;">Chain Fortune</p>
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
        $mail->AltBody = "Reset your password here: $resetLink";

        $mail->send();
        
        $deleteStmt = $conn->prepare("DELETE FROM password_reset_token WHERE email = ?");
        $deleteStmt->bind_param("s", $email);
        $deleteStmt->execute();
    
        $insertStmt = $conn->prepare("INSERT INTO password_reset_token (email, reset_link, created_at, expires_at) VALUES (?, ?, NOW(), ?)");
        $insertStmt->bind_param("sss", $email, $token, $expiresAt);
        $insertStmt->execute();
        $insertStmt->close();
        
        echo json_encode(['status' => 'success', 'message' => 'Password reset link sent.Please check your email.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send email: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

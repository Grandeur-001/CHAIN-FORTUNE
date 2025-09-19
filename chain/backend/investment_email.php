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

    $user_id = $_POST['user_id'] ?? '';
    $message = $_POST['message'] ?? '';
    $subject = $_POST['subject'] ?? 'Investment Update';


    if (!$user_id || !$message) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
        exit;
    }

    $user = $result->fetch_assoc();
    $email = $user['email'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($_ENV['MAIL_DEFAULT_SENDER'], 'Chain Fortune');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "$subject | Chain Fortune, $email";
        
        $mail->Body = $message;
        $mail->AltBody = $message;

        $mail->send();

        echo json_encode(['status' => 'success', 'message' => 'Investment email sent successfully.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Mail error: ' . $mail->ErrorInfo]);
    }
}else{
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
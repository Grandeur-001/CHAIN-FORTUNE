<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

header('Content-Type: application/json');

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

include 'connection.php';

function sendResponse($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['message']) || !isset($data['user_id'])) {
        sendResponse('error', 'Missing message or user_id');
    }

    $message = trim($data['message']);
    $user_id = intval($data['user_id']);

    if (!$message || !$user_id) {
        sendResponse('error', 'Invalid message or user_id');
    }

    $stmt = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        sendResponse('error', 'User not found');
    }


    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $email = $user['email'];

    $emailBody = "
        <h3>🚨 User Activity Alert</h3>
        <p>{$message}</p>
        <h4>User's Basic Details:</h4>
        <ul>
            <li><strong>Firstname:</strong> {$firstname}</li>
            <li><strong>Lastname:</strong> {$lastname}</li>
            <li><strong>Email:</strong> {$email}</li>
        </ul>
    ";

    $plainText = "{$message}\n\nUser's Basic Details:\nFirstname: {$firstname}\nLastname: {$lastname}\nEmail: {$email}";

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
        $mail->Subject = "User Activity";
        $mail->Body = $emailBody;
        $mail->AltBody = $plainText;

        $mail->send();
        sendResponse('success', 'Email sent successfully');
    } catch (Exception $e) {
        sendResponse('error', 'Email sending failed: ' . $mail->ErrorInfo);
    }
}else{
    sendResponse('error', 'Invalid request method');
} 
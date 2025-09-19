<?php
include 'connection.php';

function createUserWalletsBatch($userId, $conn) {
    $currenciesQuery = "SELECT id FROM currencies";
    $currenciesResult = $conn->query($currenciesQuery);

    if ($currenciesResult && $currenciesResult->num_rows > 0) {
        $values = [];
        $params = [];

        while ($currency = $currenciesResult->fetch_assoc()) {
            $values[] = "(?, ?, 0)";
            $params[] = $userId;
            $params[] = $currency['id'];
        }

        $sql = "INSERT INTO users_wallet (user_id, currency_id, amount) VALUES " . implode(",", $values);
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $types = str_repeat("ii", count($params) / 2);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Batch insert failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
    } else {
        error_log("No currencies found in the database.");
        return false;
    }
}

function is_password_strong($password) {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    return preg_match($pattern, $password);
}

function sendResponse($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    http_response_code(200);
    flush();
    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $conf_pass = $_POST['confirm_password'];

    if (!$firstname || !$lastname || !$email || !$password || !$conf_pass) {
        sendResponse('error', "All fields are required!");
        return;
    }

    if (strlen($firstname) > 50 || strlen($lastname) > 50) {
        sendResponse('error', "First name or Last name is too long!");
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendResponse('error', "Invalid email format.");
        return;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        sendResponse('error', "Server error during email check.");
        return;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        sendResponse('error', "Email already in use!");
        return;
    }
    $stmt->close();

    if ($password !== $conf_pass) {
        sendResponse('error', "Passwords do not match!");
        return;
    }

    if (!is_password_strong($password)) {
        sendResponse('error', "Password must include at least 1 uppercase, 1 lowercase, 1 number, 1 symbol, and be 8+ characters.");
        return;
    }

    $options = ['cost' => 12];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    do {
        $user_id = random_int(1000000000000000, 9999999999999999);
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            sendResponse('error', "Server error during user ID generation.");
            return;
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
    } while ($exists);

    $role = 'user';
    $date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO users (user_id, firstname, lastname, email, password, role, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        sendResponse('error', "Server error during user creation.");
        return;
    }

    $stmt->bind_param("issssss", $user_id, $firstname, $lastname, $email, $hashedPwd, $role, $date);

    if ($stmt->execute()) {
        $stmt->close();

        if (!createUserWalletsBatch($user_id, $conn)) {
            sendResponse('error', "User created, but failed to set up wallets.");
            return;
        }

        sendResponse('success', "User successfully created!");
        return;
    } else {
        error_log("Insert failed: " . $stmt->error);
        $stmt->close();
        sendResponse('error', "Unexpected error occurred, please try again.");
        return;
    }
}
?>

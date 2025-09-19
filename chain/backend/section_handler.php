<?php
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'use_strict_mode' => true,
        'cookie_samesite' => 'Strict'
    ]);
    include('connection.php');
    require_once __DIR__ . '/vendor/autoload.php'; 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $adminUserId = trim($_ENV['ADMIN_USER_ID']); 
    
    function hard_die() {
        session_unset();
        session_destroy();
        exit(<<<HTML
            <!DOCTYPE html>
            <html>
            <head>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <style>
                    * {
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                    }
                    body { margin: 0; background: #000; color: #fff; }
                    .swal2-popup {
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
                    }
                </style>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Session Expired',
                        text: 'Session timeout or expired. Please login again.',
                        background: '#1e1e1e',
                        confirmButtonColor: '#4caf50',
                        color: '#ffffff',
                        confirmButtonText: 'Login',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/chain-fortune/auth/login';
                        }
                    });
                </script>
            </body>
            </html>
        HTML);
        exit();
    }

    if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
        $_SESSION['attempted_url'] = $_SERVER['REQUEST_URI'];
        hard_die();
        session_unset();
        session_destroy();

    }

    if (!isset($_SESSION['user_agent']) || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']){
        hard_die();
    }
    if (!isset($_SESSION['user_ip']) || $_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']){
        hard_die();
    } 
    if (!isset($_SESSION['session_token'])){
        hard_die();
    } 

    $user_id = $_SESSION['user_id'];
    $sessionToken = $_SESSION['session_token'];

    $stmt = $conn->prepare("SELECT session_token FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        session_unset();
        session_destroy();
        hard_die(); 
    }

    $row = $result->fetch_assoc();
    $dbToken = $row['session_token'] ?? null;
    
    if (!$dbToken || $dbToken !== $sessionToken) {
        session_unset();
        session_destroy();
        hard_die();
    }
    $stmt->close();

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
        ? $timeout = 4200  
        : $timeout = 86400;
    
    

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        session_unset();
        session_destroy();
        hard_die();
    }
    $_SESSION['last_activity'] = time();
?>

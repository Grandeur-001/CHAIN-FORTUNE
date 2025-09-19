<?php

if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}


session_start([
    'cookie_lifetime' => 0,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
    'cookie_samesite' => 'Strict'
]);


$_SESSION = [];
session_unset();

if (session_id()) {
    session_regenerate_id(true);
}

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        [
            'expires' => time() - 42000,
            'path' => $params["path"],
            'domain' => $params["domain"],
            'secure' => $params["secure"],
            'httponly' => $params["httponly"],
            'samesite' => 'Strict'
        ]
    );
}

session_destroy();

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

echo json_encode([
    'status' => 'success',
    'message' => 'You have logged out successfully'
]);
exit;

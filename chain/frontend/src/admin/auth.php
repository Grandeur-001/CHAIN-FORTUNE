<?php
session_start(); 

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== '1003948576293846') {
    header("Location: /chain-fortune/dashboard"); 
    exit();
}


define('EXPECTED_USER_ID', '1003948576293846');

define('SESSION_TIMEOUT', 1800);

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== EXPECTED_USER_ID) {
    error_log("Unauthorized access attempt on " . $_SERVER['PHP_SELF'] . " by user_id: " . ($_SESSION['user_id'] ?? 'unknown'));
    session_unset();
    session_destroy();
    
    header("Location: /chain-fortune/page/home");
    exit();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
    session_unset();
    session_destroy();
    
    header("Location: /chain-fortune/page/home");
    exit();
}

$_SESSION['last_activity'] = time();

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}


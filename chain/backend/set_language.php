<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $language = $_POST['language'] ?? '';
    
    if ($language) {
        $_SESSION['selected_language'] = $language;
        
        echo json_encode(['success' => true, 'language' => $language]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No language provided']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
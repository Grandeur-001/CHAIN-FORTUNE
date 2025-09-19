<?php
    require __DIR__ . '/vendor/autoload.php';

    use Dotenv\Dotenv;

    header('Content-Type: application/json');

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    include 'connection.php'; 

    $site_name = $_ENV['SITE_NAME'];
    $adminUserId = $_ENV['ADMIN_USER_ID'];
?>
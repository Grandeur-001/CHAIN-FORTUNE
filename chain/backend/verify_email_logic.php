<?php

    function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; 
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    $ip = getUserIP();
    $geoURL = "http://ip-api.com/json/{$ip}?fields=country";
    $response = file_get_contents($geoURL);
    $data = json_decode($response, true);
    $country = $data['country'] ?? 'Unknown';
    echo "User country: " . $country;

?>
<?php
/*
 * CORS afhandeling
 * Afhandelen van de eerste controlle request van de browser
 */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

// Aansturen welke PHP-script de request verder moet afhandelen

// Hier begint het echte werk van de API
header('Access-Control-Allow-Origin: *');   // De browser dat dit een legitieme request is
header('Content-Type: application/json');   // Verteld de client/browser in welke format de data teruggestuurd is
echo json_encode([
    'name' => 'Voorbeeld',
    'email' => 'voorbeeld@test.com'
]);
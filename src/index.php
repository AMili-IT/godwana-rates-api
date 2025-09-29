<?php
require_once __DIR__ . '/helpers.php';

header('Content-Type: application/json');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// POST request for /api/rates
if ($uri === '/api/rates' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    // Transform the payload if needed (your helper function)
    $payload = transformPayload($input); // Make sure this exists in helpers.php
    $response = callRemoteAPI($payload); // Make sure this exists in helpers.php

    echo json_encode($response);
    exit;
}

// Optional: GET request for quick testing
if ($uri === '/api/rates' && $method === 'GET') {
    echo json_encode([
        'status' => 'ok',
        'message' => 'Rates API is working'
    ]);
    exit;
}

// Endpoint not found
http_response_code(404);
echo json_encode(['error' => 'Endpoint not found']);

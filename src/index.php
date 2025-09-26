<?php
require_once __DIR__ . '/helpers.php';

header('Content-Type: application/json');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/api/rates' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    $payload = transformPayload($input);
    $response = callRemoteAPI($payload);
    echo json_encode($response);
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Endpoint not found']);

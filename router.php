<?php
$uri = $_SERVER['REQUEST_URI'];

if ($uri !== '/' && file_exists(__DIR__ . parse_url($uri, PHP_URL_PATH))) {
    return false;
}

require __DIR__ . '/../src/index.php';

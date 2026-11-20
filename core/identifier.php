<?php

$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/pt2/index.php');
define('BASE_URL', rtrim(dirname($scriptPath), '/.') . '/');

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function money($value) {
    return 'RM ' . number_format((float) $value, 2);
}

function abortRequest($status, $message) {
    http_response_code($status);
    header('Content-Type: text/plain; charset=UTF-8');
    exit($message);
}

function redirectTo($route) {
    header('Location: ' . BASE_URL . $route, true, 303);
    exit;
}

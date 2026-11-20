<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

require_once __DIR__ . '/core/controller.php';
require_once __DIR__ . '/core/database.php';
require_once __DIR__ . '/core/identifier.php';

$_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));
$route = trim((string) ($_GET['url'] ?? ''), '/');

try {
    if ($route === '') {
        $connection = (new Database())->getConnection();
        $counts = [];
        foreach (['products', 'customers', 'staffs', 'orders'] as $table) {
            $counts[$table] = (int) $connection->query("SELECT COUNT(*) FROM tbl_{$table}_a223536")->fetchColumn();
        }
        require __DIR__ . '/views/home.php';
        return;
    }

    [$controllerName, $action, $id] = array_pad(explode('/', $route, 3), 3, null);
    $action ??= 'index';
    $allowed = ['productcontroller', 'customercontroller', 'staffcontroller', 'ordercontroller', 'orderdetailcontroller'];
    $actions = ['index', 'save', 'edit', 'update', 'delete'];
    if ($controllerName === 'ordercontroller') {
        $actions[] = 'invoice';
    }

    $needsId = in_array($action, ['edit', 'delete', 'invoice'], true)
        || ($action === 'index' && $controllerName === 'orderdetailcontroller');
    if (!in_array($controllerName, $allowed, true) || !in_array($action, $actions, true)
        || ($needsId ? ($id === null || $id === '' || str_contains($id, '/')) : $id !== null)
        || ($needsId && in_array($controllerName, ['ordercontroller', 'orderdetailcontroller'], true)
            && (!ctype_digit($id) || (int) $id < 1 || (int) $id > 2147483647))) {
        abortRequest(404, 'Page not found.');
    }

    $write = in_array($action, ['save', 'update', 'delete'], true);
    if ($_SERVER['REQUEST_METHOD'] !== ($write ? 'POST' : 'GET')) {
        header('Allow: ' . ($write ? 'POST' : 'GET'));
        abortRequest(405, 'Method not allowed.');
    }
    if ($write && !hash_equals($_SESSION['csrf_token'], (string) ($_POST['csrf_token'] ?? ''))) {
        abortRequest(403, 'This form expired. Reload the page and try again.');
    }

    require __DIR__ . "/controllers/$controllerName.php";
    $controller = new $controllerName();
    $needsId ? $controller->$action($id) : $controller->$action();
} catch (PDOException $exception) {
    if ($exception->getCode() === '23000') {
        abortRequest(409, 'The record ID already exists or the record is in use.');
    }
    error_log($exception->getMessage());
    abortRequest(500, 'The database request could not be completed.');
}

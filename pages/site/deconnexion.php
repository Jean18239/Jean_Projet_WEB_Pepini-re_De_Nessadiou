<?php
require_once __DIR__ . '/../../config/routes.php';

session_start();

$return = $_GET['return'] ?? ($_SERVER['HTTP_REFERER'] ?? '');
$fallback = route_url('home');

if (is_string($return) && strpos($return, BASE_URL . '/') === 0) {
    $redirect = $return;
} else {
    $redirect = $fallback;
}

session_destroy();

header('Location: ' . $redirect);
exit();
?>

<?php
$rootPath = dirname(__DIR__);

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', $rootPath);
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/' . basename($rootPath));
}
?>

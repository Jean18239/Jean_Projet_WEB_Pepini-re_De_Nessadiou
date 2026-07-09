<?php
require_once __DIR__ . '/../config/routes.php';

function path_starts_with(string $value, string $prefix): bool
{
    return substr($value, 0, strlen($prefix)) === $prefix;
}

function path_ends_with(string $value, string $suffix): bool
{
    if ($suffix === '') {
        return true;
    }

    return substr($value, -strlen($suffix)) === $suffix;
}

$basePath = rtrim(BASE_URL, '/') . '/';
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';

if (!path_starts_with($requestPath, $basePath)) {
    http_response_code(404);
    echo 'Not found';
    exit();
}

$path = urldecode(substr($requestPath, strlen($basePath)));
$path = trim($path, '/');

if (isset($_GET['route']) && is_string($_GET['route'])) {
    $path = ltrim(urldecode($_GET['route']), '/');
}

if (path_starts_with($path, 'index.php/')) {
    $path = substr($path, strlen('index.php/'));
}

$path = trim($path, '/');

if ($path === '') {
    $path = 'index.php';
}

$routes = [
    '' => ROOT_PATH . '/pages/site/index.php',
    'index.php' => ROOT_PATH . '/pages/site/index.php',
    'catalogue/nos-arbres' => ROOT_PATH . '/pages/site/nos-arbres.php',
    'catalogue/nos-fruitiers' => ROOT_PATH . '/pages/site/nos-fruitiers.php',
    'catalogue/nos-saisonniers' => ROOT_PATH . '/pages/site/nos-saisonniers.php',
    'panier' => ROOT_PATH . '/pages/site/commande.php',
    'compte/login' => ROOT_PATH . '/pages/site/login.php',
    'compte/inscription' => ROOT_PATH . '/pages/site/inscription.php',
    'compte/logout' => ROOT_PATH . '/pages/site/logout.php',
    'compte/deconnexion' => ROOT_PATH . '/pages/site/deconnexion.php',
    'compte/commandes' => ROOT_PATH . '/pages/admin/suivi-commandes.php',
    'atelier' => ROOT_PATH . '/pages/site/atelier.php',
    'atelier/traitement' => ROOT_PATH . '/pages/site/traitement-atelier.php',
    'admin/commandes' => ROOT_PATH . '/pages/admin/admin-commandes.php',
    'admin/ajouter-commandes' => ROOT_PATH . '/pages/admin/ajouter-commandes.php',
    'produits/ananas' => ROOT_PATH . '/pages/produits/ananas.php',
    'produits/bananier' => ROOT_PATH . '/pages/produits/bananier.php',
    'produits/baominia' => ROOT_PATH . '/pages/produits/baominia.php',
    'produits/bois-noir-caledonien' => ROOT_PATH . '/pages/produits/bois-noir-caledonien.php',
    'produits/bois-noir-haiti' => ROOT_PATH . '/pages/produits/bois-noir-haiti.php',
    'produits/burao' => ROOT_PATH . '/pages/produits/burao.php',
    'produits/citronnier' => ROOT_PATH . '/pages/produits/citronnier.php',
    'produits/gaiac' => ROOT_PATH . '/pages/produits/gaiac.php',
    'produits/gaiac-grosse-feuille' => ROOT_PATH . '/pages/produits/gaiac-grosse-feuille.php',
    'produits/manguier' => ROOT_PATH . '/pages/produits/manguier.php',
    'produits/oranger' => ROOT_PATH . '/pages/produits/oranger.php',
    'produits/packai' => ROOT_PATH . '/pages/produits/packai.php',
    'produits/papayer' => ROOT_PATH . '/pages/produits/papayer.php',
    'produits/santal' => ROOT_PATH . '/pages/produits/santal.php',
];

$legacyRoutes = [
    'public/index.php' => 'index.php',
    'public/nos-arbres.php' => 'catalogue/nos-arbres',
    'public/nos-fruitiers.php' => 'catalogue/nos-fruitiers',
    'public/nos-saisonniers.php' => 'catalogue/nos-saisonniers',
    'public/panier.php' => 'panier',
    'public/commande.php' => 'panier',
    'public/login.php' => 'compte/login',
    'public/inscription.php' => 'compte/inscription',
    'public/logout.php' => 'compte/logout',
    'public/deconnexion.php' => 'compte/deconnexion',
    'public/suivi-commandes.php' => 'compte/commandes',
    'public/atelier.php' => 'atelier',
    'public/traitement-atelier.php' => 'atelier/traitement',
    'public/admin-commandes.php' => 'admin/commandes',
    'public/ajouter-commandes.php' => 'admin/ajouter-commandes',
    'public/ananas.php' => 'produits/ananas',
    'public/bananier.php' => 'produits/bananier',
    'public/baominia.php' => 'produits/baominia',
    'public/bois-noir-caledonien.php' => 'produits/bois-noir-caledonien',
    'public/bois-noir-haiti.php' => 'produits/bois-noir-haiti',
    'public/burao.php' => 'produits/burao',
    'public/citronnier.php' => 'produits/citronnier',
    'public/gaiac.php' => 'produits/gaiac',
    'public/gaiac-grosse-feuille.php' => 'produits/gaiac-grosse-feuille',
    'public/manguier.php' => 'produits/manguier',
    'public/oranger.php' => 'produits/oranger',
    'public/packai.php' => 'produits/packai',
    'public/papayer.php' => 'produits/papayer',
    'public/santal.php' => 'produits/santal',
    'nos-arbres.php' => 'catalogue/nos-arbres',
    'nos-fruitiers.php' => 'catalogue/nos-fruitiers',
    'nos-saisonniers.php' => 'catalogue/nos-saisonniers',
];

if (isset($legacyRoutes[$path])) {
    $path = $legacyRoutes[$path];
}

$target = $routes[$path] ?? '';
$realTarget = $target ? realpath($target) : false;
$rootDir = realpath(ROOT_PATH);

if (!$realTarget || !$rootDir || !path_starts_with($realTarget, $rootDir) || !is_file($realTarget)) {
    http_response_code(404);
    echo 'Not found';
    exit();
}

http_response_code(200);
require $realTarget;

<?php
require_once __DIR__ . '/paths.php';

function route_path(string $name): string
{
    $routes = [
        'home' => 'index.php',
        'catalogue.arbres' => 'catalogue/nos-arbres',
        'catalogue.fruitiers' => 'catalogue/nos-fruitiers',
        'catalogue.saisonniers' => 'catalogue/nos-saisonniers',
        'panier' => 'panier',
        'login' => 'compte/login',
        'inscription' => 'compte/inscription',
        'logout' => 'compte/logout',
        'deconnexion' => 'compte/deconnexion',
        'atelier' => 'atelier',
        'traitement_atelier' => 'atelier/traitement',
        'admin.commandes' => 'admin/commandes',
        'admin.ajouter_commandes' => 'admin/ajouter-commandes',
        'admin.suivi_commandes' => 'compte/commandes',
    ];

    return $routes[$name] ?? $name;
}

function route_url(string $name): string
{
    $path = ltrim(route_path($name), '/');

    if ($path === '' || $path === 'index.php') {
        return BASE_URL . '/';
    }

    return BASE_URL . '/' . $path;
}
?>

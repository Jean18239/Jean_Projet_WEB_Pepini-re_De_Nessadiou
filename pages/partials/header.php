<?php
require_once __DIR__ . '/../../config/routes.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentUri = $_SERVER['REQUEST_URI'] ?? route_url('home');
?>
<header class="site-header">
  <a href="<?php echo route_url('home'); ?>" class="site-brand">
    <img src="<?php echo BASE_URL; ?>/assets/images/Pépinière de Nessadiou.png" class="logo" alt="Pépinière de Nessadiou">
    <span>Pépinière de Nessadiou</span>
  </a>
  <p>Bienvenue dans notre pépinière écologique en Nouvelle-Calédonie</p>
</header>

<nav class="site-nav">
  <a href="<?php echo route_url('home'); ?>">Accueil</a>
  <a href="<?php echo route_url('catalogue.arbres'); ?>">Arbres</a>
  <a href="<?php echo route_url('catalogue.fruitiers'); ?>">Fruitiers</a>
  <a href="<?php echo route_url('catalogue.saisonniers'); ?>">Saisonniers</a>

  <?php if (isset($_SESSION['client'])) { ?>
    <a href="<?php echo route_url('panier'); ?>">Mon panier</a>
    <span class="nav-user">Bonjour <?php echo htmlspecialchars($_SESSION['client']['prenom'], ENT_QUOTES, 'UTF-8'); ?></span>
    <a href="<?php echo route_url('logout'); ?>?return=<?php echo urlencode($currentUri); ?>">Déconnexion</a>
  <?php } else { ?>
    <a href="<?php echo route_url('login'); ?>">Connexion</a>
    <a href="<?php echo route_url('inscription'); ?>">Inscription</a>
  <?php } ?>
</nav>

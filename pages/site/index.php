<?php
session_start();
require_once __DIR__ . '/../../config/routes.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>

<body class="home-page">

<?php require __DIR__ . '/../partials/header.php'; ?>

<section class="hero">
  <div class="hero-content">
    <h1>Plantation et Nature</h1>
    <p>Plants locaux, fruitiers et espèces adaptées au climat de Nouvelle-Calédonie.</p>
    <a href="#produits" class="btn-white">Découvrir les produits</a>
  </div>
</section>

<div class="container">

<section class="section">
  <h2>À propos de la pépinière</h2>
  <p>
    La Pépinière de Nessadiou est un lieu dédié à l'agriculture durable situé avant Bourail.
    Nous produisons des plants locaux adaptés au climat de Nouvelle-Calédonie,
    dans le respect de l’environnement.
  </p>
</section>

<section class="section" id="produits">
  <h2>Nos produits</h2>

  <div class="cards">

    <div class="card">
      <h3>Arbres</h3>
      <p>Arbres adaptés au climat local.</p>
      <a href="<?php echo route_url('catalogue.arbres'); ?>" class="btn">🌳 Voir les arbres communs</a>
    </div>

    <div class="card">
      <h3>Arbres fruitiers</h3>
      <p>Production locale de fruits.</p>
      <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">🍊 Voir les arbres fruitiers</a>
    </div>

    <div class="card">
      <h3>Arbres saisonniers</h3>
      <p>Plantes selon les saisons.</p>
      <a href="<?php echo route_url('catalogue.saisonniers'); ?>" class="btn">🍃 Voir les arbres saisonniers</a>
    </div>

  </div>
</section>

<section class="section" id="contact">
  <h2>Contact</h2>
  <p>Email : pascalrobertmph@lagoon.nc</p>
  <p>Téléphone : +687 75 14 66</p>
</section>

<!-- Carte Google Maps -->
<section class="section" id="carte">
  <h2>Notre terrain</h2>
  <div class="carte-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d584759.1219592873!2d165.6589868069066!3d-21.93427846278117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e0!4m5!1s0x6c28080a5f0e1375%3A0xad5a867f3f30dd9d!2s25%20Rue%20des%20Promeneurs%2C%20Noum%C3%A9a%2098800%2C%20Nouvelle-Cal%C3%A9donie!3m2!1d-22.242169999999998!2d166.47643499999998!4m3!3m2!1d-21.6393423!2d165.4956852!5e1!3m2!1sfr!2sus!4v1778532984948!5m2!1sfr!2sus"
      class="map-frame"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>

</div> <!-- fin du container -->

<?php require __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>

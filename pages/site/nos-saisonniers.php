<?php
session_start();
require_once __DIR__ . '/../../config/connexion.php';
require_once __DIR__ . '/catalogue.php';

$pageUrl = route_url('catalogue.saisonniers');
$dbDisponible = $conn instanceof mysqli;

if ($dbDisponible) {
  gerer_actions_catalogue($conn, $pageUrl);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Nos Arbres Saisonniers</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/catalogue.css">
</head>
<body class="page-catalogue catalogue-saisonniers">

<?php require __DIR__ . '/../partials/header.php'; ?>
<?php afficher_messages_catalogue(); ?>

<section class="catalogue-heading">
  <h1>🌿 Nos Arbres Saisonniers</h1>
  <p>Découvrez nos plantes adaptées aux saisons de Nouvelle-Calédonie</p>
</section>

<div class="container">

<?php
if (!$dbDisponible) {
    echo "<p class='catalogue-message'>La base de données n'est pas disponible. Vérifie que MySQL est lancé et que la base nessadiou existe.</p>";
} else {
    $sql = "SELECT * FROM produits WHERE type = 'saisonnier'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            afficher_carte_produit($row, $pageUrl);
        }
    } else {
        echo "<p class='catalogue-message'>Aucun arbre saisonnier disponible</p>";
    }
}
?>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

<?php
require_once __DIR__ . '/../../config/routes.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Inscription Atelier</title>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/atelier.css">
</head>

<body class="page-atelier">

<div class="atelier-card">

<h1>📚 Inscription Atelier</h1>

<form action="<?php echo route_url('traitement_atelier'); ?>" method="POST">

<input type="text" name="nom" placeholder="Nom" required>

<input type="text" name="prenom" placeholder="Prénom" required>

<input type="email" name="email" placeholder="Adresse mail" required>

<input type="text" name="telephone" placeholder="Numéro de téléphone" required>

<button type="submit">
    Valider l'inscription
</button>

</form>

    <a href="<?php echo route_url('home'); ?>" class="btn-retour">← Retour</a>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

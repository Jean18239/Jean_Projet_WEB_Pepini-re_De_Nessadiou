<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Baominia</title>
</head>

<body class="fiche-produit">

  <!-- En-tête avec le nom de l'arbre -->
  <header>
    <h1>Baominia</h1>
  </header>

  <!-- Photo illustrative du Baominia -->
  <img src="<?php echo BASE_URL; ?>/assets/images/baominia.jpg" alt="Baominia">

  <div class="content">

    <!-- Nom scientifique de l'espèce en italique -->
    <h2>Nom scientifique</h2>
    <p><i>Bauhinia spp</i></p>

    <!-- Description botanique et usage ornemental de l'arbre -->
    <h2>Description</h2>
    <p>
      Le Baominia est un arbre ornemental apprécié pour ses belles fleurs colorées et décoratives. Il pousse bien dans
      les climats tropicaux et subtropicaux. Cet arbre est souvent utilisé pour embellir les jardins et les espaces
      publics.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

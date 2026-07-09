<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Burao</title>
</head>

<body class="fiche-produit">
  <!-- En-tête avec le nom de l'arbre -->
  <header>
    <h1>Burao</h1>
  </header>

  <!-- Photo illustrative du Burao -->
  <img src="<?php echo BASE_URL; ?>/assets/images/burao.webp" alt="Burao">

  <div class="content">

    <!-- Nom scientifique de l'espèce en italique -->
    <h2>Nom scientifique</h2>
    <p><i>Hibiscus tiliaceus</i></p>

    <!-- Description botanique, habitat côtier et usages du Burao -->
    <h2>Description</h2>
    <p>
      Le Burao est un arbre tropical que l'on trouve souvent en bord de mer. Il est apprécié pour sa résistance aux
      vents et aux sols salins. Ses feuilles et son bois sont utilisés dans certaines pratiques artisanales, et il
      contribue à la stabilisation des sols côtiers.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>
  </div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Santal</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit">

  <!-- En-tête avec le nom de l'arbre en majuscules -->
  <header>
    <h1>SANTAL</h1>
  </header>

  <!-- Photo illustrative du Santal -->
  <img src="<?php echo BASE_URL; ?>/assets/images/santal.webp" alt="Santal">

  <div class="content">

    <!-- Nom scientifique de l'espèce endémique de Nouvelle-Calédonie en italique -->
    <h2>Nom scientifique</h2>
    <p><i>Santalum austrocaledonicum</i></p>

    <!-- Description botanique : valeur économique, usage en parfumerie et habitat naturel -->
    <h2>Description</h2>
    <p>
      Le santal est un arbre précieux de Nouvelle-Calédonie. Il est connu pour son bois parfumé
      utilisé en parfumerie et en médecine traditionnelle. Il pousse principalement dans les zones sèches.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

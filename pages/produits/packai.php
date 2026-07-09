<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Packaï - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-packai">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Packaï</h1>
  </header>

  <!-- Photo illustrative du Packai -->
  <img src="<?php echo BASE_URL; ?>/assets/images/packai.webp" alt="Packai">

  <div class="container">

    <!-- Nom scientifique de l'espèce en gras -->
    <h2>Nom scientifique</h2>
    <p><strong>Inga edulis</strong></p>

    <!-- Description botanique : origine, fruit, usage en agroforesterie et adaptation climatique -->
    <h2>Description</h2>
    <p>
      Le packaï (Inga edulis) est un arbre tropical originaire d'Amérique du Sud,
      aujourd'hui très répandu en Nouvelle-Calédonie. Il produit de longues gousses
      contenant une pulpe blanche sucrée au goût proche de la vanille.

      Cet arbre est très utilisé en agroforesterie, car il améliore la fertilité des sols
      grâce à sa capacité à fixer l'azote. Il offre également de l'ombre, ce qui protège
      les autres cultures.

      Le packaï est apprécié à la fois pour ses fruits et pour ses avantages écologiques.
      Il pousse rapidement et s'adapte bien aux climats tropicaux.
    </p>

    <!-- Résumé court des besoins en climat, sol et exposition -->
    <h2>Conditions de culture</h2>
    <p>
      Climat chaud, sol bien drainé, exposition ensoleillée.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

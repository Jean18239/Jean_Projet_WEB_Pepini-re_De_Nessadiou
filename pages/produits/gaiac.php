<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gaïac</title>
</head>

<body class="fiche-produit">

  <!-- En-tête avec le nom de l'arbre -->
  <header>
    <h1>Gaïac</h1>
  </header>

  <!-- Photo illustrative du Gaïac -->
  <img src="<?php echo BASE_URL; ?>/assets/images/gaiac.jpg" alt="Gaïac">

  <div class="content">

    <h2>Nom scientifique</h2>
    <p><i>Guaiacum sanctum</i></p>

    <!-- Description de la dureté du bois et de son statut de rareté -->
    <h2>Description</h2>
    <p>
      Le Gaïac est un arbre réputé pour son bois extrêmement dur et dense. Il est utilisé dans la fabrication d'objets
      résistants et durables. Cet arbre pousse lentement et est souvent protégé en raison de sa rareté.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

</body>

</html>

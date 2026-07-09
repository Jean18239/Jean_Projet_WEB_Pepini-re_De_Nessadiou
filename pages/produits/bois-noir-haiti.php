<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Bois Noir Haïti</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit">

  <!-- En-tête avec le nom de l'arbre -->
  <header>
    <h1>Bois Noir Haïti</h1>
  </header>

  <!-- Photo illustrative (nom de fichier basé sur le nom scientifique Samanea saman) -->
  <img src="<?php echo BASE_URL; ?>/assets/images/samanea_saman.jpg" alt="Bois Noir Haïti">

  <div class="content">

    <!-- Nom scientifique de l'espèce en italique -->
    <h2>Nom scientifique</h2>
    <p><i>Samenea saman</i></p>

    <!-- Description botanique : origine géographique, propriétés du bois et usage traditionnel -->
    <h2>Description</h2>
    <p>
      Originaire d'Amérique centrale et des Caraïbes, cet arbre est connu pour son bois riche en pigments naturels. Il a
      longtemps été utilisé pour la teinture textile. C'est un arbre résistant qui peut s'adapter à différents types de
      sols tropicaux.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

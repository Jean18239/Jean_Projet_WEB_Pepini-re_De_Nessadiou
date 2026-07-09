<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gaïac Grosse Feuille</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit">

  <!-- En-tête avec le nom de l'arbre -->
  <header>
    <h1>Gaïac Grosse Feuille</h1>
  </header>

  <!-- Photo illustrative du Gaïac Grosse Feuille (format webp) -->
  <img src="<?php echo BASE_URL; ?>/assets/images/Guaiacum-sanctum-Lignum-Vitae.jpg" alt="Gaïac Grosse Feuille">

  <div class="content">

    <!-- Nom scientifique de l'espèce en italique -->
    <h2>Nom scientifique</h2>
    <p><i>Guaiacum officinale</i></p>

    <!-- Description complète : origine, propriétés du bois, aspect, floraison et statut de protection -->
    <h2>Description</h2>
    <p>
      Le gaïac est un arbre tropical originaire des Caraïbes et d'Amérique centrale. Il est particulièrement connu pour
      son bois extrêmement dur, dense et résistant, souvent appelé « bois de vie ». Ce bois possède des propriétés
      naturelles d'auto-lubrification, ce qui le rend très recherché pour des usages techniques et artisanaux.

      Le gaïac pousse lentement et peut atteindre une dizaine de mètres de hauteur. Il produit de belles fleurs bleues
      ou violettes, ainsi que des fruits jaunes caractéristiques. En raison de sa surexploitation passée, cet arbre est
      aujourd'hui protégé dans plusieurs régions du monde.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

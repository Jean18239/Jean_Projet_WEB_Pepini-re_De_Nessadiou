<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Citronnier - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-citronnier">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Citronnier</h1>
  </header>

  <!-- Photo illustrative du Citronnier -->
  <img src="<?php echo BASE_URL; ?>/assets/images/citronnier.webp" alt="Citronnier">

  <div class="container">

    <!-- Nom scientifique de l'espèce en gras -->
    <h2>Nom scientifique</h2>
    <p><strong>Citrus limon</strong></p>

    <!-- Description botanique, usages culinaires, médicinaux et cosmétiques du citronnier -->
    <h2>Description</h2>
    <p>
      Le citronnier (Citrus limon) est un arbre fruitier très populaire, connu pour produire des citrons,
      des fruits acides riches en vitamine C. Il appartient également à la famille des Rutacées et
      s'adapte bien aux climats tropicaux et subtropicaux.

      Cet arbre possède un feuillage persistant et peut produire des fruits presque toute l'année
      dans de bonnes conditions. Les citrons sont utilisés en cuisine pour leur goût acidulé, mais
      aussi pour leurs propriétés antiseptiques et digestives.

      Le citronnier est aussi utilisé dans les domaines médicinal et cosmétique. Il nécessite
      un bon ensoleillement et un sol bien drainé pour se développer correctement.
    </p>

    <!-- Résumé court des besoins en climat, sol et exposition -->
    <h2>Conditions de culture</h2>
    <p>
      Climat chaud, sol drainé, exposition ensoleillée.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

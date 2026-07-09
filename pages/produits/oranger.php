<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Oranger - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-oranger">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Oranger</h1>
  </header>

  <!-- Photo illustrative du Oranger -->
  <img src="<?php echo BASE_URL; ?>/assets/images/oranger.webp" alt="Oranger">

  <div class="container">

    <!-- Nom scientifique de l'espèce en gras -->
    <h2>Nom scientifique</h2>
    <p><strong>Citrus sinensis</strong></p>

    <!-- Description botanique : famille, feuillage, floraison, valeurs nutritives et usages -->
    <h2>Description</h2>
    <p>
      L'oranger (Citrus sinensis) est un arbre fruitier appartenant à la famille des Rutacées.
      Il est largement cultivé dans les régions chaudes et ensoleillées pour ses fruits : les oranges.
      Ces fruits sont riches en vitamine C, en antioxydants et en fibres, ce qui en fait un aliment
      très bénéfique pour la santé.

      L'oranger peut atteindre plusieurs mètres de hauteur et possède un feuillage persistant,
      ce qui signifie qu'il garde ses feuilles toute l'année. Ses fleurs blanches, appelées fleurs d'oranger,
      dégagent un parfum agréable et sont souvent utilisées en parfumerie.

      Les oranges peuvent être consommées fraîches, en jus ou utilisées dans de nombreuses préparations
      culinaires. Cet arbre est très apprécié pour sa production abondante et régulière.
    </p>

    <!-- Résumé court des besoins en climat, ensoleillement et sol -->
    <h2>Conditions de culture</h2>
    <p>
      Climat chaud, ensoleillement important, sol bien drainé.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

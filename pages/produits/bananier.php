<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Bananier - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-bananier">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Bananier</h1>
  </header>

  <!-- Photo illustrative du Bananier -->
  <img src="<?php echo BASE_URL; ?>/assets/images/bananier.jpg" alt="Bananier">

  <div class="container">

    <!-- Nom scientifique de l'espèce -->
    <h2>Nom scientifique</h2>
    <p><strong>Musa spp.</strong></p>

    <!-- Description botanique, morphologie et usage du bananier -->
    <h2>Description</h2>
    <p>
      Le bananier (Musa spp.) est une plante herbacée tropicale, souvent confondue avec un arbre.
      Il est cultivé pour ses fruits : les bananes, qui sont riches en glucides, en potassium et en vitamines.

      Le bananier pousse rapidement et peut atteindre plusieurs mètres de hauteur. Il est composé
      d'un pseudo-tronc formé par l'enroulement de ses feuilles. Chaque plant produit généralement
      un seul régime de bananes avant de se renouveler.

      Les bananes sont très consommées dans le monde entier, aussi bien crues que cuites.
      Le bananier est une plante essentielle dans les régions tropicales, notamment en Nouvelle-Calédonie.
    </p>

    <!-- Résumé court des besoins en climat, sol et arrosage -->
    <h2>Conditions de culture</h2>
    <p>
      Climat chaud et humide, sol riche, arrosage régulier.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

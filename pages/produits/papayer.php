<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Papayer - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-papayer">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Papayer</h1>
  </header>

  <!-- Photo illustrative du Papayer -->
  <img src="<?php echo BASE_URL; ?>/assets/images/papayer.jpg" alt="Papayer">

  <div class="container">

    <!-- Nom scientifique de l'espèce en gras -->
    <h2>Nom scientifique</h2>
    <p><strong>Carica papaya</strong></p>

    <!-- Description botanique : famille, morphologie particulière, valeurs nutritives et production -->
    <h2>Description</h2>
    <p>
      Le papayer (Carica papaya) est une plante tropicale qui produit des papayes, des fruits sucrés
      et riches en nutriments. Il appartient à la famille des Caricacées et pousse rapidement
      dans les régions chaudes.

      Contrairement aux arbres classiques, le papayer possède un tronc creux et peu de branches.
      Les fruits poussent directement sur le tronc, ce qui le rend facilement reconnaissable.

      La papaye est riche en vitamines A, C et en enzymes digestives comme la papaïne,
      qui aide à la digestion. Elle est consommée fraîche, en jus ou en dessert.
      Le papayer produit des fruits toute l'année dans de bonnes conditions.
    </p>

    <!-- Résumé court des besoins en climat, sol et arrosage -->
    <h2>Conditions de culture</h2>
    <p>
      Climat chaud, sol riche, arrosage régulier.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

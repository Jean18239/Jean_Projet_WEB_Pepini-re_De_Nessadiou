<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Manguier - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-manguier">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Manguier</h1>
  </header>

  <!-- Photo illustrative du Manguier -->
  <img src="<?php echo BASE_URL; ?>/assets/images/manguier.webp" alt="Manguier">

  <div class="container">

    <!-- Nom scientifique de l'espèce en gras -->
    <h2>Nom scientifique</h2>
    <p><strong>Mangifera indica</strong></p>

    <!-- Description botanique, longévité, floraison, valeurs nutritives et adaptation climatique -->
    <h2>Description</h2>
    <p>
      Le manguier (Mangifera indica) est un grand arbre tropical appartenant à la famille des Anacardiacées.
      Il est cultivé pour ses fruits : les mangues, connues pour leur chair sucrée, juteuse et parfumée.

      Cet arbre peut vivre plusieurs dizaines d'années et atteindre une grande taille.
      Il produit des fleurs en grappes, qui donnent ensuite des fruits très appréciés dans de nombreux pays.

      Les mangues sont riches en vitamines A et C, et sont consommées fraîches, en jus,
      ou utilisées dans diverses recettes. Le manguier est parfaitement adapté aux climats chauds
      et nécessite beaucoup de soleil.
    </p>

    <!-- Résumé court des besoins en climat, exposition et sol -->
    <h2>Conditions de culture</h2>
    <p>
      Climat chaud, exposition ensoleillée, sol bien drainé.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ananas - Pépinière de Nessadiou</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fiche-produit.css">
</head>

<body class="fiche-produit fiche-fruitier produit-ananas">

  <!-- En-tête avec le nom du fruitier -->
  <header>
    <h1>Ananas</h1>
  </header>

  <!-- Photo illustrative de l'ananas -->
  <img src="<?php echo BASE_URL; ?>/assets/images/ananas.jpg" alt="Ananas">

  <div class="container">

    <!-- Nom scientifique de l'espèce -->
    <h2>Nom scientifique</h2>
    <p><strong>Ananas comosus</strong></p>

    <!-- Description botanique et conditions climatiques de l'ananas -->
    <h2>Description</h2>
    <p>
      L'ananas, de nom scientifique Ananas comosus, est une plante tropicale vivace de la famille des broméliacées,
      reconnaissable à sa rosette de longues feuilles rigides et parfois épineuses, et à son fruit unique formé par la
      fusion de plusieurs petits fruits. Il pousse principalement dans les régions chaudes, avec un climat tropical ou
      subtropical, où les températures se situent idéalement entre 20 et 30°C, car il ne supporte pas le gel. Sa culture
      se fait généralement à partir de la couronne du fruit ou de rejets,
      et la production d'un fruit prend environ 12 à 24 mois.
    </p>

    <!-- Informations sur les besoins en sol, soleil et arrosage -->
    <h2>Conditions de culture</h2>
    <p>
      Cette plante a besoin de beaucoup de soleil et d'un sol léger, bien drainé et légèrement acide, riche en matière
      organique. L'arrosage doit être modéré, car l'ananas résiste assez bien à la sécheresse mais craint l'excès d'eau
      qui peut provoquer la pourriture.
    </p>

    <!-- Bouton de retour vers la liste des fruitiers -->
    <a href="<?php echo route_url('catalogue.fruitiers'); ?>" class="btn">← Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

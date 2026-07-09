<?php require_once __DIR__ . '/../../config/routes.php'; // Page PHP - Pépinière de Nessadiou ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Bois Noir Caledonien</title>
</head>

<body class="fiche-produit">

  <!-- En-tête avec le nom de l'arbre -->
  <header>
    <h1>Bois Noir Caledonien</h1>
  </header>

  <!-- Photo illustrative du Bois Noir Calédonien -->
  <img src="<?php echo BASE_URL; ?>/assets/images/bois_noir_caledonien.jpg" alt="Bois Noir Calédonien">

  <div class="content">

    <!-- Nom scientifique de l'espèce en italique -->
    <h2>Nom scientifique</h2>
    <p><i>Acacia spirorbis</i></p>

    <!-- Description botanique, rôle écologique et usage local de l'arbre -->
    <h2>Description</h2>
    <p>
      Le bois noir calédonien est un arbre endémique de Nouvelle-Calédonie. Il est particulièrement adapté aux sols
      pauvres et secs. Il joue un rôle important dans la reforestation et la protection des sols grâce à sa capacité à
      fixer l'azote. Son bois est utilisé localement pour divers usages.
    </p>

    <!-- Lien de retour vers la liste des arbres -->
    <a href="<?php echo route_url('catalogue.arbres'); ?>">⬅ Retour</a>

  </div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>

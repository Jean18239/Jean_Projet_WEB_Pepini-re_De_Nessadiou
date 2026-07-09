<?php
// Inclut le fichier de connexion à la base de données
require_once __DIR__ . '/../../config/connexion.php';
// Démarre la session pour accéder aux données du client connecté
session_start();
 
// Vérifie que le client est connecté — sinon redirige vers la connexion
if (!isset($_SESSION['client'])) {
    header("Location: " . route_url('login'));
    exit();
}
 
// Récupère l'ID du client connecté depuis la session
$client_id = $_SESSION['client']['id'];
 
// Récupère toutes les commandes du client avec le nom du produit associé
// Jointure entre commandes et produits pour afficher le nom du produit
$stmt = $conn->prepare(
    "SELECT c.id, p.nom AS produit_nom, p.image, c.quantite, c.statut, c.date_commande
     FROM commandes c
     JOIN produits p ON c.produit_id = p.id
     WHERE c.client_id = ?
     ORDER BY c.date_commande DESC"
);
$stmt->bind_param("i", $client_id);
$stmt->execute();
// Stocke tous les résultats dans un tableau
$commandes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Commandes - Pépinière de Nessadiou</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/commandes.css">
</head>
<body class="page-commandes">
 
<header>
    <h1>Pépinière de Nessadiou</h1>
</header>
 
<nav>
    <a href="<?php echo route_url('home'); ?>">Accueil</a>
    <!-- Lien vers la page de suivi des commandes (page courante) -->
    <a href="<?php echo route_url('admin.suivi_commandes'); ?>">Mes commandes</a>
    <a href="<?php echo route_url('logout'); ?>?return=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Déconnexion</a>
</nav>
 
<div class="container">
 
    <!-- Titre de la page avec le prénom du client -->
    <h2>Mes commandes — <?php echo $_SESSION['client']['prenom']; ?></h2>
 
    <?php if (empty($commandes)) { ?>
 
        <!-- Message si le client n'a encore passé aucune commande -->
        <div class="aucune-commande">
            <p>Vous n'avez encore passé aucune commande.</p>
            <a href="<?php echo route_url('home'); ?>" class="btn">Voir nos produits</a>
        </div>
 
    <?php } else { ?>
 
        <!-- Tableau listant toutes les commandes du client -->
        <table class="table-commandes">
            <thead>
                <tr>
                    <th>#</th>             <!-- Numéro de commande -->
                    <th>Produit</th>       <!-- Image + nom du produit -->
                    <th>Quantité</th>      <!-- Quantité commandée -->
                    <th>Date</th>          <!-- Date de la commande -->
                    <th>Statut</th>        <!-- Statut coloré -->
                </tr>
            </thead>
            <tbody>
 
            <?php foreach ($commandes as $cmd) {
 
                // Détermine la classe CSS du badge selon le statut
                $badge_class = match($cmd['statut']) {
                    'En cours'        => 'badge-encours',
                    'En préparation'  => 'badge-preparation',
                    'En livraison'    => 'badge-livraison',
                    'Livré'           => 'badge-livre',
                    default           => 'badge-encours'
                };
            ?>
                <tr>
                    <!-- Numéro de commande -->
                    <td><?php echo $cmd['id']; ?></td>
 
                    <!-- Image miniature + nom du produit -->
                    <td>
                        <?php if (!empty($cmd['image'])) { ?>
                            <img src="<?php echo $cmd['image']; ?>"
                                 alt="<?php echo $cmd['produit_nom']; ?>">
                        <?php } ?>
                        <span class="cell-product">
                            <?php echo $cmd['produit_nom']; ?>
                        </span>
                    </td>
 
                    <!-- Quantité commandée -->
                    <td><?php echo $cmd['quantite']; ?></td>
 
                    <!-- Date formatée en français -->
                    <td><?php echo date("d/m/Y à H:i", strtotime($cmd['date_commande'])); ?></td>
 
                    <!-- Badge de statut coloré -->
                    <td>
                        <span class="badge <?php echo $badge_class; ?>">
                            <?php echo $cmd['statut']; ?>
                        </span>
                    </td>
                </tr>
 
            <?php } // Fin foreach commandes ?>
 
            </tbody>
        </table>
 
    <?php } ?>
 
</div>
 
<footer>
    <p>&copy; 2026 Pépinière de Nessadiou</p>
</footer>
 
<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

<?php
// Inclut le fichier de connexion à la base de données
require_once __DIR__ . '/../../config/connexion.php';
// Démarre la session pour vérifier le rôle admin
session_start();
 
// Vérifie que l'utilisateur est connecté ET qu'il est admin — sinon bloque l'accès
if (!isset($_SESSION['client']) || $_SESSION['client']['role'] !== 'admin') {
    die("<p class='access-denied'>Accès refusé — réservé aux administrateurs.</p>");
}
 
// -------------------------------------------------------
// MISE À JOUR DU STATUT (soumis via le formulaire admin)
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commande_id'], $_POST['statut'])) {
 
    // Liste des statuts autorisés pour éviter toute valeur invalide
    $statuts_autorises = ['En cours', 'En préparation', 'En livraison', 'Livré'];
 
    // Vérifie que le statut envoyé fait partie des valeurs autorisées
    if (in_array($_POST['statut'], $statuts_autorises)) {
 
        $commande_id = (int) $_POST['commande_id'];
        $nouveau_statut = $_POST['statut'];
 
        // Met à jour le statut de la commande en base
        $stmt = $conn->prepare("UPDATE commandes SET statut = ? WHERE id = ?");
        $stmt->bind_param("si", $nouveau_statut, $commande_id);
        $stmt->execute();
 
        // -------------------------------------------------------
        // ENVOI DU MAIL AU CLIENT pour l'informer du changement
        // -------------------------------------------------------
 
        // Récupère l'email et le prénom du client lié à cette commande
        $info = $conn->prepare(
            "SELECT cl.email, cl.prenom, p.nom AS produit_nom
             FROM commandes c
             JOIN clients cl ON c.client_id = cl.id
             JOIN produits p ON c.produit_id = p.id
             WHERE c.id = ?"
        );
        $info->bind_param("i", $commande_id);
        $info->execute();
        $row = $info->get_result()->fetch_assoc();
 
        if ($row) {
            $to      = $row['email'];
            $subject = "Mise à jour de votre commande - " . $row['produit_nom'];
 
            $message  = "Bonjour " . $row['prenom'] . ",\n\n";
            $message .= "Le statut de votre commande a été mis à jour.\n\n";
            $message .= "Produit  : " . $row['produit_nom'] . "\n";
            $message .= "Statut   : " . $nouveau_statut . "\n";
            $message .= "Date     : " . date("d/m/Y à H:i") . "\n\n";
            $message .= "Merci de votre confiance,\n";
            $message .= "La Pépinière de Nessadiou\n";
 
            $headers  = "From: noreply@nessadiou.nc\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
 
            // Envoie le mail de notification au client
            mail($to, $subject, $message, $headers);
        }
    }
}
 
// -------------------------------------------------------
// RÉCUPÉRATION DE TOUTES LES COMMANDES
// -------------------------------------------------------
 
// Récupère toutes les commandes avec infos client et produit
$result = $conn->query(
    "SELECT c.id, c.quantite, c.statut, c.date_commande,
            cl.prenom, cl.nom, cl.email,
            p.nom AS produit_nom, p.image
     FROM commandes c
     JOIN clients cl ON c.client_id = cl.id
     JOIN produits p ON c.produit_id = p.id
     ORDER BY c.date_commande DESC"
);
// Stocke toutes les commandes dans un tableau
$commandes = $result->fetch_all(MYSQLI_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin — Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/commandes.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/admin.css">
</head>
<body class="page-commandes">
 
<header>
    <h1>Administration — Commandes</h1>
</header>
 
<nav>
    <a href="<?php echo route_url('home'); ?>">Accueil</a>
    <a href="<?php echo route_url('logout'); ?>?return=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Déconnexion</a>
</nav>
 
<div class="container">
 
    <h2>Liste de toutes les commandes</h2>
 
    <?php if (empty($commandes)) { ?>
 
        <!-- Aucune commande en base -->
        <p class="empty-note">Aucune commande enregistrée pour le moment.</p>
 
    <?php } else { ?>
 
        <!-- Tableau listant toutes les commandes avec formulaire de changement de statut -->
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>           <!-- ID commande -->
                    <th>Produit</th>     <!-- Image + nom -->
                    <th>Client</th>      <!-- Prénom, nom, email -->
                    <th>Qté</th>         <!-- Quantité -->
                    <th>Date</th>        <!-- Date de commande -->
                    <th>Statut actuel</th><!-- Badge statut -->
                    <th>Changer statut</th><!-- Formulaire de mise à jour -->
                </tr>
            </thead>
            <tbody>
 
            <?php foreach ($commandes as $cmd) {
 
                // Détermine la classe CSS du badge selon le statut actuel
                $badge_class = match($cmd['statut']) {
                    'En cours'        => 'badge-encours',
                    'En préparation'  => 'badge-preparation',
                    'En livraison'    => 'badge-livraison',
                    'Livré'           => 'badge-livre',
                    default           => 'badge-encours'
                };
            ?>
                <tr>
                    <!-- ID de la commande -->
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
 
                    <!-- Informations du client -->
                    <td>
                        <?php echo $cmd['prenom'] . ' ' . $cmd['nom']; ?><br>
                        <small class="text-muted"><?php echo $cmd['email']; ?></small>
                    </td>
 
                    <!-- Quantité commandée -->
                    <td><?php echo $cmd['quantite']; ?></td>
 
                    <!-- Date de la commande formatée -->
                    <td><?php echo date("d/m/Y H:i", strtotime($cmd['date_commande'])); ?></td>
 
                    <!-- Badge du statut actuel -->
                    <td>
                        <span class="badge <?php echo $badge_class; ?>">
                            <?php echo $cmd['statut']; ?>
                        </span>
                    </td>
 
                    <!-- Formulaire de changement de statut pour cette commande -->
                    <td>
                        <form method="POST" class="status-form">
 
                            <!-- Champ caché contenant l'ID de la commande -->
                            <input type="hidden" name="commande_id"
                                   value="<?php echo $cmd['id']; ?>">
 
                            <!-- Menu déroulant des statuts disponibles -->
                            <select name="statut" class="statut-select">
                                <option value="En cours"
                                    <?php echo $cmd['statut'] == 'En cours'       ? 'selected' : ''; ?>>
                                    En cours
                                </option>
                                <option value="En préparation"
                                    <?php echo $cmd['statut'] == 'En préparation' ? 'selected' : ''; ?>>
                                    En préparation
                                </option>
                                <option value="En livraison"
                                    <?php echo $cmd['statut'] == 'En livraison'   ? 'selected' : ''; ?>>
                                    En livraison
                                </option>
                                <option value="Livré"
                                    <?php echo $cmd['statut'] == 'Livré'          ? 'selected' : ''; ?>>
                                    Livré
                                </option>
                            </select>
 
                            <!-- Bouton de validation du changement de statut -->
                            <button type="submit" class="btn-update">Mettre à jour</button>
 
                        </form>
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

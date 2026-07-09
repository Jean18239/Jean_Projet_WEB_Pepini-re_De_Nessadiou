<?php
// Si la date est stockée en UTC
$dateUtc = new DateTime('2026-07-01 04:49:00', new DateTimeZone('UTC'));
$dateLocale = $dateUtc->setTimezone(new DateTimeZone('Pacific/Noumea'));

date_default_timezone_set('Pacific/Noumea');

session_start();
require_once __DIR__ . '/../../config/connexion.php';

// sécurité : client connecté obligatoire
if (!isset($_SESSION['client'])) {
    header("Location: " . route_url('login'));
    exit();
}

$client_id = $_SESSION['client']['id'];

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_quantity') {
        $commandeId = (int) ($_POST['commande_id'] ?? 0);
        $quantite = max(1, (int) ($_POST['quantite'] ?? 1));
        $stmt = $conn->prepare("UPDATE commandes SET quantite = ? WHERE id = ? AND client_id = ?");
        $stmt->bind_param("iii", $quantite, $commandeId, $client_id);
        $stmt->execute();
    }

    if ($action === 'delete_item') {
        $commandeId = (int) ($_POST['commande_id'] ?? 0);
        $stmt = $conn->prepare("DELETE FROM commandes WHERE id = ? AND client_id = ?");
        $stmt->bind_param("ii", $commandeId, $client_id);
        $stmt->execute();
    }

    if ($action === 'clear_cart') {
        $stmt = $conn->prepare("DELETE FROM commandes WHERE client_id = ?");
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
    }

    header("Location: " . route_url('panier'));
    exit();
}

/* =========================
   RECUPERATION COMMANDES
========================= */
$sql = "
    SELECT 
        c.id AS commande_id,
        c.quantite,
        c.statut,
        c.date_commande,
        p.nom,
        p.prix,
        p.image
    FROM commandes c
    JOIN produits p ON c.produit_id = p.id
    WHERE c.client_id = ?
    ORDER BY c.id DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mon panier</title>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/commandes.css">
</head>

<body class="page-commandes">

<?php require __DIR__ . '/../partials/header.php'; ?>

<section class="page-title">
    <h1>Mon panier</h1>
    <p>Gérez vos quantités avant validation par la pépinière.</p>
</section>

<div class="container">

<?php if ($result->num_rows === 0) { ?>
    <div class="empty-state">
        <p>Votre panier est vide pour le moment.</p>
        <a href="<?php echo route_url('catalogue.arbres'); ?>" class="btn">Voir les produits</a>
    </div>
<?php } else { ?>

<form method="POST" class="clear-cart-form" onsubmit="return confirm('Vider tout le panier ?');">
    <input type="hidden" name="action" value="clear_cart">
    <button type="submit" class="btn-danger">Vider le panier</button>
</form>

<table class="table-panier">

<tr>
    <th>ID</th>
    <th>Produit</th>
    <th>Quantité</th>
    <th>Statut</th>
    <th>Date</th>
    <th>Prix total (XPF)</th>
    <th>Actions</th>
</tr>

<?php
$total_general = 0;

while ($row = $result->fetch_assoc()) {

    $prix_total = $row['prix'] * $row['quantite'];
    $total_general += $prix_total;
?>

<tr>
    <td><?= $row['commande_id'] ?></td>
    <td>
        <span class="cell-product">
            <?php if (!empty($row['image'])) { ?>
                <?php $image_path = $row['image']; if (strpos($image_path, 'http') !== 0 && strpos($image_path, '/') !== 0) { $image_path = BASE_URL . '/assets/images/' . basename($image_path); } ?>
                <img src="<?= htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8') ?>">
            <?php } ?>
            <?= htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8') ?>
        </span>
    </td>
    <td>
        <form method="POST" class="cart-action-form">
            <input type="hidden" name="action" value="update_quantity">
            <input type="hidden" name="commande_id" value="<?= $row['commande_id'] ?>">
            <input type="number" name="quantite" min="1" value="<?= $row['quantite'] ?>">
            <button type="submit">Modifier</button>
        </form>
    </td>
    <td><?= htmlspecialchars($row['statut'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= date("d/m/Y H:i", strtotime($row['date_commande'])) ?></td>
    <td class="total"><?= $prix_total ?> XPF</td>
    <td>
        <form method="POST">
            <input type="hidden" name="action" value="delete_item">
            <input type="hidden" name="commande_id" value="<?= $row['commande_id'] ?>">
            <button type="submit" class="btn-danger">Supprimer</button>
        </form>
    </td>
</tr>

<?php } ?>

<!-- TOTAL GLOBAL -->
<tr>
    <td colspan="5"><strong>Total général</strong></td>
    <td class="total"><?= $total_general ?> XPF</td>
    <td></td>
</tr>

</table>
<?php } ?>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

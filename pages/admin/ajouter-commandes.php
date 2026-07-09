<?php
session_start();
require_once __DIR__ . '/../../config/connexion.php';

// sécurité : client connecté obligatoire
if (!isset($_SESSION['client'])) {
    header("Location: " . route_url('login'));
    exit();
}

$client_id  = $_SESSION['client']['id'];
$produit_id = $_POST['produit_id'];
$quantite   = $_POST['quantite'];

// insertion SQL
$sql = "INSERT INTO commandes (client_id, produit_id, quantite)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $client_id, $produit_id, $quantite);

if ($stmt->execute()) {
    header("Location: " . route_url('panier'));
    exit();
} else {
    echo "Erreur SQL : " . $conn->error;
}
?>

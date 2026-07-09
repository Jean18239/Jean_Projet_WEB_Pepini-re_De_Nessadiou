-- ============================================================
-- maj_commandes.sql
-- Mise à jour de la table commandes pour le système de suivi
-- À exécuter dans phpMyAdmin ou en ligne de commande
-- ============================================================
USE nessadiou;
-- Supprime l'ancienne table commandes et la recrée proprement
DROP TABLE IF EXISTS commandes;
-- Nouvelle table commandes avec tous les champs nécessaires
CREATE TABLE commandes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  client_id INT NOT NULL,
  -- Référence au client connecté
  produit_id INT NOT NULL,
  -- Référence au produit commandé
  quantite INT NOT NULL DEFAULT 1,
  -- Quantité commandée
  statut ENUM(
    'En cours',
    'En préparation',
    'En livraison',
    'Livré'
  ) -- Statut de la commande
  DEFAULT 'En cours',
  date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  -- Date automatique à la création
  -- Clés étrangères pour garantir l'intégrité des données
  FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
  FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);
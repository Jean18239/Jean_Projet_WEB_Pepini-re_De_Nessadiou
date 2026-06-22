-- Création de la base de données du projet pépinière
CREATE DATABASE nessadiou;
-- Sélectionne la base de données pour les instructions suivantes
USE nessadiou;
-- Table des clients inscrits sur le site
CREATE TABLE clients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  -- Identifiant unique auto-incrémenté
  nom VARCHAR(100),
  -- Nom de famille du client
  prenom VARCHAR(100),
  -- Prénom du client
  email VARCHAR(150) UNIQUE,
  -- Email unique (sert d'identifiant de connexion)
  telephone VARCHAR(20),
  -- Numéro de téléphone (optionnel)
  mot_de_passe VARCHAR(255) -- Mot de passe haché (bcrypt)
);
-- Table des produits disponibles à la vente (arbres, fruitiers, saisonniers)
CREATE TABLE produits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  -- Identifiant unique du produit
  nom VARCHAR(100),
  -- Nom commun du produit (ex : Manguier)
  type VARCHAR(50),
  -- Type de produit : arbre, fruitier, saisonnier
  description TEXT,
  -- Description longue du produit
  prix DECIMAL(10, 2),
  -- Prix en XPF avec 2 décimales
  image TEXT -- Chemin ou URL de l'image du produit
);
-- Table des commandes passées par les clients
CREATE TABLE commandes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  -- Identifiant unique de la commande
  client_id INT,
  -- Référence au client ayant passé la commande
  date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Date/heure automatique à la création
);
-- Table de détail des commandes (produits et quantités par commande)
CREATE TABLE details_commande (
  id INT AUTO_INCREMENT PRIMARY KEY,
  -- Identifiant unique de la ligne de détail
  commande_id INT,
  -- Référence à la commande parente
  produit_id INT,
  -- Référence au produit commandé
  quantite INT -- Nombre d'unités commandées
);
-- Ajout de la colonne "categorie" à la table produits (ajout après création initiale)
ALTER TABLE produits
ADD categorie VARCHAR(50);
-- Affecte la catégorie "arbre" au produit Santal
UPDATE produits
SET categorie = 'arbre'
WHERE nom = 'Santal';
-- Affecte la catégorie "saisonnier" au produit Moringa
UPDATE produits
SET categorie = 'saisonnier'
WHERE nom = 'Moringa';
-- Affecte la catégorie "fruitier" au produit Manguier
UPDATE produits
SET categorie = 'fruitier'
WHERE nom = 'Manguier';
INSERT INTO clients (
    nom,
    prenom,
    email,
    telephone,
    mot_de_passe,
    role
  )
VALUES (
    'Admin',
    'Nessadiou',
    'admin@nessadiou.nc',
    '751466',
    MD5('admin123'),
    'admin'
  );
ALTER TABLE clients
ADD role VARCHAR(20) DEFAULT 'client';

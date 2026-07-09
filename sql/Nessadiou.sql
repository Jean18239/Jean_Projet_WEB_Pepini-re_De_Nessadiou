CREATE DATABASE IF NOT EXISTS nessadiou
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE nessadiou;

DROP TABLE IF EXISTS commandes;
DROP TABLE IF EXISTS produits;
DROP TABLE IF EXISTS clients;

CREATE TABLE clients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  telephone VARCHAR(20) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'client'
);

CREATE TABLE produits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  type VARCHAR(50) NOT NULL,
  description TEXT,
  prix DECIMAL(10, 2) NOT NULL DEFAULT 0,
  image TEXT
);

CREATE TABLE commandes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  client_id INT NOT NULL,
  produit_id INT NOT NULL,
  quantite INT NOT NULL DEFAULT 1,
  statut ENUM('En cours', 'En préparation', 'En livraison', 'Livré') DEFAULT 'En cours',
  date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
  FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);

INSERT INTO clients (nom, prenom, email, telephone, mot_de_passe, role)
VALUES (
  'Admin',
  'Nessadiou',
  'admin@nessadiou.nc',
  '751466',
  '$2y$12$qPing1/mDCmN4wnrV/fZn.bLMC.OX3Jx7GjSz2B86ZWvPcqFakY26',
  'admin'
);

INSERT INTO produits (nom, type, description, prix, image) VALUES
('Santal', 'arbre', 'Arbre local apprécié pour son bois parfumé.', 2500, 'santal.webp'),
('Bois Noir Calédonien', 'arbre', 'Arbre robuste adapté au climat calédonien.', 1800, 'bois_noir_caledonien.jpg'),
('Bois Noir Haïti', 'arbre', 'Arbre d’ombrage au feuillage dense.', 1800, 'samanea_saman.jpg'),
('Baominia', 'arbre', 'Arbre ornemental pour jardin tropical.', 1600, 'baominia.jpg'),
('Burao', 'arbre', 'Arbre côtier résistant et décoratif.', 1500, 'burao.webp'),
('Gaïac', 'arbre', 'Arbre local à croissance lente et bois dense.', 2200, 'gaiac.jpg'),
('Gaïac Grosse Feuille', 'arbre', 'Variété de gaïac à grandes feuilles.', 2300, 'Guaiacum-sanctum-Lignum-Vitae.jpg'),
('Packaï', 'fruitier', 'Arbre fruitier tropical produisant des fruits sucrés.', 1800, 'packai.webp'),
('Oranger', 'fruitier', 'Agrume classique adapté aux jardins familiaux.', 1700, 'oranger.webp'),
('Citronnier', 'fruitier', 'Agrume productif pour cuisine et jardin.', 1600, 'citronnier.webp'),
('Bananier', 'fruitier', 'Plante fruitière tropicale à croissance rapide.', 1400, 'bananier.jpg'),
('Manguier', 'fruitier', 'Arbre fruitier tropical produisant des mangues.', 2000, 'manguier.webp'),
('Papayer', 'fruitier', 'Fruitier tropical facile à cultiver.', 1300, 'papayer.jpg'),
('Ananas', 'fruitier', 'Plant d’ananas pour production locale.', 900, 'ananas.jpg'),
('Moringa', 'saisonnier', 'Plante saisonnière utile et résistante.', 1200, 'moringa.webp'),
('Manioc', 'saisonnier', 'Plante vivrière adaptée aux sols tropicaux.', 1000, 'manioc.webp');

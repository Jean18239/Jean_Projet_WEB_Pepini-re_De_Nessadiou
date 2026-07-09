-- ============================================================
-- maj_images_produits.sql
-- Mise à jour des images pour tous les produits de la BDD
-- À exécuter si la colonne "image" est vide dans la table produits
-- ============================================================
-- Sélectionne la base de données avant toute opération — obligatoire en ligne de commande
USE nessadiou;
-- Vérifie que la colonne image existe (déjà créée à l'origine)
-- Si elle n'existe pas encore, la décommenter :
-- ALTER TABLE produits ADD image TEXT;
-- ============================================================
-- ARBRES SAISONNIERS
-- Moringa et Manioc doivent apparaître dans la page "saisonniers"
-- ============================================================
-- Met à jour l'image du Moringa
UPDATE produits
SET image = 'moringa.webp'
WHERE nom = 'Moringa';
-- Met à jour l'image du Manioc
UPDATE produits
SET image = 'manioc.webp'
WHERE nom = 'Manioc';
-- ============================================================
-- ARBRES
-- ============================================================
UPDATE produits
SET image = 'santal.webp'
WHERE nom = 'Santal';
UPDATE produits
SET image = 'bois_noir_caledonien.jpg'
WHERE nom = 'Bois Noir Calédonien';
UPDATE produits
SET image = 'samanea_saman.jpg'
WHERE nom = 'Bois Noir Haïti';
UPDATE produits
SET image = 'baominia.jpg'
WHERE nom = 'Baominia';
UPDATE produits
SET image = 'burao.webp'
WHERE nom = 'Burao';
UPDATE produits
SET image = 'gaiac.jpg'
WHERE nom = 'Gaïac';
UPDATE produits
SET image = 'Guaiacum-sanctum-Lignum-Vitae.jpg'
WHERE nom = 'Gaïac Grosse Feuille';
-- ============================================================
-- FRUITIERS
-- ============================================================
UPDATE produits
SET image = 'packai.webp'
WHERE nom = 'Packaï';
UPDATE produits
SET image = 'oranger.webp'
WHERE nom = 'Oranger';
UPDATE produits
SET image = 'citronnier.webp'
WHERE nom = 'Citronnier';
UPDATE produits
SET image = 'bananier.jpg'
WHERE nom = 'Bananier';
UPDATE produits
SET image = 'manguier.webp'
WHERE nom = 'Manguier';
UPDATE produits
SET image = 'papayer.jpg'
WHERE nom = 'Papayer';
UPDATE produits
SET image = 'ananas.jpg'
WHERE nom = 'Ananas';

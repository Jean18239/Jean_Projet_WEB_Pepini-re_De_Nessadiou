<?php
require_once __DIR__ . '/routes.php';

$dbConfig = [
    "host" => "localhost",
    "user" => "root",
    "password" => "",
    "database" => "nessadiou",
];

$localConfig = __DIR__ . '/database.php';
if (file_exists($localConfig)) {
    $dbConfig = array_merge($dbConfig, require $localConfig);
}

mysqli_report(MYSQLI_REPORT_OFF);

function create_table_if_missing(mysqli $conn, string $sql): void
{
    $conn->query($sql);
}

function seed_default_data(mysqli $conn): void
{
    $adminEmail = 'admin@nessadiou.nc';
    $stmt = $conn->prepare('SELECT id FROM clients WHERE email = ? LIMIT 1');
    if ($stmt) {
        $stmt->bind_param('s', $adminEmail);
        $stmt->execute();
        $adminExists = $stmt->get_result()->num_rows > 0;

        if (!$adminExists) {
            $adminPassword = '$2y$12$qPing1/mDCmN4wnrV/fZn.bLMC.OX3Jx7GjSz2B86ZWvPcqFakY26';
            $role = 'admin';
            $insert = $conn->prepare('INSERT INTO clients (nom, prenom, email, telephone, mot_de_passe, role) VALUES (?, ?, ?, ?, ?, ?)');
            if ($insert) {
                $nom = 'Admin';
                $prenom = 'Nessadiou';
                $telephone = '751466';
                $insert->bind_param('ssssss', $nom, $prenom, $adminEmail, $telephone, $adminPassword, $role);
                $insert->execute();
            }
        }
    }

    $result = $conn->query('SELECT COUNT(*) AS total FROM produits');
    $count = $result ? (int) $result->fetch_assoc()['total'] : 0;

    if ($count > 0) {
        return;
    }

    $products = [
        ['Santal', 'arbre', 'Arbre local apprécié pour son bois parfumé.', 2500, 'santal.webp'],
        ['Bois Noir Calédonien', 'arbre', 'Arbre robuste adapté au climat calédonien.', 1800, 'bois_noir_caledonien.jpg'],
        ['Bois Noir Haïti', 'arbre', 'Arbre d’ombrage au feuillage dense.', 1800, 'samanea_saman.jpg'],
        ['Baominia', 'arbre', 'Arbre ornemental pour jardin tropical.', 1600, 'baominia.jpg'],
        ['Burao', 'arbre', 'Arbre côtier résistant et décoratif.', 1500, 'burao.webp'],
        ['Gaïac', 'arbre', 'Arbre local à croissance lente et bois dense.', 2200, 'gaiac.jpg'],
        ['Gaïac Grosse Feuille', 'arbre', 'Variété de gaïac à grandes feuilles.', 2300, 'Guaiacum-sanctum-Lignum-Vitae.jpg'],
        ['Packaï', 'fruitier', 'Arbre fruitier tropical produisant des fruits sucrés.', 1800, 'packai.webp'],
        ['Oranger', 'fruitier', 'Agrume classique adapté aux jardins familiaux.', 1700, 'oranger.webp'],
        ['Citronnier', 'fruitier', 'Agrume productif pour cuisine et jardin.', 1600, 'citronnier.webp'],
        ['Bananier', 'fruitier', 'Plante fruitière tropicale à croissance rapide.', 1400, 'bananier.jpg'],
        ['Manguier', 'fruitier', 'Arbre fruitier tropical produisant des mangues.', 2000, 'manguier.webp'],
        ['Papayer', 'fruitier', 'Fruitier tropical facile à cultiver.', 1300, 'papayer.jpg'],
        ['Ananas', 'fruitier', 'Plant d’ananas pour production locale.', 900, 'ananas.jpg'],
        ['Moringa', 'saisonnier', 'Plante saisonnière utile et résistante.', 1200, 'moringa.webp'],
        ['Manioc', 'saisonnier', 'Plante vivrière adaptée aux sols tropicaux.', 1000, 'manioc.webp'],
    ];

    $insert = $conn->prepare('INSERT INTO produits (nom, type, description, prix, image) VALUES (?, ?, ?, ?, ?)');
    if (!$insert) {
        return;
    }

    foreach ($products as $product) {
        $insert->bind_param('sssds', $product[0], $product[1], $product[2], $product[3], $product[4]);
        $insert->execute();
    }
}

function initialize_database(mysqli $conn, string $database): void
{
    $safeDatabase = str_replace('`', '``', $database);
    $conn->query("CREATE DATABASE IF NOT EXISTS `$safeDatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conn->select_db($database);
    $conn->set_charset('utf8mb4');

    create_table_if_missing($conn, "
        CREATE TABLE IF NOT EXISTS clients (
          id INT AUTO_INCREMENT PRIMARY KEY,
          nom VARCHAR(100) NOT NULL,
          prenom VARCHAR(100) NOT NULL,
          email VARCHAR(150) NOT NULL UNIQUE,
          telephone VARCHAR(20) NOT NULL,
          mot_de_passe VARCHAR(255) NOT NULL,
          role VARCHAR(20) NOT NULL DEFAULT 'client'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    create_table_if_missing($conn, "
        CREATE TABLE IF NOT EXISTS produits (
          id INT AUTO_INCREMENT PRIMARY KEY,
          nom VARCHAR(100) NOT NULL,
          type VARCHAR(50) NOT NULL,
          description TEXT,
          prix DECIMAL(10, 2) NOT NULL DEFAULT 0,
          image TEXT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    create_table_if_missing($conn, "
        CREATE TABLE IF NOT EXISTS commandes (
          id INT AUTO_INCREMENT PRIMARY KEY,
          client_id INT NOT NULL,
          produit_id INT NOT NULL,
          quantite INT NOT NULL DEFAULT 1,
          statut ENUM('En cours', 'En préparation', 'En livraison', 'Livré') DEFAULT 'En cours',
          date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          INDEX idx_commandes_client_id (client_id),
          INDEX idx_commandes_produit_id (produit_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    seed_default_data($conn);
}

$conn = @new mysqli(
    $dbConfig["host"],
    $dbConfig["user"],
    $dbConfig["password"]
);

if ($conn->connect_error) {
    $db_error = "Impossible de se connecter au serveur MySQL. Erreur {$conn->connect_errno} : {$conn->connect_error}";
    $conn = null;
} else {
    initialize_database($conn, $dbConfig["database"]);
}

// echo "Connexion réussie";
?>

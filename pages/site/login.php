<?php
// Démarre la session pour pouvoir stocker des données (ex: l'utilisateur connecté)
session_start();

// Inclut le fichier de connexion à la base de données
require_once __DIR__ . '/../../config/connexion.php';

if (isset($user) && is_array($user) && $user['role'] == 'admin') {

    $_SESSION['admin'] = $user;

    header("Location: " . route_url('admin.commandes'));
    exit();
}

// Vérifie si le formulaire a été envoyé (méthode POST)
if (($_SERVER["REQUEST_METHOD"] ?? '') == "POST") {

    // Récupère l'email saisi dans le formulaire
    $email = trim($_POST['email'] ?? '');

    // Récupère le mot de passe saisi dans le formulaire
    $mdp = $_POST['password'] ?? '';

    if (!$conn instanceof mysqli) {
        $erreur = "La base de données n'est pas disponible. Vérifie que MySQL est lancé et que la base nessadiou existe.";
    } else {

    // Prépare la requête SQL de façon sécurisée (évite les injections SQL)
    // Le "?" est un emplacement réservé qui sera remplacé par $email
    $sql = $conn->prepare("SELECT * FROM clients WHERE email = ?");

    // Associe la variable $email au "?" de la requête
    // "s" signifie que c'est une chaîne de caractères (string)
    $sql->bind_param("s", $email);

    // Exécute la requête SQL
    $sql->execute();

    // Récupère le résultat de la requête
    $result = $sql->get_result();

    // Vérifie si exactement 1 compte a été trouvé avec cet email
    if ($result->num_rows == 1) {

        // Récupère les données du compte trouvé sous forme de tableau
        $user = $result->fetch_assoc();

        $motDePasseOk = password_verify($mdp, $user['mot_de_passe']);

        // Compatibilité avec l'ancien compte admin créé en MD5 dans le script SQL initial.
        if (!$motDePasseOk && hash_equals((string) $user['mot_de_passe'], md5($mdp))) {
            $motDePasseOk = true;
            $nouveauHash = password_hash($mdp, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE clients SET mot_de_passe = ? WHERE id = ?");
            $update->bind_param("si", $nouveauHash, $user['id']);
            $update->execute();
        }

        // Vérifie si le mot de passe saisi correspond au hash stocké en base de données
        if ($motDePasseOk) {
            if ($user['email'] === 'admin@nessadiou.nc' && ($user['role'] ?? '') !== 'admin') {
                $role = 'admin';
                $updateRole = $conn->prepare("UPDATE clients SET role = ? WHERE id = ?");
                $updateRole->bind_param("si", $role, $user['id']);
                $updateRole->execute();
                $user['role'] = $role;
            }

            // Stocke les infos de l'utilisateur dans la session
            // Cela permet de savoir qui est connecté sur toutes les pages
            $_SESSION['client'] = $user;

            // Redirige vers la page principale après connexion réussie
            header("Location: " . route_url('home'));

            // Arrête l'exécution du script après la redirection
            exit();

        } else {
            // Le mot de passe ne correspond pas au hash en BDD
            $erreur = "Mot de passe incorrect.";
        }

    } else {
        // Aucun compte trouvé avec cet email dans la base de données
        $erreur = "Aucun compte trouvé avec cet email.";
    }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Connexion</title>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>

<body class="auth-page">

<a class="btn-retour" href="<?php echo route_url('home'); ?>">Retour à l'accueil</a>

<div class="form">
<h2>Connexion</h2>

<?php if (isset($_GET['inscription']) && $_GET['inscription'] === 'ok') { ?>
<p class="message-success">Compte créé, vous pouvez vous connecter.</p>
<?php } ?>

<?php 
// Affiche le message d'erreur seulement s'il y en a un
if (!empty($erreur)) echo "<p class='erreur'>$erreur</p>"; 
?>

<!-- Formulaire envoyé en méthode POST -->
<form method="POST">

    <!-- Champ email, "required" oblige l'utilisateur à le remplir -->
    <input type="email" name="email" placeholder="Email" required>

    <!-- Champ mot de passe, masque les caractères saisis -->
    <input type="password" name="password" placeholder="Mot de passe" required>

    <!-- Bouton qui envoie le formulaire -->
    <button type="submit">Se connecter</button>

</form>

<!-- Lien vers la page d'inscription si pas encore de compte -->
<p><a href="<?php echo route_url('inscription'); ?>">Créer un compte</a></p>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

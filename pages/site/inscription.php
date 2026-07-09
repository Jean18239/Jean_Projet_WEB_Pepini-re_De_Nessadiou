<?php
// Inclut le fichier de connexion à la base de données (fournit la variable $conn)
require_once __DIR__ . '/../../config/connexion.php';

$message = '';
$messageClass = '';
 
// Vérifie que le formulaire a bien été soumis en méthode POST
if (($_SERVER["REQUEST_METHOD"] ?? '') == "POST") {
 
    // Récupère les champs du formulaire envoyés par l'utilisateur
    $nom       = trim($_POST['nom'] ?? '');
    $prenom    = trim($_POST['prenom'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $password  = $_POST['password'] ?? '';
 
    if (!$conn instanceof mysqli) {
        $message = "La base de données n'est pas disponible. Vérifie que MySQL est lancé et que la base nessadiou existe.";
        $messageClass = 'erreur';
    } elseif ($nom === '' || $prenom === '' || $email === '' || $telephone === '' || $password === '') {
        $message = "Tous les champs sont obligatoires.";
        $messageClass = 'erreur';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
        $messageClass = 'erreur';
    } else {
        // Hache le mot de passe avec l'algorithme bcrypt (PASSWORD_DEFAULT) — ne jamais stocker en clair
        $mdp = password_hash($password, PASSWORD_DEFAULT);

        $sql = $conn->prepare("INSERT INTO clients (nom, prenom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?, ?)");

        if (!$sql) {
            $message = "Impossible de préparer l'inscription. Vérifie que la table clients existe.";
            $messageClass = 'erreur';
        } else {
            $sql->bind_param("sssss", $nom, $prenom, $email, $telephone, $mdp);

            if ($sql->execute()) {
                header("Location: " . route_url('login') . "?inscription=ok");
                exit();
            }

            if ($conn->errno === 1062) {
                $message = "Un compte existe déjà avec cet email.";
            } else {
                $message = "Erreur lors de la création du compte : " . $conn->error;
            }
            $messageClass = 'erreur';
        }
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Inscription</title>
<!-- Lien vers la feuille de style externe commune -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
 
<body class="auth-page">
 
<a class="btn-retour" href="<?php echo route_url('home'); ?>">Retour à l'accueil</a>

<div class="form">
  <h2>Inscription</h2>

  <?php if ($message !== '') { ?>
    <p class="message <?php echo $messageClass; ?>"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
  <?php } ?>
 
  <!-- Formulaire d'inscription soumis en POST vers cette même page -->
  <form method="POST">
 
    <!-- Champ nom — obligatoire -->
    <input type="text" name="nom" placeholder="Nom *" required>
 
    <!-- Champ prénom — obligatoire -->
    <input type="text" name="prenom" placeholder="Prénom *" required>
 
    <!-- Champ email avec validation de format automatique — obligatoire -->
    <input type="email" name="email" placeholder="Email *" required>
 
    <!-- Champ téléphone — facultatif -->
    <input type="text" name="telephone" placeholder="Téléphone *" required>
 
    <!-- Champ mot de passe masqué — obligatoire -->
    <input type="password" name="password" placeholder="Mot de passe *" required>
 
    <!-- Bouton de soumission du formulaire -->
    <button type="submit">S'inscrire</button>
 
  </form>
 
  <!-- Lien vers la page de connexion si l'utilisateur a déjà un compte -->
  <p><a href="<?php echo route_url('login'); ?>">Déjà un compte ?</a></p>
 
</div>
 
<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

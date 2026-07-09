<?php
date_default_timezone_set('Pacific/Noumea');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../config/routes.php';
require_once __DIR__ . '/../../src/Exception.php';
require_once __DIR__ . '/../../src/PHPMailer.php';
require_once __DIR__ . '/../../src/SMTP.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . route_url('atelier'));
    exit();
}

$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$email = $_POST['email'] ?? '';
$telephone = $_POST['telephone'] ?? '';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jrhnc98@gmail.com';
    $mail->Password = 'gfsepkvvufqfeugv';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('jrhnc98@gmail.com', 'Pepiniere Nessadiou');
    $mail->addAddress('jrhnc98@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Nouvelle inscription atelier';

    $atelierImage = BASE_URL . '/assets/images/ateliers_pedagogique.png';
    $mail->Body = "
        <img src=\"$atelierImage\" alt=\"atelier pédagogique\">
        <h2>Nouvelle inscription atelier</h2>
        <p><strong>Nom :</strong> $nom</p>
        <p><strong>Prénom :</strong> $prenom</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Téléphone :</strong> $telephone</p>
    ";

    $mail->send();
} catch (Exception $e) {
    $error = "Erreur : {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Confirmation</title>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/atelier.css">
</head>
<body class="page-confirmation">
<div class="confirmation-box">
    <?php if (isset($error)) { ?>
        <h1>Inscription non envoyée</h1>
        <p><?php echo $error; ?></p>
    <?php } else { ?>
        <h1>Inscription envoyée</h1>
        <p>Votre inscription à l'atelier a bien été envoyée.</p>
    <?php } ?>
    <a href="<?php echo route_url('home'); ?>">Retour</a>
</div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>

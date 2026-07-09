<?php
require_once __DIR__ . '/../config/connexion.php';

header('Content-Type: text/plain; charset=utf-8');

if ($conn instanceof mysqli) {
    echo "Connexion MySQL OK\n";
    echo "Base : nessadiou\n";
    exit();
}

echo "Connexion MySQL impossible\n";
echo ($db_error ?? "Vérifie que MySQL est lancé, que la base nessadiou existe et que les identifiants sont corrects.") . "\n";
?>

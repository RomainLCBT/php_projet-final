<?php

include('database.php');
$pdo = dbConnect();
if ($pdo) {
    echo "Connexion réussie à la base de données.";
    phpinfo();

} else {
    echo "Erreur de connexion à la base de données.";
}
$conn = dbConnect();

?>


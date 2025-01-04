<?php

include('database.php');
$pdo = dbConnect();
if (!$pdo) {
    echo "Erreur de connexion à la base de données.";
    exit;
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!$nom || !$prenom || !$telephone || !$email || !$password) {
    echo "Tous les champs sont requis.";
    exit;
}

$sql_check = "SELECT COUNT(*) FROM Client WHERE adresse_mail = :email";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->execute([':email' => $email]);
$email_exists = $stmt_check->fetchColumn();

if ($email_exists > 0) {
    echo "L'adresse email est déjà utilisée.";
    echo "<br>";
    echo "<a href='../site/register.html'>Revenir à la page de création de compte</a>";
    exit;
}

$sql = "INSERT INTO Client (nom, prenom, telephone, adresse_mail, mot_de_passe)
        VALUES (:nom, :prenom, :telephone, :email, :password)";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':telephone' => $telephone,
        ':email' => $email,
        ':password' => $password,
    ]);

    header("Location: ../site/rendezvous.php");
    exit;
} catch (PDOException $e) {
    echo "Erreur lors de l'inscription : " . $e->getMessage();
}

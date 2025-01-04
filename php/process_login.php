<?php
include('database.php');
$pdo = dbConnect();
if (!$pdo) {
    echo "Erreur de connexion à la base de données.";
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];
$remember_me = isset($_POST['rester_co']);

if (!$email || !$password) {
    echo "L'email et le mot de passe sont requis.";
    echo "<br>";
    echo "<a href='../site/login.php'>Revenir à la page de connexion</a>";
    exit;
}

$sql = "SELECT id_client, mot_de_passe FROM Client WHERE adresse_mail = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "L'email n'est pas enregistré dans la base de données.";
    echo "<br>";
    echo "<a href='../site/login.php'>Revenir à la page de connexion</a>";
    exit;
}

if ($password === $user['mot_de_passe']) {

    session_start();
    $_SESSION['id_client'] = $user['id_client'];
    $_SESSION['email'] = $email;

    if ($remember_me) {
        $token = $user['id_client'];
        setcookie("remember_token", $token, time() + (86400 * 30), "/");  // 30 jours
    }

    header("Location: ../site/rendezvous.php");
    exit;
} else {
    echo "Mot de passe incorrect.";
    exit;
}

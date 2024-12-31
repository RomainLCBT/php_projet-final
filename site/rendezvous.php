<?php
session_start();
if (!isset($_SESSION['id_client'])){
    if (isset($_COOKIE['remember_token'])){
        echo $_COOKIE['remember_token'];
        include('../php/database.php'); 
        $pdo = dbConnect();
        if (!$pdo) {
            echo "Erreur de connexion à la base de données.";
            exit;
        }
        $token = $_COOKIE['remember_token'];
        $sql = "SELECT id_client, adresse_mail FROM Client WHERE id_client = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {

            $_SESSION['id_client'] = $user['id_client'];
            $_SESSION['email'] = $user['adresse_mail'];
        } 

        else{
            header("Location: login.php");
            exit;
        }
    } 
    else{
        header("Location: login.php");
        exit;
    }
}
?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prise de rendez Rendez Vous</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    <body>

        <!--header-->
        <header class="bg-primary shadow text-white fixed-top d-flex align-items-center container-fluid ps-0 justify-content-between" style="height: 7vh">
            <a href="rendezvous.php"><img src="../img/logo.png" alt="Logo" class="me-2" style="height: 7vh" ></a>
            <a href="../php/deconnexion.php"><button type="button" class="btn btn-danger ">Déconnexion</button></a>
        </header>
        <br>
        <br>
        <br>

        <h1 class="text-center mb-4 p-4">
        <?php
        include('../php/database.php'); 
        $pdo = dbConnect();

        if (!$pdo) {
            echo "Erreur de connexion à la base de données.";
            exit;
        }


        if (isset($_SESSION['id_client']) || isset($_COOKIE['remember_token'])) {
            $userId = isset($_SESSION['id_client']) ? $_SESSION['id_client'] : $_COOKIE['remember_token'];
            $sql = "SELECT nom, prenom FROM Client WHERE id_client = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "<p>Bienvenue " . ($user['nom']) . " " . ($user['prenom']) . "</p>";
            }
        }
        ?></h1>
        
        <div name="container"></div>


    </body>
</html>

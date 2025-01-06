<?php
session_start();
if (!isset($_SESSION['id_client'])) {
    if (isset($_COOKIE['remember_token'])) {
        echo $_COOKIE['remember_token'];
        include_once('../php/database.php');
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
        } else {
            header("Location: login.php");
            exit;
        }
    } else {
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
    <title>Prise de rendez-vous</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!--header-->
    <header class="bg-primary shadow text-white fixed-top d-flex align-items-center container-fluid ps-0 justify-content-between" style="height: 7vh">
        <a href="rendezvous.php"><img src="../img/logo.png" alt="Logo" class="me-2" style="height: 7vh"></a>
        <a href="../php/deconnexion.php"><button type="button" class="btn btn-danger ">Déconnexion</button></a>
    </header>
    <br>
    <br>
    <br>

    <h1 class="text-center mb-4 p-4 pb-1">
        <?php
        include_once('../php/database.php');
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

    <div class="text-center">
        <a href="prise_rendezvous.php" class="text-decoration-none">Prenez rendez-vous avec un spécialiste</a>
    </div>

    <div class="container mt-5 ">

        <h2 class="text-center mb-4">Vos Rendez-vous</h2>
        <?php
        include_once('../php/database.php');
        $pdo = dbConnect();
        if (!$pdo) {
            echo "Erreur de connexion à la base de données.";
            exit;
        }
        /*
        Cette requête SQL récupère les rendez-vous de l'utilisateur connecté en sélectionnant plusieurs colonnes de différentes tables :
        1. Sélection des colonnes :
        - Informations sur le rendez-vous (date, heure, statut).
        - Détails du médecin (nom, prénom, ID).
        - Nom de l'établissement.
        - Nom de la spécialité.
        2. Jointures (JOIN) :
        - Associe chaque rendez-vous à son médecin, établissement, et spécialité.
        3. Condition WHERE :
        - Filtre les rendez-vous pour ne sélectionner que ceux de l'utilisateur connecté.
        4. Tri des résultats (ORDER BY) :
        - Trie les rendez-vous par date et heure décroissantes pour afficher les plus récents en premier.
        Cette requête permet d'obtenir toutes les informations nécessaires pour afficher les rendez-vous de l'utilisateur, y compris les détails du médecin, de l'établissement et de la spécialité.
        */

        $id_client = $_SESSION['id_client'];
        $sql = "
                        SELECT
                            RendezVous.date,
                            RendezVous.heure,
                            RendezVous.est_passe,
                            Medecin.nom AS medecin_nom,
                            Medecin.prenom AS medecin_prenom,
                            Medecin.id_medecin AS medecin_id,
                            Etablissement.nom AS etablissement_nom,
                            specialites.nom AS specialite_nom
                        FROM RendezVous
                        JOIN Medecin ON RendezVous.id_medecin = Medecin.id_medecin
                        JOIN Etablissement ON RendezVous.id_etablissement = Etablissement.id_etablissement
                        JOIN possede ON Medecin.id_medecin = possede.id_medecin
                        JOIN specialites ON possede.id_spe = specialites.id_spe
                        WHERE RendezVous.id_client = :id
                        ORDER BY RendezVous.date DESC, RendezVous.heure DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id_client]);

        $rendezVousList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($rendezVousList)) {
            echo "<h4 class='text-center'>Vous n'avez pas de rendez-vous.</h4>";
        } else {
            foreach ($rendezVousList as $rendezVous) {
                $date = substr($rendezVous['date'], 0, -9);
                $heure = substr($rendezVous['heure'], 0, -3);
                $estPasse = $rendezVous['est_passe'] ? "Rendez-vous passé" : "À venir";
                $medecin = $rendezVous['medecin_nom'] . " " . $rendezVous['medecin_prenom'];
                $etablissement = $rendezVous['etablissement_nom'];
                $specialite = $rendezVous['specialite_nom'];
                $medecin_id = $rendezVous['medecin_id'];

                echo "
                            <div class='card w-50 mb-3 mx-auto'>
                                <div class='card-body '>
                                    <h5 class='card-title mb-0'>Rendez-vous avec Dr. $medecin</h5>
                                    <p class='card-text mb-0'>Établissement : $etablissement</p>
                                    <p class='card-text mb-0'>Spécialité : $specialite</p>
                                    <p class='card-text mb-0'>Date : $date</p>
                                    <p class='card-text mb-0'>Heure : $heure</p>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <p class='card-text mb-0'><strong>Status :</strong> $estPasse</p>
                                        <a href='prise_rendezvous.php?id_medecin=$medecin_id' class='btn btn-primary'>Reprendre rendez-vous</a>
                                    </div>
                                </div>
                            </div>";
            }
        }
        ?>
    </div>
</body>

</html>

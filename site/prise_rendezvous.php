<?php
session_start();
if (!isset($_SESSION['id_client'])){
    if (isset($_COOKIE['remember_token'])){
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
        } 
        else {
            header("Location: login.php");
            exit;
        }
    } 
    else {
        header("Location: login.php");
        exit;
    }
}

// Recherche des disponibilités
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
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
            <a href="rendezvous.php"><img src="../img/logo.png" alt="Logo" class="me-2" style="height: 7vh" ></a>
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

    <div class="container mt-3 ">
            <div class="text-center">
                <a href="rendezvous.php" class="text-decoration-none">Consultez vos rendez-vous </a>
            </div>
            <br>    
            <br>

            <form method="GET" action="">
    <div class="input-group w-50 mx-auto">
        <input type="text" class="form-control pl-2" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Recherchez le nom d'un médecin, une spécialité ou un établissement" aria-label="champ recherche" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit">Recherchez</button>
        </div>
    </div>
</form>


    <div class="container mt-5" >
    <?php
    if ($searchTerm) {
        $sql = "SELECT m.nom AS med_nom, m.prenom AS med_prenom, m.id_medecin, e.nom AS etab_nom, e.adresse AS etab_adresse, e.Ville AS etab_ville, s.nom AS spe_nom,  d.debut_periode, d.fin_periode, d.debut_heure, d.fin_heure 
        FROM disponibilite d
        JOIN requiert r ON d.id_dispo = r.id_dispo
        JOIN Medecin m ON r.id_medecin = m.id_medecin
        JOIN travail_dans td ON td.id_medecin = m.id_medecin
        JOIN Etablissement e ON e.id_etablissement = td.id_etablissement
        JOIN possede p ON p.id_medecin = m.id_medecin
        JOIN specialites s ON s.id_spe = p.id_spe
        WHERE (m.nom LIKE :searchTerm OR m.prenom LIKE :searchTerm OR s.nom LIKE :searchTerm OR e.nom LIKE :searchTerm OR e.adresse LIKE :searchTerm OR e.Ville LIKE :searchTerm)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':searchTerm' => "%" . $searchTerm . "%"]);
        $disponibilites = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($disponibilites) {
            foreach ($disponibilites as $dispo) {
                echo '
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">' . $dispo['med_nom'] . ' ' . $dispo['med_prenom'] . '</h5>
                        <h6 class="card-subtitle mb-2 text-muted">' . $dispo['spe_nom'] . '</h6>
                        <p class="card-text">Établissement: ' . $dispo['etab_nom'] . '<br>
                        Adresse: ' . $dispo['etab_adresse'] . ', ' . $dispo['etab_ville'] . '</p>
                        <p>Disponibilité: ' . $dispo['debut_periode'] . ' à ' . $dispo['fin_periode'] . ' de ' . $dispo['debut_heure'] . ' à ' . $dispo['fin_heure'] . '</p>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Aucune disponibilité trouvée.</p>';
        }
    }
    ?>


</body>
</html>
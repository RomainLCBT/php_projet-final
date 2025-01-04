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

// Connexion à la base de données
include_once('../php/database.php');
$pdo = dbConnect();
if (!$pdo) {
    echo "Erreur de connexion à la base de données.";
    exit;
}

// Gestion de la prise de rendez-vous
if (isset($_POST['prendre_rendez_vous'])) {
    $id_dispo = $_POST['id_dispo'];
    $id_medecin = $_POST['id_medecin'];
    $id_client = $_SESSION['id_client'];

    // Récupérer la disponibilité
    $sql = "SELECT * FROM disponibilite WHERE id_dispo = :id_dispo AND is_dispo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_dispo' => $id_dispo]);
    $dispo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dispo) {
        // Insérer le rendez-vous
        $sql = "INSERT INTO RendezVous (date, heure, est_passe, duree, id_client, id_medecin, id_etablissement, id_dispo)
                VALUES (:date, :heure, 0, '01:00:00', :id_client, :id_medecin, :id_etablissement, :id_dispo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':date' => $dispo['debut_periode'],
            ':heure' => $dispo['debut_heure'],
            ':id_client' => $id_client,
            ':id_medecin' => $id_medecin,
            ':id_etablissement' => $_POST['id_etablissement'],
            ':id_dispo' => $id_dispo
        ]);

        // Marquer la disponibilité comme prise
        $sql = "UPDATE disponibilite SET is_dispo = 0 WHERE id_dispo = :id_dispo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_dispo' => $id_dispo]);

        echo "<div class='alert alert-success text-center'>Rendez-vous pris avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>La disponibilité n'est plus valide.</div>";
    }
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="bg-primary shadow text-white fixed-top d-flex align-items-center container-fluid ps-0 justify-content-between" style="height: 7vh">
        <a href="rendezvous.php"><img src="../img/logo.png" alt="Logo" class="me-2" style="height: 7vh"></a>
        <a href="../php/deconnexion.php"><button type="button" class="btn btn-danger">Déconnexion</button></a>
    </header>
    <br><br><br>

    <h1 class="text-center mb-4 p-4 pb-1">
        <?php
        if (isset($_SESSION['id_client'])) {
            $userId = $_SESSION['id_client'];
            $sql = "SELECT nom, prenom FROM Client WHERE id_client = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "<p>Bienvenue " . htmlspecialchars($user['nom']) . " " . htmlspecialchars($user['prenom']) . "</p>";
            }
        }
        ?>
    </h1>

    <div class="container mt-3">
        <div class="text-center">
            <a href="rendezvous.php" class="text-decoration-none">Consultez vos rendez-vous</a>
        </div>
        <br><br>

        <form method="GET" action="">
            <div class="input-group w-50 mx-auto">
                <input type="text" class="form-control" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Recherchez le nom d'un médecin, une spécialité ou un établissement">
                <button class="btn btn-success" type="submit">Rechercher</button>
            </div>
        </form>

        <div class="container mt-5">
            <?php
            if ($searchTerm) {
                $sql = "SELECT m.nom AS med_nom, m.prenom AS med_prenom, m.id_medecin, e.nom AS etab_nom, e.adresse AS etab_adresse, e.Ville AS etab_ville, s.nom AS spe_nom, d.id_dispo, d.debut_periode, d.fin_periode, d.debut_heure, d.fin_heure, e.id_etablissement
                    FROM disponibilite d
                    JOIN requiert r ON d.id_dispo = r.id_dispo
                    JOIN Medecin m ON r.id_medecin = m.id_medecin
                    JOIN travail_dans td ON td.id_medecin = m.id_medecin
                    JOIN Etablissement e ON e.id_etablissement = td.id_etablissement
                    JOIN possede p ON p.id_medecin = m.id_medecin
                    JOIN specialites s ON s.id_spe = p.id_spe
                    WHERE (m.nom LIKE :searchTerm OR m.prenom LIKE :searchTerm OR s.nom LIKE :searchTerm OR e.nom LIKE :searchTerm OR e.adresse LIKE :searchTerm OR e.Ville LIKE :searchTerm) AND d.is_dispo = 1";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([':searchTerm' => "%" . $searchTerm . "%"]);
                $disponibilites = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($disponibilites) {
                    foreach ($disponibilites as $dispo) {
                        echo '<div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($dispo['med_nom']) . ' ' . htmlspecialchars($dispo['med_prenom']) . '</h5>
                                <h6 class="card-subtitle mb-2 text-muted">' . htmlspecialchars($dispo['spe_nom']) . '</h6>
                                <p class="card-text">Établissement: ' . htmlspecialchars($dispo['etab_nom']) . '<br>
                                Adresse: ' . htmlspecialchars($dispo['etab_adresse']) . ', ' . htmlspecialchars($dispo['etab_ville']) . '</p>
                                <p>Disponibilité: ' . htmlspecialchars($dispo['debut_periode']) . ' à ' . htmlspecialchars($dispo['fin_periode']) . ' de ' . htmlspecialchars($dispo['debut_heure']) . ' à ' . htmlspecialchars($dispo['fin_heure']) . '</p>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_dispo" value="' . htmlspecialchars($dispo['id_dispo']) . '">
                                    <input type="hidden" name="id_medecin" value="' . htmlspecialchars($dispo['id_medecin']) . '">
                                    <input type="hidden" name="id_etablissement" value="' . htmlspecialchars($dispo['id_etablissement']) . '">
                                    <button type="submit" name="prendre_rendez_vous" class="btn btn-primary">Prendre rendez-vous</button>
                                </form>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center">Aucune disponibilité trouvée.</p>';
                }
            }
            ?>
        </div>
    </div>

</body>

</html>
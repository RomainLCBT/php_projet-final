<?php
session_start();
if (!isset($_SESSION['id_client'])) {
    if (isset($_COOKIE['remember_token'])) {
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
        if ($user){
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

include_once('../php/database.php');
$pdo = dbConnect();
if (!$pdo) {
    echo "Erreur de connexion à la base de données.";
    exit;
}

if (isset($_POST['prendre_rendez_vous'])) {
    $id_dispo = $_POST['id_dispo'];
    $id_medecin = $_POST['id_medecin'];
    $id_client = $_SESSION['id_client'];

    $sql = "SELECT * FROM disponibilite WHERE id_dispo = :id_dispo AND is_dispo = TRUE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_dispo' => $id_dispo]);
    $dispo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dispo) {
        $sql = "INSERT INTO RendezVous (date, heure, est_passe, duree, id_client, id_medecin, id_etablissement, id_dispo)
                VALUES (:date, :heure, FALSE, '01:00:00', :id_client, :id_medecin, :id_etablissement, :id_dispo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':date' => $dispo['debut_periode'],
            ':heure' => $dispo['debut_heure'],
            ':id_client' => $id_client,
            ':id_medecin' => $id_medecin,
            ':id_etablissement' => $_POST['id_etablissement'],
            ':id_dispo' => $id_dispo
        ]);

        $sql = "UPDATE disponibilite SET is_dispo = FALSE WHERE id_dispo = :id_dispo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_dispo' => $id_dispo]);


    }

}

$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

$medecinId = '';
if (isset($_GET['id_medecin'])) {
    $medecinId = $_GET['id_medecin'];
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
                echo "<p>Bienvenue " . $user['nom'] . " " . $user['prenom'] . "</p>";
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
            <div class="input-group w-75 mx-auto">
                <input type="text" class="form-control" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Recherchez le nom d'un médecin, une spécialité ou un établissement">
                <button class="btn btn-success" type="submit">Rechercher</button>
            </div>
        </form>

        <div class="container mt-5">
            
            <?php
            /*
            Cette requête SQL récupère les disponibilités de rendez-vous en associant les tables qui interviennent dans les disponibilités des médecins:
            1. Sélection des colonnes :
            - Informations sur le médecin (nom, prénom, ID).
            - Informations sur l'établissement (nom, adresse, ville, ID).
            - Informations sur la spécialité (nom).
            - Informations sur la disponibilité (ID, date de début, date de fin, heure de début, heure de fin).
            2. Jointures (JOIN) :
            - Associe chaque disponibilité à son médecin via la table 'requiert'.
            - Associe chaque médecin à ses spécialités via la table 'possede'.
            - Associe chaque médecin à son établissement via la table 'travail_dans'.
            - Associe chaque établissement à ses médecins.
            3. Condition WHERE :
            - Filtre les disponibilités pour ne sélectionner que celles qui sont disponibles (is_dispo = TRUE).
            Cette requête permet de récupérer toutes les informations nécessaires pour afficher les disponibilités de rendez-vous, y compris les détails du médecin, de l'établissement et de la spécialité.
            */

            if ($searchTerm || $medecinId) {
                $sql = "SELECT m.nom AS med_nom, m.prenom AS med_prenom, m.id_medecin, e.nom AS etab_nom, e.adresse AS etab_adresse, e.Ville AS etab_ville, s.nom AS spe_nom, d.id_dispo, d.debut_periode, d.fin_periode, d.debut_heure, d.fin_heure, e.id_etablissement
                        FROM disponibilite d
                        JOIN requiert r ON d.id_dispo = r.id_dispo
                        JOIN Medecin m ON r.id_medecin = m.id_medecin
                        JOIN travail_dans td ON td.id_medecin = m.id_medecin
                        JOIN Etablissement e ON e.id_etablissement = td.id_etablissement
                        JOIN possede p ON p.id_medecin = m.id_medecin
                        JOIN specialites s ON s.id_spe = p.id_spe
                        WHERE d.is_dispo = TRUE";

                if ($searchTerm) {
                    $sql .= " AND (m.nom ILIKE :searchTerm OR m.prenom ILIKE :searchTerm OR s.nom ILIKE :searchTerm OR e.nom ILIKE :searchTerm OR e.adresse ILIKE :searchTerm OR e.Ville ILIKE :searchTerm)";
                }

                if ($medecinId) {
                    $sql .= " AND m.id_medecin = :medecinId";
                }

                $stmt = $pdo->prepare($sql);
                if ($searchTerm) {
                    $stmt->bindValue(':searchTerm', "%" . $searchTerm . "%");
                }
                if ($medecinId) {
                    $stmt->bindValue(':medecinId', $medecinId);
                }
                $stmt->execute();
                $disponibilites = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($disponibilites) {
                    foreach ($disponibilites as $dispo) {
                        echo '<div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">' . $dispo['med_nom'] . ' ' . $dispo['med_prenom'] . '</h5>
                                <h6 class="card-subtitle mb-2 text-muted">' . $dispo['spe_nom'] . '</h6>
                                <p class="card-text">Établissement: ' . $dispo['etab_nom'] . '<br>
                                Adresse: ' . $dispo['etab_adresse'] . ', ' . $dispo['etab_ville'] . '</p>
                                <p>Disponibilité: Le ' . $dispo['debut_periode'] . ' de ' . substr($dispo['debut_heure'], 0, -3) . ' à ' . substr($dispo['fin_heure'], 0, -3) . '</p>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_dispo" value="' . $dispo['id_dispo'] . '">
                                    <input type="hidden" name="id_medecin" value="' . $dispo['id_medecin'] . '">
                                    <input type="hidden" name="id_etablissement" value="' . $dispo['id_etablissement'] . '">
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

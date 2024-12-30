<?php
include('database.php');

$clientId = $_POST['client_id'];
$medecinId = $_POST['medecin_id'];
$etablissementId = $_POST['etablissement_id'];
$date = $_POST['date'];
$heure = $_POST['heure'];

$sql = "INSERT INTO RendezVous (date, heure, est_passe, duree, id_client, id_medecin, id_etablissement, id_dispo)
        VALUES (:date, :heure, FALSE, '00:30:00', :clientId, :medecinId, :etablissementId, 
               (SELECT id_dispo FROM requiert WHERE id_medecin = :medecinId LIMIT 1))";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':date' => $date,
    ':heure' => $heure,
    ':clientId' => $clientId,
    ':medecinId' => $medecinId,
    ':etablissementId' => $etablissementId,
]);

echo json_encode(['status' => 'success']);
?>

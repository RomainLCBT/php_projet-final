<?php

include('database.php');

// Vérifier si les données de recherche sont envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'] ?? '';
    $location = $_POST['location'] ?? '';

    try {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=nom_de_ta_base', 'nom_utilisateur', 'mot_de_passe', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // Préparer la requête SQL
        $sql = "SELECT m.nom AS medecin_nom, m.prenom AS medecin_prenom, s.nom AS specialite, e.nom AS etablissement_nom, e.Ville, d.debut_periode, d.fin_periode, d.debut_heure, d.fin_heure
                FROM Medecin m
                JOIN possede p ON m.id_medecin = p.id_medecin
                JOIN specialites s ON p.id_spe = s.id_spe
                JOIN travail_dans t ON m.id_medecin = t.id_medecin
                JOIN Etablissement e ON t.id_etablissement = e.id_etablissement
                JOIN requiert r ON m.id_medecin = r.id_medecin
                JOIN disponibilite d ON r.id_dispo = d.id_dispo
                WHERE (m.nom LIKE :search OR s.nom LIKE :search)
                  AND (e.Ville LIKE :location)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':search' => '%' . $search . '%',
            ':location' => '%' . $location . '%',
        ]);

        // Récupérer les résultats
        $results = $stmt->fetchAll();

        // Retourner les résultats sous forme JSON
        echo json_encode($results);
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Méthode non autorisée']);
}
?>

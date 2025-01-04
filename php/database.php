<?php

include('constantes.php');

function dbConnect() {
    try {
        ##changer mysql en pgsql si t'utilise pas mysql
        $dsn = "pgsql:host=" . DB_SERVER . ";port=" . DB_PORT . ";dbname=" . DB_NAME;

        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        
        return $pdo;
    } catch (PDOException $e) {

        echo "Erreur de connexion : " . $e->getMessage();
        return false;
    }
}

?>

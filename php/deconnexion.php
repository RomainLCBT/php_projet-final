<?php
session_start();
if (isset($_SESSION['id_client'])) {
    $_SESSION = array();
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/');  
    }
    session_destroy();
    header("Location: ../site/login.php");
    exit();
}
else {
    header("Location: ../site/login.php");
    exit();
}
?>

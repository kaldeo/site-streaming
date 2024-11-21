<?php
// Démarrez la session
session_start();

// Détruisez toutes les données de session
$_SESSION = array();

// Détruisez complètement la session
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header("Location: ../compte.php");
exit();
?>

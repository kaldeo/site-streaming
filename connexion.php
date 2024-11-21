<?php
    $serveur = "localhost";
    $nomUtilisateur = "admin2";
    $motDePasse  = "P@ssw0rd";
    $nomBaseDeDonnees = "streaming";

    try {
        // Connexion à la base de données avec PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }?>

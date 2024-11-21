<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    
    include('../../connexion.php'); // Assurez-vous que le chemin est correct

    try {

        // Requête pour vérifier les informations de connexion dans la base de données
        $requete = $connexion->prepare("SELECT u.*, a.id_abonnements FROM users u
        JOIN abonnements_users a ON u.id_users = a.id_users
        WHERE u.identifiant_users = ?");
        $requete->execute([$identifiant]);
        $utilisateur = $requete->fetch();
        
        if ($utilisateur && $utilisateur['mdp_users'] === sha1($mdp)) {
            $_SESSION['user_id'] = $utilisateur['id_users'];
            $_SESSION['abonnement_id'] = $utilisateur['id_abonnements'];

            // Redirection vers la page "compte.php"
            header('Location: ../compte.php');
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            echo "Identifiant ou mot de passe incorrect.";
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Mauvaise méthode d'accès au script.";
}

?>

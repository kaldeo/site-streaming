<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        include('../../connexion.php'); // Assurez-vous que le chemin est correct
        try {
            // Mettre à jour l'abonnement de l'utilisateur à "Aucun abonnement" (id_abonnements = 4)
            $id_user = $_SESSION['user_id'];
            $id_abonnement_aucun = 4;  // L'ID de l'abonnement "Aucun abonnement"

            $requete_update_abonnement = $connexion->prepare("UPDATE abonnements_users SET id_abonnements = :id_abonnement_aucun WHERE id_users = :id_user");
            $requete_update_abonnement->bindParam(':id_abonnement_aucun', $id_abonnement_aucun, PDO::PARAM_INT);
            $requete_update_abonnement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $requete_update_abonnement->execute();


            $_SESSION['abonnement_id'] = 4; // ou la nouvelle valeur correspondante
            var_dump($_SESSION['abonnement_id']);

            header("Location: ../compte.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Vous n'êtes pas connecté.";
    }
} else {
    echo "Mauvaise méthode d'accès au script.";
}
?>

<?php
session_start(); // Démarrage de la session

// Récupérez l'ID de l'utilisateur connecté depuis la session
if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];

    // Récupérez l'ID de l'abonnement à acheter depuis l'URL
    if (isset($_GET['id_abonnement'])) {
        $id_abonnement = $_GET['id_abonnement'];

        include('../../connexion.php'); // Assurez-vous que le chemin est correct
        try {
            // Démarrer une transaction
            $connexion->beginTransaction();

            // Supprimer l'ancienne ligne si elle existe
            $requete_suppression = $connexion->prepare("DELETE FROM abonnements_users WHERE id_users = :id_users");
            $requete_suppression->bindParam(':id_users', $id_user, PDO::PARAM_INT);
            $requete_suppression->execute();

            // Ajouter la nouvelle ligne
            $requete_insertion = $connexion->prepare("INSERT INTO abonnements_users (id_users, id_abonnements) VALUES (:id_users, :id_abonnement)");
            $requete_insertion->bindParam(':id_users', $id_user, PDO::PARAM_INT);
            $requete_insertion->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);
            $requete_insertion->execute();

            // Valider la transaction
            $connexion->commit();

            $_SESSION['abonnement_id'] = $id_abonnement;


            // Redirigez l'utilisateur vers une page de confirmation ou autre
            header("Location: ../../compte/compte.php");
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $connexion->rollBack();
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        echo 'ID d\'abonnement non spécifié.';
    }
} else {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../../compte/compte.php");
    exit();
}
?>

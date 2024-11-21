<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'abonnement - GabouFlix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./style.css">
	<style>
    .acheter-button {
        display: inline-block;
        color: #fff;
        background-color: #e44d26; /* Couleur du bouton Acheter, ajustez selon vos préférences */
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 15px;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
    }

    .acheter-button:hover {
        background-color: #333;
    }
</style>

</head>
<body>

    <header class="header-outer">
        <div class="header-inner responsive-wrapper">
            <div class="header-logo">
                <img src="../../img/gabouflix.png" />
            </div>
            <nav class="header-navigation">
                <a href="../../accueil/accueil.html">Accueil</a>
                <a href="../../about/about.html">À propos</a>
                <a href="../../programmes/programmes.php">Programmes</a>
                <a href="../abonnements.php">Abonnements</a>
                <a href="../../compte/compte.php">Compte</a>
                <button>Menu</button>
            </nav>
        </div>
    </header>

    <div class="details-container">
	<?php
    include('../../connexion.php'); // Assurez-vous que le chemin est correct
	?>

<?php
// Vérifiez si l'ID de l'abonnement est défini dans l'URL
if (isset($_GET['id_abonnement'])) {
    // Récupérez l'ID de l'abonnement depuis l'URL
    $id_abonnement = $_GET['id_abonnement'];

    try {
        // Requête SQL avec jointure entre les tables abonnements et details
        $requete_details = $connexion->prepare("SELECT a.*, d.* FROM abonnements a JOIN details d ON a.id_abonnements = d.id_abonnements WHERE a.id_abonnements = :id_abonnement");
        $requete_details->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);
        $requete_details->execute();
        $details_abonnement = $requete_details->fetch(PDO::FETCH_ASSOC);

        // Affichez les détails de l'abonnement
        if ($details_abonnement) {
            echo '<h2 class="' . strtolower($details_abonnement['nom_abonnements']) . '">' . $details_abonnement['nom_abonnements'] . '</h2>';
            echo '<p>Prix : ' . $details_abonnement['prix_abonnements'] . '</p>';
            echo '<p>' . $details_abonnement['description_abonnements'] . '</p>';


            // Affichez les détails supplémentaires de la table details
            echo '<p>Qualité : ' . $details_abonnement['qualite'] . '</p>';
            echo '<p>Nombre d\'utilisateurs simultanés : ' . $details_abonnement['nb_users_simult'] . '</p>';
            echo '<p>Appareils Compatibile : ' . $details_abonnement['compatibilite'] . '</p>';
            echo '<p>Mise à jour régulière : ' . $details_abonnement['maj_reguliere'] . '</p>';
            echo '<p>Annulation de l\'abonnement: ' . $details_abonnement['annulation'] . '</p>';
            echo '<p>Disponibilité du Support client : ' . $details_abonnement['supp_client'] . '</p>';
            
            echo '<a href="achat_abonnement.php?id_abonnement=' . $details_abonnement['id_abonnements'] . '" class="acheter-button">Acheter l\'abonnement</a>';

            // echo '<img src="' . $details_abonnement['image_abonnements'] . '" alt="' . $details_abonnement['nom_abonnements'] . '">';
        } else {
            echo 'Aucun détail d\'abonnement trouvé.';
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    echo 'ID d\'abonnement non spécifié.';
}
?>
    </div>
</body>
</html>

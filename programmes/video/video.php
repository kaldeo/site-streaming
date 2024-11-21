<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GabouFlix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./style.css">
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
            <a href="../programmes.php">Programmes</a>
            <a href="../../abonnements/abonnements.php">Abonnements</a>
            <a href="../../compte/compte.php">Compte</a>
            <button>Menu</button>
        </nav>
    </div>
</header>

<?php
    session_start();


    if (isset($_GET['id_films'])) {
        $id_films = intval($_GET['id_films']); // Assurez-vous que l'ID est un entier

        include('../../connexion.php'); // Assurez-vous que le chemin est correct

        try {


            // Récupérer le chemin de la vidéo du film depuis la base de données
            $requete = $connexion->prepare("SELECT id_films, titre_films, name_actor, description_films, durree_films, video_films FROM films WHERE id_films = :id_films");
            $requete->bindParam(':id_films', $id_films, PDO::PARAM_INT);
            $requete->execute();
            $video_films = $requete->fetch(PDO::FETCH_ASSOC);
            

            // Afficher l'ID du film
            echo '<div class="video-container">';
            // Vérifier si la vidéo existe
            if (!empty($video_films)) {
                echo '<video controls width="800" height="450">';
                echo '<source src="' . $video_films['video_films'] . '" type="video/mp4">';
                echo 'Votre navigateur ne prend pas en charge la lecture de la vidéo.';
                echo '</video>';
            } else {
                echo '<p>Aucune vidéo trouvée pour ce film.</p>';
            }

            echo '<div class="film-info">';
            echo '<h2>' . $video_films['titre_films'] . '</h2>';
            echo '<p><strong>Réalisateur(s):</strong> ' . $video_films['name_actor'] . '</p>';
            echo '<p><strong>Durée:</strong> ' . $video_films['durree_films'] . '</p>';
            echo '<p><strong>Description:</strong> ' . $video_films['description_films'] . '</p>';

            echo '</div>';
            



            echo '</div>';
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        // Redirigez l'utilisateur vers une page d'erreur si l'ID du film n'est pas spécifié
        header("Location: erreur.php");
        exit();
    }
?>

<script  src="./script.js"></script>

</body>
</html>

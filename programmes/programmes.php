

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>GabouFlix</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <!-- partial:index.partial.html -->
  <!-- Sticky header -->
  <header class="header-outer">
    <div class="header-inner responsive-wrapper">
      <div class="header-logo">
        <img src="../img/gabouflix.png" />
      </div>
      <nav class="header-navigation">
        <a href="../accueil/accueil.html">Accueil</a>
        <a href="../about/about.html">À propos</a>
        <a href="programmes.php">Programmes</a>
        <a href="../abonnements/abonnements.php">Abonnements</a>
        <a href="../compte/compte.php">Compte</a>
        <button>Menu</button>
      </nav>
    </div>
  </header>

  <div class="film-container">
  <?php
    session_start();
    include('../connexion.php'); // Assurez-vous que le chemin est correct

    try {
        // Récupérer l'ID de l'abonnement de l'utilisateur depuis la session
        $id_abonnement_utilisateur = isset($_SESSION['abonnement_id']) ? $_SESSION['abonnement_id'] : null;


        // Vérifier si l'ID de l'abonnement permet d'accéder aux programmes
        if ($id_abonnement_utilisateur !== null && in_array($id_abonnement_utilisateur, [1, 2, 3])) {
            // L'utilisateur a le droit d'accéder aux programmes

            // Ajouter ici votre code pour afficher les programmes, par exemple :
            $requeteProgrammes = $connexion->prepare("SELECT * FROM films");
            $requeteProgrammes->execute();
            $programmes = $requeteProgrammes->fetchAll(PDO::FETCH_ASSOC);

            if ($programmes) {
                foreach ($programmes as $programme) {
                    echo '<div class="film-box">';
                    echo '<img src="' . $programme['image_films'] . '" alt="Image du film">';
                    echo '<a href="video/video.php?id_films=' . $programme['id_films'] . '"><button class="watch-button">Regarder le film</button></a>';
                    echo '</div>';
                }
            } else {
                echo 'Aucun film trouvé pour cet abonnement.';
            }
        } else {
            // L'utilisateur n'a pas le droit d'accéder aux programmes
            echo 'Vous devez créer un compte et avoir un abonnement pour accéder aux programmes.';
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
?>

  </div>

  <script src="./script.js"></script>
</body>
</html>

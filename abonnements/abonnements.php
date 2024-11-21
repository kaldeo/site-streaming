<!DOCTYPE html>
<html lang="fr" >
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
				<img src="../img/gabouflix.png" />
			</div>
			<nav class="header-navigation">
				<a href="../accueil/accueil.html">Accueil</a>
				<a href="../about/about.html">À propos</a>
				<a href="../programmes/programmes.php">Programmes</a>
				<a href="abonnements.php">Abonnements</a>
				<a href="../compte/compte.php">Compte</a>
				<button>Menu</button>
			</nav>
		</div>
	</header>

	<div class="abonnements-container">
		<?php
			include('../connexion.php'); // Assurez-vous que le chemin est correct
			try {
				// Récupérer les abonnements depuis la base de données
				$requete = $connexion->prepare("SELECT * FROM abonnements WHERE id_abonnements IN (1, 2, 3)");
				$requete->execute();
				$abonnements = $requete->fetchAll(PDO::FETCH_ASSOC);

				// Affichage des abonnements
				if ($abonnements) {
					foreach ($abonnements as $abonnement) {
						echo '<div class="abonnement">';
						echo '<h2>' . $abonnement['nom_abonnements'] . '</h2>';
						echo '<p>Prix : ' . $abonnement['prix_abonnements'] . '</p>';
						echo '<p>' . $abonnement['description_abonnements'] . '</p>';
						echo '<br>';

						echo '<ul>';
						// Afficher les avantages
						$avantages1 = explode(', ', $abonnement['avantages1_abonnements']);
						foreach ($avantages1 as $avantage1) {
							echo '<li>' . $avantage1 . '</li>';
						}
						$avantages2 = explode(', ', $abonnement['avantages2_abonnements']);
						foreach ($avantages2 as $avantage2) {
							echo '<li>' . $avantage2 . '</li>';
						}
						$avantages3 = explode(', ', $abonnement['avantages3_abonnements']);
						foreach ($avantages3 as $avantage3) {
							echo '<li>' . $avantage3 . '</li>';
						}

						echo '</ul>';
						// echo '<img src="' . $abonnement['image_abonnements'] . '" alt="' . $abonnement['nom_abonnements'] . '">';
						echo '<br>';

						echo '<a href="details/details.php?id_abonnement=' . $abonnement['id_abonnements'] . '" class="details-button ' . strtolower($abonnement['nom_abonnements']) . '">Voir Détails</a>';

						echo '</div>';
					}
				} else {
					echo 'Aucun abonnement trouvé.';
				}
			} catch (PDOException $e) {
				echo 'Erreur : ' . $e->getMessage();
			}
		?>

	</div>
</body>
</html>

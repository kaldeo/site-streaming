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
				<a href="../abonnements/abonnements.php">Abonnements</a>
				<a href="compte.php">Compte</a>
				<button>Menu</button>
			</nav>
		</div>
	</header>
	<br>
	<div class="container">
		<div class="info-container">
			<?php
				session_start();

				if (isset($_SESSION['user_id'])) {
					include('../connexion.php'); // Assurez-vous que le chemin est correct


					try {
						// Récupérer les informations de l'utilisateur connecté à partir de la session
						$user_id = $_SESSION['user_id'];
						$requete = $connexion->prepare("SELECT u.*, a.nom_abonnements, au.id_abonnements FROM users u JOIN abonnements_users au ON u.id_users = au.id_users JOIN abonnements a ON au.id_abonnements = a.id_abonnements WHERE u.id_users = ?");

						$requete->execute([$user_id]);
						$utilisateur = $requete->fetch();

						// Afficher les informations du compte de l'utilisateur
						if ($utilisateur) {
							echo "<h2>Informations du compte</h2>";
							echo "<p>Nom : " . $utilisateur['last_name_users'] . "</p>";
							echo "<p>Prénom : " . $utilisateur['first_name_users'] . "</p>";
							echo "<p>Date de naissance : " . $utilisateur['ddn_users'] . "</p>";
							echo "<p>Adresse : " . $utilisateur['adresse_post_users'] . "</p>";
							echo "<p>Adresse email : " . $utilisateur['adresse_mail_users'] . "</p>";
							echo "<p>Identifiant : " . $utilisateur['identifiant_users'] . "</p>";


							// Vérifier si la clé "id_abonnements" existe avant de l'utiliser
							if (isset($utilisateur['id_abonnements'])) {
								$id_abonnement_utilisateur = $utilisateur['id_abonnements'];
								$nom_abonnement_utilisateur = $utilisateur['nom_abonnements'];

								echo "<p>Abonnement : $nom_abonnement_utilisateur</p>";

								// Afficher le bouton de résiliation uniquement pour les abonnements 1, 2 ou 3
								if (in_array($id_abonnement_utilisateur, [1, 2, 3])) {
									echo "<form action='logout/resilier_abonnement.php' method='post'>";
									echo "<input type='submit' value=\"Résilier l'abonnement\" class='resilier-button'>";
									echo "</form>";
								}
							} else {
								echo "<p>Abonnement : Aucun abonnement</p>";
							}




							echo "<form action='logout/logout.php' method='post'>";
							echo "<input type='submit' value='Se déconnecter' class='logout-button'>";
							echo "</form>";

							// Ne jamais afficher le mot de passe stocké dans la base de données directement sur la page !
						} else {
							echo "Utilisateur non trouvé.";
						}
					} catch (PDOException $e) {
						echo "Erreur : " . $e->getMessage();
					}
				} else {
					echo "Vous n'êtes pas connecté.";
				}
		    ?>
		</div>

		<div class="form-container">
			<?php


				if (isset($_SESSION['user_id'])) {
					include('../connexion.php'); // Assurez-vous que le chemin est correct
					try {
						// Initialisez les variables pour stocker les nouvelles valeurs
						$new_last_name = $new_first_name = $new_ddn = $new_adresse = $new_email = $new_identifiant = '';

						if ($_SERVER['REQUEST_METHOD'] === 'POST') {
							// Assurez-vous de nettoyer les données avant de les utiliser
							$new_last_name = htmlspecialchars($_POST['new_last_name']);
							$new_first_name = htmlspecialchars($_POST['new_first_name']);
							$new_ddn = htmlspecialchars($_POST['new_ddn']);
							$new_adresse = htmlspecialchars($_POST['new_adresse']);
							$new_email = htmlspecialchars($_POST['new_email']);
							$new_identifiant = htmlspecialchars($_POST['new_identifiant']);

							// Champs à mettre à jour
							$champsModifies = array(
								'last_name_users' => $new_last_name,
								'first_name_users' => $new_first_name,
								'ddn_users' => $new_ddn,
								'adresse_post_users' => $new_adresse,
								'adresse_mail_users' => $new_email,
								'identifiant_users' => $new_identifiant
							);

							// Mettre à jour chaque champ modifié
							foreach ($champsModifies as $champ => $valeur) {
								if (!empty($valeur)) {
									$updateQuery = $connexion->prepare("UPDATE users SET $champ = ? WHERE id_users = ?");
									$updateQuery->execute([$valeur, $_SESSION['user_id']]);
								}
							}

							// Rediriger l'utilisateur vers la page compte.php après la modification
							header("Location: compte.php");
							exit();
						}

						// Récupérer les informations de l'utilisateur connecté
						$requete = $connexion->prepare("SELECT * FROM users WHERE id_users = ?");
						$requete->execute([$_SESSION['user_id']]);
						$utilisateur = $requete->fetch();

						if ($utilisateur) {
							// Formulaire pour modifier les informations
							echo "<h2>Modifier les Informations</h2>";


							echo "<form method='post'>";
							echo "<label for='new_last_name'>Nouveau Nom :</label>";
							echo "<input type='text' id='new_last_name' name='new_last_name' value='" . $new_last_name . "'>";
							// Répéter pour les autres champs à modifier (prénom, date de naissance, adresse postale, adresse e-mail, identifiant)
							echo "<label for='new_first_name'>Nouveau Prénom :</label>";
							echo "<input type='text' id='new_first_name' name='new_first_name' value='" . $new_first_name . "'>";

							echo "<label for='new_ddn'>Nouvelle date de naissance :</label>";
							echo "<input type='date' id='new_ddn' name='new_ddn' value='" . $new_ddn . "'>";

							echo "<label for='new_adresse'>Nouvelle adresse postal :</label>";
							echo "<input type='text' id='new_adresse' name='new_adresse' value='" . $new_adresse . "'>";

							echo "<label for='new_email'>Nouvelle adresse mail :</label>";
							echo "<input type='email' id='new_email' name='new_email' value='" . $new_email . "'>";

							echo "<label for='new_identifiant'>Nouvel identifiant :</label>";
							echo "<input type='text' id='new_identifiant' name='new_identifiant' value='" . $new_identifiant . "'>";
							// ...
							echo "<input type='submit' value='Modifier'>";
							echo "</form>";
						} else {
							echo "Utilisateur non trouvé.";
						}
					} catch (PDOException $e) {
						echo "Erreur : " . $e->getMessage();
					}
				} else {
					echo "Vous n'êtes pas connecté.";
				}
			?>
		</div>
	</div>
	<div class="button-container">
		<a href="login/login.html">Se Connecter</a>
		<a href="signup/signup.html">S'Inscrire</a>
	</div>
</body>
</html>

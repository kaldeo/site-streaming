<?php

session_start();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Récupérer les données du formulaire
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$ddn = $_POST['ddn'];
			$adresse = $_POST['adresse'];
			$email = $_POST['email'];
			$identifiant = $_POST['identifiant'];
			$mdp = $_POST['mdp'];

			include('../../connexion.php'); // Assurez-vous que le chemin est correct

			try {
				$mdp_hache = sha1($mdp);
				$requete = $connexion->prepare("INSERT INTO users (last_name_users, first_name_users, ddn_users, adresse_post_users, adresse_mail_users, identifiant_users, mdp_users) VALUES (?, ?, ?, ?, ?, ?, ?)");

				// Exécution de la requête avec les données du formulaire
				$requete->execute([$nom, $prenom, $ddn, $adresse, $email, $identifiant, $mdp_hache]);



				$nouvelId = $connexion->lastInsertId();
        		$insertionAbonnement = $connexion->prepare("INSERT INTO abonnements_users (id_users, id_abonnements) VALUES (?, 4)");
        		$insertionAbonnement->execute([$nouvelId]);


				header('Location: ../login/login.html?signup=success');
			} catch (PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		} else {
			echo "Mauvaise méthode d'accès au script.";
		}
	?>
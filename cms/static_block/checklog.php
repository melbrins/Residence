<?php

	session_start(); // On démarre la session AVANT toute chose

	//PDO STATEMENT
	include '../static_block/bdd.php';


try
	{
							
		//On récupère tout le contenu de la table news
		$psd = $bdd->query('SELECT * FROM information');
		
		//On lance la boucle pour créer toutes les images.
		while ($donnees = $psd->fetch())
		{	
			$access= $donnees['Password'];
		}

		//On arrete la lecture de la table.
		$psd->closeCursor();
	
	}
	
	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	
	//Verifier que le champ de mot de passe a bien été rempli
	if($_SESSION['password'] != $access){

		header("Location:login.php?pswd=wrong");
		exit;

	}

?>
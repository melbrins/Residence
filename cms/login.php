<?php

session_start(); // On démarre la session AVANT toute chose

try
	{
		include '../static_block/bdd.php';
							
		//On récupère tout le contenu de la table news
		$Info = $bdd->query('SELECT * FROM information');

		//On lance la boucle pour créer toutes les images.
		
		while ($donnees = $Info->fetch())
		{	
			$access= $donnees['Password'];
		}
		
		//On arrete la lecture de la table.
		$Info->closeCursor();
	}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	//Verifier que le champ de mot de passe a bien été rempli
	if(isset($_SESSION['password']) OR isset($_POST['password']) ){

		if(isset($_POST['password'])){

			$password=htmlentities($_POST['password']);
		
		}

		//Le mot de passe à bien été rempli et maintenant il faut vérifier que c'est le bon
		if(isset($_SESSION['password']) AND $_SESSION['password'] == $access OR $password == $access){
		
			$_SESSION['password'] = $access;
			header("Location:admin.php");
		
		}else{
		
			header("Location:login.php?pswd=wrong");
			$_SESSION = array(); 
			session_unset();
			session_destroy();
		}

	}else{

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">
	
	<meta charset="utf-8" />
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	

</head>

<body>

	<div id="password">
<?php 

	if( isset($_GET['pswd'])){ 

?>

		<p>Wrong Password ! Try again !</p>

<?php

	}else{ 

?>

		<p>Password :</p>

<?php 

	}

?>

		<form action='login.php' method='post'>
			
			<br>
			
			<input type="password" name="password" class="input" placeholder="Enter Your Password" value="" size="40"/>

			<div class="res2-btn">
				<button class="btn" type="submit">
					
					<span>Login</span>

				</button>
			</div>
		
		</form>

	</div>

</body>
<?php
}
?>
</html>
<?php
try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=reside_1', 'root', 'root', $pdo_options);
		
		$requ= $bdd->prepare("UPDATE property SET Ordre= Ordre +1 WHERE Ordre = :numb AND Home = 'true'");
		$requ->execute(array(
			'numb'=>$_GET['numero']
		));
		
		$requ->closeCursor();
		
		$req= $bdd->prepare("UPDATE property SET Ordre= Ordre -1 WHERE ID = :clef");
		$req->execute(array(
			'clef'=>$_GET['id']
		));

		$req->closeCursor();
		
		header("Location:admin.php?page=home");
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
?>
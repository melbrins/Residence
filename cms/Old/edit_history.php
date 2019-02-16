<?php
$Id=$_POST['Clef'];
//On verifie si la case delete a ete coché
if(isset($_POST['delete'])){
	// Si c'est le cas on se connecte a la base de données
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=mysql5-18.60gp;dbname=melbrins', 'melbrins', 'ender711', $pdo_options);
		
		//Grace a la clef recupéré dans l'input Hidden du formulaire concerné, on elimine la bonne ligne.
		//On prepare la ligne avec la variable de la page et l'ID
		$req= $bdd->prepare("DELETE FROM history WHERE ID= :clef");
		//On execute la suppression en donnant une valeur au variable.
		$req->execute(array(
			'clef' => $_POST['Clef']
			));
		//On ferme la requete.
		$req->closeCursor();
		
		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:admin.php?page=about&delete=on");
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
}else{
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=mysql5-18.60gp;dbname=melbrins', 'melbrins', 'ender711', $pdo_options);
		$req = $bdd->prepare("UPDATE history SET Quand= :when, Quoi= :what WHERE ID='$Id'");
				$req->execute(array(
				'when' => htmlentities($_POST['When']),
				'what' => htmlentities($_POST['What'])
		));
		$req->closeCursor();
		header("Location:admin.php?page=about&edit=on");
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
}
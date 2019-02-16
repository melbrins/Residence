<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];
$page=$_POST['Page'];
$ref=$_POST['Ref'];

//On verifie si la case delete a ete coché
if(isset($_POST['delete'])){

	// Si c'est le cas on se connecte a la base de données
	try
		{
			
			$req = $bdd -> query("DELETE FROM room WHERE ID= '$Id'");

			//On ferme la requete.
			$req->closeCursor();
			
			//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
			header("Location:../../property_edit_room.php?page=".$page."&delete=on&reference=".$ref);

			exit;

		}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else{

	try
	{

		$req = $bdd->prepare("UPDATE room SET Title= :title, Size= :size, Description= :description WHERE ID='$Id'");
		
		$req->execute(array(
		
			'title' => htmlentities($_POST['RoomTitle']),
			'size' => htmlentities($_POST['RoomSize']),
			'description' => htmlentities($_POST['RoomDescription'])
		
		));
		
		$req->closeCursor();
		
		header("Location:../../property_edit_room.php?page=".$page."&edit=on&reference=".$ref);
	
		exit;

	}
	
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
}
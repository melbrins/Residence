<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];

//On verifie si la case delete a ete coché
if(isset($_POST['delete'])){

	// Si c'est le cas on se connecte a la base de données
	try
	{
		
		$slider = $bdd->query("DELETE FROM budys WHERE ID = '$Id'");
		
		//On arrete la lecture de la table.
		$slider->closeCursor();

		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:../../admin.php?page=about&delete=on");

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{
	
	//Define width of the picture
	$new_width= 250;

	$chemin = 'images/budys';
	
	$max_size = 10000000; //File Size in Bytes

	if(filesize($_FILES['Image']['tmp_name']) > $max_size) {
      
      header("Location:../../property_add.php?page=".$page."&size=on");

      exit;
    }


	//Upload image script
	include '../../static_block/res2_upload_picture.php';

	//If there is an error during the upload
	if($issue_extension == true){

		header("Location:../../property_add.php?page=".$page."&ext=on");

		exit;
	}

	try
	{

		$req = $bdd->query("UPDATE budys SET Picture= '$Nom_nouvelleImage' WHERE ID='$Id'");

		$req->closeCursor();

		header("Location:../../admin.php?page=about&edit=on");

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}

?>
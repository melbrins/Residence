<?php

include '../../../static_block/bdd.php';

$id = $_POST['Clef'];
$ref = $_POST['Ref'];
$page = $_POST['Page'];

//On verifie si la case delete a ete coché
if(isset($_POST['delete'])){

	// Si c'est le cas on se connecte a la base de données
	try
	{
		
		$req = $bdd -> query("DELETE FROM floor WHERE ID='$id'");

		$req -> closeCursor();

		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:../../property_edit_details.php?page=".$page."&delete=on&reference=".$ref);

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0){

	//Define width of the picture
	$new_width= 800;

	$chemin = 'images/map';
	
	$max_size = 1000000; //File Size in Bytes

	if(filesize($_FILES['Image']['tmp_name']) > $max_size) {
      
      header("Location:../../property_edit_picture.php?page=".$page."&size=on&reference=".$ref);

      exit;

    }

	//Upload image script
	include '../../static_block/res2_upload_picture.php';

	//If there is an error during the upload
	if($issue_extension == true){

		header("Location:../../property_edit_picture.php?page=".$page."&ext=on&reference=".$ref);

		exit;

	}
			
	try
		{

			$req = $bdd->query("UPDATE floor SET Picture= '$Nom_nouvelleImage' WHERE Reference='$ref'");

			$req->closeCursor();

			header("Location:../../property_edit_details.php?page=".$page."&edit=on&reference=".$ref);

			exit;

		}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}	

}

?>
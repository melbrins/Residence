<?php

include '../../../static_block/bdd.php';

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
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

		$req = $bdd->query("INSERT INTO budys (Picture) VALUE ('$Nom_nouvelleImage')");
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
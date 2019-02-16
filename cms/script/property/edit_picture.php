<?php

include '../../../static_block/bdd.php';

$id=$_POST['Id'];
$ref=$_POST['Ref'];
$page=$_POST['Page'];
$old_img=$_POST['old_picture'];

//On verifie si la case delete a ete coché
if(isset($_POST['delete'])){

	// Si c'est le cas on se connecte a la base de données
	try
		{
			
			$slider = $bdd->query("DELETE FROM property_picture WHERE ID='$id'");
			$slider -> closeCursor();

			$dossier_images = "../../../images";
			$chemin = $dossier_images."/".$old_img;
			unlink($chemin) or die ("Erreur");

			header("Location:../../property_edit_picture.php?page=".$page."&edit=on&reference=".$ref);

			exit;

		}
	
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0){


	//Define width of the picture
	$new_width= 1600;

	$chemin = 'images';
	
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

			$req = $bdd->query("UPDATE property_picture SET Picture= '$Nom_nouvelleImage' WHERE ID='$id'");
			$req->closeCursor();

			$dossier_images = "../../../images";
			$chemin = $dossier_images."/".$old_img;
			unlink($chemin) or die ("Erreur");

			header("Location:../../property_edit_picture.php?page=".$page."&edit=on&reference=".$ref);

			exit;

		}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_POST['select'])){

	// Si c'est le cas on se connecte a la base de données
	try
		{
			
			$selectHomepage = $bdd->query("UPDATE property SET Pictures = '$old_img' WHERE Reference = '$ref'");
			$selectHomepage -> closeCursor();

			header("Location:../../property_edit_picture.php?page=".$page."&select=on&reference=".$ref);

			exit;

		}
	
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}					

?>
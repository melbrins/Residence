<?php

include '../../../static_block/bdd.php';

$ref=$_POST['Ref'];
$page=$_POST['Page'];

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{

	//Define width of the picture
	$new_width= 800;

	$chemin = 'images/map';
	
	$max_size = 10000000; //File Size in Bytes

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
		
			$req = $bdd->prepare("INSERT INTO floor (Reference, Picture) VALUE ( :reference, :image)");
		
			$req->execute(array(

				'reference' => $ref,
				'image' => $Nom_nouvelleImage
			
			));
			
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
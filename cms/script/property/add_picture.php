<?php

include '../../../static_block/bdd.php';

$ref=$_POST['Ref'];
$page=$_POST['Page'];

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{	

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

		//Insert into database the information from the form overview
		$req = $bdd -> prepare("INSERT INTO property_picture (Reference, Picture) VALUE ( :reference, :image)");
		
		$req->execute(array(

			'reference' => $ref,
			'image' => $Nom_nouvelleImage
		
		));
		
		$req->closeCursor();

		header("Location:../../property_edit_picture.php?page=".$page."&add=on&reference=".$ref);

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else{

	header("Location:../../property_edit_picture.php?page=".$page."&issue=on&reference=".$ref);

	exit;
}

?>
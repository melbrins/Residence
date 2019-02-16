<?php

include '../../../static_block/bdd.php';

//On récupère la page concerné par la modification
$Page=$_POST['Page']; 

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{

	//Define width of the picture
	$new_width= 380;

	$chemin = 'images/contact'; 
	
	$max_size = 10000000; //File Size in Bytes

	if(filesize($_FILES['Image']['tmp_name']) > $max_size) {
      
      header("Location:../../admin.php?page=".$page."&size=on");

      exit;
    }


	//Upload image script
	include '../../static_block/res2_upload_picture.php';

	//If there is an error during the upload
	if($issue_extension == true){

		header("Location:../../admin.php?page=".$page."&ext=on");

		exit;
	}

	try
		{
			$req = $bdd->prepare("UPDATE contact SET Text= :text, Picture= :image WHERE Page='$Page'");
			$req->execute(array(

				'text' => htmlentities($_POST['Text']),
				'image' => $Nom_nouvelleImage,

			));

			$req->closeCursor();

			header("Location:../../admin.php?page=$Page&edit=on");

			exit;

		}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}					
		

}else{
	
	try
		{
			$req = $bdd->prepare("UPDATE contact SET Text= :text WHERE Page='$Page'");
			
			$req->execute(array(
			
				'text' => htmlentities($_POST['Text'])
			
			));
			
			$req->closeCursor();
			
			header("Location:../../admin.php?page=$Page&edit=on");
		
			exit;

		}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}
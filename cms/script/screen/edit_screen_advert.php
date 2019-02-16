<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];
$page=$_POST['Page'];
$ref=$_POST['Ref'];

$check_screen_delete = $bdd->query("SELECT * FROM screen WHERE Reference = '$ref' ");

if(isset($_POST['delete'])){

	while($donnees = $check_screen_delete -> fetch() ){

		$requ= $bdd->prepare("UPDATE screen SET Ordre= Ordre -1 WHERE Ordre > :numb");
		$requ->execute(array(

			'numb'=>$donnees['Ordre']
		
		));

	}

	$check_screen_delete ->closeCursor();

	// Si c'est le cas on se connecte a la base de données
	try
	{
		
		//Grace a la clef recupéré dans l'input Hidden du formulaire concerné, on elimine la bonne ligne.
		//On prepare la ligne avec la variable de la page et l'ID
		$req= $bdd->prepare("DELETE FROM screen WHERE ID= :clef");

		//On execute la suppression en donnant une valeur au variable.
		$req->execute(array(

			'clef' => $_POST['Clef']
		
		));

		//On ferme la requete.
		$req->closeCursor();
		
		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:../../admin.php?page=screen&delete=on");

		exit;
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{

	//Define width of the Thumbnails
	$new_width= 465;

	$chemin = 'slider/images/thumbs/';

	//Define width of the Slide
	$new_widthXL= 1420;

	$cheminXL = 'slider/images';
	
	$max_size = 10000000; //File Size in Bytes

	if(filesize($_FILES['Image']['tmp_name']) > $max_size) {
      
      header("Location:../../screen_add.php?page=".$page."&size=on");

      exit;
    }


	//Upload image script
	include '../../static_block/res2_upload_screen_picture.php';

	//If there is an error during the upload
	if($issue_extension == true){

		header("Location:../../screen_add.php?page=".$page."&ext=on");

		exit;
	}

	try
	{

		$check = $bdd->query("SELECT * FROM screen WHERE Reference = '$ref' ");

		while($donnees = $check->fetch() ){

			// If the street is different so the reference need to be different as well
			if($donnees['Street'] != htmlentities($_POST['Street'])){

				//We select the first three letter of the street
				$reference_street = substr(htmlentities($_POST['Street']), 0, 3);

				// True if no duplicate reference
				$checkok = false;
				
				while($checkok != true){
					//We define a variable with all the number between 1 and 9999
					$reference_number = rand (100000, 999999);
					
					//We apply the three letter with a number between 1 and 9999
					$reference = $reference_street."-".$reference_number;

					$checkref = $bdd->query("SELECT * FROM screen WHERE Reference='$reference'");

					$resultcheck = $checkref->num_rows;
					// $resultcheck = mysql_num_rows($result);

					// If we can find the same reference we try again
					if ($resultcheck) {

					   $checkok = false;
					
					}else{
					
					   $checkok = true;
					
					}
				}

			// If the street is still the same so we keep the same reference.
			}else{

				$reference = $ref;

			}

		}
		$check->closeCursor();
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

	try
	{

		$detail_street = htmlentities($_POST['Street']);
		$detail_advert = 'true';
		$detail_repeat = htmlentities($_POST['Repeat']);

		$req = $bdd->prepare("UPDATE screen SET Reference = :ref, Street = :street, Picture = :image, Advertising = :advert, Repeatable = :repeat WHERE ID='$Id'");
		
		$req->execute(array(

			'ref' => $reference,
			'street' => $detail_street,
			'image' => $Nom_nouvelleImage,
			'advert' => $detail_advert,
			'repeat' => $detail_repeat
		
		));

		$req->closeCursor();

		header("Location:../../admin.php?page=screen&edit=on&reference=".$reference);

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
	
// No pictures
}else{

	try{

		$check = $bdd->query("SELECT * FROM screen WHERE Reference = '$ref' ");

		while($donnees = $check->fetch() ){

			// If the street is different so the reference need to be different as well
			if($donnees['Street'] != htmlentities($_POST['Street'])){

				//We select the first three letter of the street
				$reference_street = substr(htmlentities($_POST['Street']), 0, 3);

				// True if no duplicate reference
				$checkok = false;
				
				while($checkok != true){
					//We define a variable with all the number between 1 and 9999
					$reference_number = rand (100000, 999999);
					
					//We apply the three letter with a number between 1 and 9999
					$reference = $reference_street."-".$reference_number;

					$checkref = $bdd->query("SELECT * FROM screen WHERE Reference='$reference'");

					$resultcheck = $checkref->num_rows;
					// $resultcheck = mysql_num_rows($result);

					// If we can find the same reference we try again
					if ($resultcheck) {

					   $checkok = false;
					
					}else{
					
					   $checkok = true;
					
					}
				}

			// If the street is still the same so we keep the same reference.
			}else{

				$reference = $ref;

			}
		}
		$check->closeCursor();
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

	try
	{

		$detail_street = htmlentities($_POST['Street']);
		$detail_advert = 'true';
		$detail_repeat = htmlentities($_POST['Repeat']);

		$req = $bdd->prepare("UPDATE screen SET Reference = :ref, Street= :street, Advertising= :advert, Repeatable = :repeat WHERE ID='$Id'");
				
		$req->execute(array(

			'ref' => $reference,
			'street' => $detail_street,
			'advert' => $detail_advert,
			'repeat' => $detail_repeat

		));

		$req->closeCursor();

		header("Location:../../admin.php?page=screen&edit=on&reference=".$reference);

		exit;
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
}

?>
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
      
      header("Location:../../property_add.php?page=".$page."&size=on");

      exit;
    }

	//Upload image script
	include '../../static_block/res2_upload_screen_picture.php';

	//If there is an error during the upload
	if($issue_extension == true){

		header("Location:../../property_add.php?page=".$page."&ext=on");

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

					$resultcheck = mysql_num_rows($result);

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

		$detail_category = htmlentities($_POST['Category']);
		$detail_type = htmlentities($_POST['Type']);
		$detail_street = htmlentities($_POST['Street']);
		$detail_postcode =htmlentities($_POST['Postcode']);
		$detail_area = htmlentities($_POST['Area']);
		$detail_price = htmlentities($_POST['Price']);
		$detail_per = htmlentities($_POST['per']);
		$detail_bedroom =htmlentities($_POST['Bedroom']);

		$reference_details= $_POST['Reference'];

		if( $reference_details != null){

			$detail_category = htmlentities($_POST['Category_reference']);

			$PropertyReference = $bdd->query("SELECT * FROM property WHERE Reference='$reference_details'");

			while ($donnees = $PropertyReference->fetch())
			{
				// $detail_category = $donnees['Statut'];
				$detail_type = $donnees['Type'];
				$detail_street = $donnees['Street'];
				$detail_postcode = $donnees['Postcode'];
				$detail_area = $donnees['Area'];
				$detail_price = $donnees['Price'];
				$detail_per = $donnees['PricePer'];
				$detail_bedroom = $donnees['Bedroom'];
				$reference=$reference_details;
			}

			$PropertyReference->closeCursor();

		}

		$req = $bdd->prepare("UPDATE screen SET Reference = :ref, Bedroom= :bedroom, Category= :category, Type= :type, Street= :street, Postcode= :postcode, Area= :area, Price= :price, PricePer= :per, Picture= :image, Bedroom= :bedroom WHERE ID='$Id'");
		
		$req->execute(array(

			'ref' => $reference,
			'bedroom' => $detail_bedroom,
			'category' => $detail_category,
			'type' => $detail_type,
			'street' => $detail_street,
			'postcode' => $detail_postcode,
			'area' => $detail_area,
			'price' => $detail_price,
			'per' => $detail_per,
			'image' => $Nom_nouvelleImage,
			'bedroom' => $detail_bedroom
		
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

					$resultcheck = mysql_num_rows($result);

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

		$detail_category = htmlentities($_POST['Category']);
		$detail_type = htmlentities($_POST['Type']);
		$detail_street = htmlentities($_POST['Street']);
		$detail_postcode =htmlentities($_POST['Postcode']);
		$detail_area = htmlentities($_POST['Area']);
		$detail_price = htmlentities($_POST['Price']);
		$detail_per = htmlentities($_POST['per']);
		$detail_bedroom =htmlentities($_POST['Bedroom']);

		$reference_details= $_POST['Reference'];

		if( $reference_details != null){

			$PropertyReference = $bdd->query("SELECT * FROM property WHERE Reference='$reference_details'");

			while ($donnees = $PropertyReference->fetch())
			{
				// $detail_category = $donnees['Statut'];
				$detail_type = $donnees['Type'];
				$detail_street = $donnees['Street'];
				$detail_postcode = $donnees['Postcode'];
				$detail_area = $donnees['Area'];
				$detail_price = $donnees['Price'];
				$detail_per = $donnees['PricePer'];
				$detail_bedroom = $donnees['Bedroom'];
				$reference = $reference_details;
			}

			$PropertyReference->closeCursor();

		}

		$req = $bdd->prepare("UPDATE screen SET Reference = :ref, Category= :category, Type= :type, Street= :street, Postcode= :postcode, Area= :area, Price= :price, PricePer= :per, Bedroom= :bedroom WHERE ID='$Id'");
				
		$req->execute(array(

			'ref' => $reference,
			'category' => $detail_category,
			'type' => $detail_type,
			'street' => $detail_street,
			'postcode' => $detail_postcode,
			'area' => $detail_area,
			'price' => $detail_price,
			'per' => $detail_per,
			'bedroom' => $detail_bedroom

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
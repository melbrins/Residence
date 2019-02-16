<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];
$page=$_POST['Page'];
$ref=$_POST['Ref'];
$num_rows=$_POST['Num_rows'];

$check_home = $bdd->query("SELECT * FROM property WHERE Reference = '$ref' ");
$check_new_home = $bdd->query("SELECT * FROM property WHERE Reference = '$ref' ");
$check_home_delete = $bdd->query("SELECT * FROM property WHERE Reference = '$ref' ");

//CHECK POST
if(isset($_POST['Home'])){

	while($donnees = $check_new_home -> fetch() ){

		if($donnees['Home'] != 'true'){

			// HOME SELECTED
			$home = 'true';
			$home_ordre = $num_rows++;
			$home_ordre++;

		}else{

			$home = 'true';
			$home_ordre = $donnees['Ordre'];
		
		}

	}
	
	$check_new_home ->closeCursor();

	

}else{

	// HOME UNSELECTED
	$home ='false';
	$home_ordre = 0;


	while($donnees = $check_home -> fetch() ){

		if($donnees['Home'] != 'false'){

			$requ = $bdd -> prepare("UPDATE property SET Ordre = Ordre -1 WHERE Ordre > :numb AND Home = 'true'");
			
			$requ -> execute(array(

				'numb' => $donnees['Ordre']

			));

		}

	}
	
	$check_home ->closeCursor();

}

//Check if cover delete box was ticked.
if(isset($_POST['delete_cover'])){

	// Si c'est le cas on se connecte a la base de données
	try
	{
		
		//Grace a la clef recupéré dans l'input Hidden du formulaire concerné, on elimine la bonne ligne.
		//On prepare la ligne avec la variable de la page et l'ID
		$req = $bdd->prepare("UPDATE property SET Small_picture = 'no_picture.jpg' WHERE ID='$Id'");

		//On execute la suppression en donnant une valeur au variable.
		$req->execute(array(

			'clef' => $_POST['Clef']
			
		));

		//On ferme la requete.
		$req->closeCursor();
		
		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:../../property_edit_overview.php?page=".$page."&delete_cover=on&reference=".$ref);

		exit;
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_POST['delete'])){

	while($donnees = $check_home_delete -> fetch() ){

		if($donnees['Home'] != 'false'){

			$requ= $bdd->prepare("UPDATE property SET Ordre= Ordre -1 WHERE Ordre > :numb AND Home = 'true'");
			$requ->execute(array(

				'numb'=>$donnees['Ordre']
			
			));

		}

	}

	$check_home_delete ->closeCursor();

	// Si c'est le cas on se connecte a la base de données
	try
	{
		
		//Grace a la clef recupéré dans l'input Hidden du formulaire concerné, on elimine la bonne ligne.
		//On prepare la ligne avec la variable de la page et l'ID
		$req= $bdd->prepare("DELETE FROM property WHERE ID= :clef");

		//On execute la suppression en donnant une valeur au variable.
		$req->execute(array(

			'clef' => $_POST['Clef']
		
		));

		//On ferme la requete.
		$req->closeCursor();
		
		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:../../admin.php?page=".$page."&delete=on");

		exit;
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{

	//Define width of the picture
	$new_width= 380;

	$chemin = 'images';
	
	$max_size = 10000000; //File Size in Bytes

	if(filesize($_FILES['Image']['tmp_name']) > $max_size) {
      
      header("Location:../../property_edit_overview.php?page=".$page."&size=on&reference=".$reference);

      exit;
    }


	//Upload image script
	include '../../static_block/res2_upload_picture.php';

	//If there is an error during the upload
	if($issue_extension == true){

		header("Location:../../property_edit_overview.php?page=".$page."&ext=on&reference=".$reference);

		exit;
	}

	try
	{

		$check = $bdd->query("SELECT * FROM property WHERE Reference = '$ref' ");

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

					$checkref = $bdd->query("SELECT * FROM property WHERE Reference='$reference'");

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

		$req = $bdd->prepare("UPDATE property SET Number= :number, Street= :street, Postcode= :postcode, Area= :area, Price= :price, PricePer= :per, Statut= :statut, Short= :short, Description= :description, Small_picture= :image, Home= :home, Ordre= :ordre, CaptionPosition = :caption, Page = :page, Reference = :ref, Date= NOW() WHERE ID='$Id'");
		
		$req->execute(array(
		'number' => htmlentities($_POST['Number']),
		'street' => htmlentities($_POST['Street']),
		'postcode' => htmlentities($_POST['Postcode']),
		'area' => htmlentities($_POST['Area']),
		'price' => htmlentities($_POST['Price']),
		'per' => htmlentities($_POST['per']),
		'statut' => htmlentities($_POST['Statut']),
		'short' => $_POST['Short'],
		'description' => $_POST['Description'],
		'image' => $Nom_nouvelleImage,
		'home' => $home,
		'ordre' => $home_ordre,
		'caption' => htmlentities($_POST['Caption']),
		'page' => htmlentities($_POST['Page']),
		'ref' => $reference
		));

		$req->closeCursor();

		header("Location:../../property_edit_details.php?page=".$page."&edit=on&reference=".$reference);

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
	
// No pictures
}else{

	try{

		$check = $bdd->query("SELECT * FROM property WHERE Reference = '$ref' ");

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

					$checkref = $bdd->query("SELECT * FROM property WHERE Reference='$reference'");

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
		
		$req = $bdd->prepare("UPDATE property SET Number= :number, Street= :street, Postcode= :postcode, Area= :area, Price= :price, PricePer= :per, Statut= :statut, Short= :short, Description= :description, Home= :home, Ordre= :ordre, CaptionPosition= :caption, Page = :page, Reference = :ref, Date= NOW() WHERE ID='$Id'");
				
		$req->execute(array(
		'number' => htmlentities($_POST['Number']),
		'street' => htmlentities($_POST['Street']),
		'postcode' => htmlentities($_POST['Postcode']),
		'area' => htmlentities($_POST['Area']),
		'price' => htmlentities($_POST['Price']),
		'per' => htmlentities($_POST['per']),
		'statut' => htmlentities($_POST['Statut']),
		'short' => $_POST['Short'],
		'description' => $_POST['Description'],
		'home' => $home,
		'ordre' => $home_ordre,
		'caption' => htmlentities($_POST['Caption']),
		'page' => htmlentities($_POST['Page']),
		'ref' => $reference
		));

		$req->closeCursor();

		header("Location:../../property_edit_details.php?page=".$page."&edit=on&reference=".$reference);

		exit;
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
}

?>
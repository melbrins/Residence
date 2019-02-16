<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];
$page=$_POST['Page'];
$num_rows=$_POST['Num_rows'];

//On verifie si la case delete a ete coché
if(isset($_POST['Home'])){

	// Si c'est le cas on se connecte a la base de données
	$home = 'true';
	$home_ordre = $num_rows++;
	$home_ordre++;

}else{

	$home ='false';
	$home_ordre = 0;

}

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{

	//Define width of the picture
	$new_width= 380;

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


	//If picture uploaded successfully we continue to upload the rest of the information
	try
	{

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

		//Insert into database the information from the form overview
		$req = $bdd->prepare("INSERT INTO property (Number, Street, Postcode, Area, Price, PricePer, Statut, Short, Description, Reference, Small_picture, Home, Ordre, CaptionPosition, Page, Date) VALUE (:number, :street, :postcode, :area, :price, :per, :statut, :short, :description, :reference, :image, :home, :ordre, :caption, :page, NOW())");
		
		$req->execute(array(
			'number' => htmlentities($_POST['Number']),
			'street' => htmlentities($_POST['Street']),
			'postcode' => htmlentities($_POST['Postcode']),
			'area' => htmlentities($_POST['Area']),
			'price' => htmlentities($_POST['Price']),
			'per' => htmlentities($_POST['per']),
			'statut' => htmlentities($_POST['Statut']),
			'short' => htmlentities($_POST['Short']),
			'description' => htmlentities($_POST['Description']),
			'reference' => $reference,
			'image' => $Nom_nouvelleImage,
			'home' => $home,
			'ordre' => $home_ordre,
			'caption' => htmlentities($_POST['Caption']),
			'page' => htmlentities($_POST['Page'])
		));
		
		$req->closeCursor();

		header("Location:../../property_edit_details.php?page=".$page."&edit=on&reference=".$reference);

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}					

}else{

	try
	{
		
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
		
		//Insert into database the information from the form overview
		
		$req = $bdd->prepare("INSERT INTO property (Number, Street, Postcode, Area, Price, PricePer, Statut, Short, Description, Reference, Home, Ordre, CaptionPosition, Page, Date) VALUE (:number, :street, :postcode, :area, :price, :per, :statut, :short, :description, :reference, :home, :ordre, :caption, :page, NOW())");
		
		$req->execute(array(
			'number' => htmlentities($_POST['Number']),
			'street' => htmlentities($_POST['Street']),
			'postcode' => htmlentities($_POST['Postcode']),
			'area' => htmlentities($_POST['Area']),
			'price' => htmlentities($_POST['Price']),
			'per' => htmlentities($_POST['per']),
			'statut' => htmlentities($_POST['Statut']),
			'short' => htmlentities($_POST['Short']),
			'description' => htmlentities($_POST['Description']),
			'reference' => $reference,
			'home' => $home,
			'ordre' => $home_ordre,
			'caption' => htmlentities($_POST['Caption']),
			'page' => htmlentities($_POST['Page'])
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
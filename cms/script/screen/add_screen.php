<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];
$page=$_POST['Page'];
$screen_ordre=$_POST['Num_rows'];

$screen_ordre++;

if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
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

			$checkref = $bdd->query("SELECT * FROM screen WHERE Reference='$reference'");

			if($_POST['Num_rows'] > 0){

				$resultcheck = $checkref->num_rows;
				// $resultcheck = mysql_num_rows($result);

				// If we can find the same reference we try again
				 if ($resultcheck) {

				   $checkok = false;
				
				}else{
				
				   $checkok = true;
				
				}

			}else{
			
			   $checkok = true;
			
			}
		}

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


		//Insert into database the information from the form overview
		$req = $bdd->prepare("INSERT INTO screen (Reference, Category, Type, Street, Postcode, Area, Price, PricePer, Ordre, Picture, Bedroom) VALUE (:reference, :category, :type, :street, :postcode, :area, :price, :per, :ordre, :image, :bedroom)");
		
		$req->execute(array(
			'reference' => $reference,
			'category' => $detail_category,
			'type' => $detail_type,
			'street' => $detail_street,
			'postcode' => $detail_postcode,
			'area' => $detail_area,
			'price' => $detail_price,
			'per' => $detail_per,
			'ordre' => $screen_ordre,
			'image' => $Nom_nouvelleImage,
			'bedroom' => $detail_bedroom

		));
		
		$req->closeCursor();

		header("Location:../../admin.php?page=screen");

		exit;

	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}					

}else{
	header("Location:../../screen_add.php?page=screen&picture_screen=on");
}

?>
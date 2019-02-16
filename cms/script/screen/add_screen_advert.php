<?php

include '../../../static_block/bdd.php';

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

		if($_POST['Street'] == null){

			header("Location:../../screen_add.php?page=".$page."&required=on");
			exit;
		
		}else{

			//We select the first three letter of the street
			$reference_street = substr(htmlentities($_POST['Street']), 0, 3);
		
		}

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
				// $resultcheck = mysql_num_rows($checkref);

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

		$detail_street = htmlentities($_POST['Street']);
		$detail_advert = 'true';
		$detail_repeat = htmlentities($_POST['Repeat']);

		//Insert into database the information from the form overview
		$req = $bdd->prepare("INSERT INTO screen (Reference, Street, Advertising, Ordre, Picture, Repeatable) VALUE (:reference, :street, :advert, :ordre, :image, :repeat)");
		
		$req->execute(array(
			'reference' => $reference,
			'street' => $detail_street,
			'advert' => $detail_advert,
			'ordre' => $screen_ordre,
			'image' => $Nom_nouvelleImage,
			'repeat' => $detail_repeat
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
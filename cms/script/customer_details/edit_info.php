<?php

include '../../../static_block/bdd.php';

if($_POST['Address'] != '' AND $_POST['Email'] != '' AND $_POST['Mobile'] != '' AND $_POST['Phone'] != ''){

	try
		{

			$req = $bdd->prepare("UPDATE information SET Address= :address, Email= :email, Mobile= :mobile, Phone= :phone");
			
			$req->execute(array(
				
				'address' => $_POST['Address'],
				'email' => $_POST['Email'],
				'mobile' => $_POST['Mobile'],
				'phone' => $_POST['Phone']
			
			));
			
			$req->closeCursor();
			
			header("Location:../../admin.php?edit=on");
	
			exit;

		}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

}else{
	
	header("Location:../../admin.php");

	exit;

}

?>
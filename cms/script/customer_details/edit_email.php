<?php

include '../../../static_block/bdd.php';

if($_POST['Email'] != ''){

	try
		{
			
			$req = $bdd->prepare("UPDATE information SET Email= :email");
			
			$req->execute(array(
				'email' => $_POST['Email']
			));
			
			$req->closeCursor();
			
			header("Location:admin.php?email=on");
	
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
<?php

include '../../../static_block/bdd.php';

if($_POST['Address'] != ''){

	try
		{

			$req = $bdd->prepare("UPDATE information SET Address= :address");
			
			$req->execute(array(
				
				'address' => $_POST['Address']
			
			));
			
			$req->closeCursor();
			
			header("Location:../../admin.php?address=on");
	
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
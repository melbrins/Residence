<?php

include '../../../static_block/bdd.php';


try
	{

		$req = $bdd->prepare("UPDATE information SET Facebook= :facebook, Google= :google, Twitter= :twitter, Pinterest= :pinterest");
		
		$req->execute(array(
			
			'facebook' => $_POST['sl_facebook'],
			'google' => $_POST['sl_google'],
			'twitter' => $_POST['sl_twitter'],
			'pinterest' => $_POST['sl_pinterest'],
		
		));
		
		$req->closeCursor();
		
		header("Location:../../admin.php?edit=on");

		exit;

	}

catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}


?>
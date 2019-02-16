<?php

include '../../../static_block/bdd.php';

try
{

	$req = $bdd->prepare("UPDATE aboutus SET Intro= :intro, About= :about");

	$req->execute(array(
		
		'intro' => htmlentities($_POST['Intro']),
		'about' => htmlentities($_POST['About'])							
	
	));

	$req->closeCursor();

	header("Location:../../admin.php?page=about&edit=on");

	exit;

}

catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}

?>
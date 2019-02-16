<?php

include '../../../static_block/bdd.php';

try
{

	$array = array_keys($_POST);

	foreach ($_POST as $name => $value) {

		$req= $bdd->prepare('UPDATE screen SET Ordre = :val WHERE ID= :id');
		
		//We apply the modification to all the property selected
		$req->execute(array(
			
			'val' => $value,
			'id' => $name
		
		));

	}
	
	header("Location:../../admin.php?page=screen&edit=on");

	exit;

}

catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}

?>
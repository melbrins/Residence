<?php

include '../../../static_block/bdd.php';

try
{

	$array = array_keys($_POST);

	foreach ($array as $value) 
	{
		
		$req= $bdd->prepare("UPDATE property SET Home = 'false' AND Ordre = 0 WHERE Reference= :ref");
		
		//We apply the modification to all the property selected
		$req -> execute(array(
			
			'ref' => $value
		
		));
	}
	
	header("Location:../../admin.php?page=home&delete=on");

	exit;

}

catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}

?>
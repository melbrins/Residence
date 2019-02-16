<?php

include '../../../static_block/bdd.php';

$Id=$_POST['Clef'];
$page=$_POST['Page'];
$ref=$_POST['Ref'];

try
	{

		$req = $bdd->prepare("UPDATE property SET Tenure= :tenure, GroundRent= :ground, LocalAuthority= :local, TotalSq= :total, ServiceCharge= :service, CouncilTax= :coucil, EpcCurrent= :current, EpcPotential = :potential, Type = :type, Bedroom = :bed, Date= NOW() WHERE ID='$Id'");
		$req->execute(array(
		
			'tenure' => $_POST['Tenure'],
			'ground' => $_POST['GroundRent'],
			'local' => $_POST['LocalAuthority'],
			'total' => $_POST['TotalSq'],
			'service' => $_POST['ServiceCharge'],
			'coucil' => $_POST['CouncilTax'],
			'current' => $_POST['EpcCurrent'],
			'potential' => $_POST['EpcPotential'],
			'type' => $_POST['Type'],
			'bed' => $_POST['Bedroom']
		
		));
		
		$req->closeCursor();
		
		header("Location:../../property_edit_room.php?page=".$page."&edit=on&reference=".$ref);

		exit;
	}

catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}
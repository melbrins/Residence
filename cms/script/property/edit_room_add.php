<?php

include '../../../static_block/bdd.php';

$page=$_POST['Page'];
$ref=$_POST['Ref'];

try
	{

		$req = $bdd -> prepare("INSERT INTO room (Title, Size, Description, Reference) VALUE ( :title, :size, :description, :ref)");
		
		$req -> execute(array(
		
			'title' => htmlentities($_POST['RoomTitle']),
			'size' => htmlentities($_POST['RoomSize']),
			'description' => htmlentities($_POST['RoomDescription']),
			'ref' => htmlentities($_POST['Ref'])
		
		));

		$req->closeCursor();
		
		header("Location:../../property_edit_room.php?page=".$page."&add=on&reference=".$ref);

		exit;

	}

catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}

?>
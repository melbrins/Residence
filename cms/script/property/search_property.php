<?php

include '../../../static_block/bdd.php';

$ref=$_POST['ref_property'];
$page=$_POST['Page'];

try
	{

		$req = $bdd -> query("SELECT * FROM property WHERE Reference= '$ref'");
		$nsh = $bdd -> query("SELECT Page FROM property WHERE Reference= '$ref'");

		$num_rows = $req -> fetchColumn();

		if ($num_rows > 0) { 

			while ($donnees=$nsh->fetch())
			{
				
				$property_page = $donnees['Page'];

			}

			//On arrete la lecture de la table.
			$nsh -> closeCursor();
			
			// Yes there is a property with this reference
			header("Location:../../property_edit_overview.php?page=".$property_page."&reference=".$ref);

			exit;

		}else{
			
			// No there is no property with this reference 
			header("Location:../../admin.php?page=".$page."&reference=no");
		
			exit;

		} 
		
		$req -> closeCursor();
		
	}

	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
	
?>
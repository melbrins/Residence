<?php

include '../../../static_block/bdd.php';

try
	{

		$req= $bdd->query("SELECT * FROM information");
			
		$donnees = $req->fetch();

		if($donnees['Phone'] != $_POST['Phone'] AND $_POST['Phone'] != '')
		{

			try
			{

				$req = $bdd->prepare("UPDATE information SET Phone= :phone");
				
				$req->execute(array(
					'phone' => $_POST['Phone']
				));

				$req->closeCursor();
			
				header("Location:admin.php?phone=on");
			
				exit;

			}

			catch(Exception $e)
			{
				die('Erreur : ' .$e->getMessage());
			}

		}else{
			
			header("Location:admin.php?phone=off");
		
			exit;

		}
	}
	
	catch(Exception $e)
	{
			die('Erreur : ' .$e->getMessage());
	}
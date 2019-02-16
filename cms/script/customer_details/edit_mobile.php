<?php

include '../../../static_block/bdd.php';

try
	{

		$req= $bdd->query("SELECT * FROM information");
			
		$donnees = $req->fetch();
	
		if($donnees['Mobile'] != $_POST['Mobile'] AND $_POST['Mobile'] != '')
		{
			try
			{
					$req = $bdd->prepare("UPDATE information SET Mobile= :mobile");
					
					$req->execute(array(
						'mobile' => $_POST['Mobile']
					));
					
					$req->closeCursor();

					header("Location:admin.php?mobile=on");
			
					exit;

			}

			catch(Exception $e)
			{
				die('Erreur : ' .$e->getMessage());
			}

		}else{
			
			header("Location:admin.php?mobile=off");
		
			exit;

		}
	}
	
	catch(Exception $e)
	{
			die('Erreur : ' .$e->getMessage());
	}
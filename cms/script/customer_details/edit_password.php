<?php
	
	session_start(); // On démarre la session AVANT toute chose
	
	include '../../../static_block/bdd.php';

	try
		{

			$req= $bdd->query("SELECT * FROM information");
				
			$donnees = $req->fetch();
		
			if($donnees['Password'] == $_POST['c_password']){
		
				if($_POST['n_password'] == $_POST['r_password'] AND $_POST['n_password'] != '' AND $_POST['r_password'] != ''){
				
				try
				{
					$req = $bdd->prepare("UPDATE information SET Password= :password");
					
					$req->execute(array(
						'password' => $_POST['n_password']
					));

					$req->closeCursor();

					$_SESSION['password'] = $_POST['n_password'];
					header("Location:../../admin.php?psd=on");
				
					exit;

				}

				catch(Exception $e)
				{
					die('Erreur : ' .$e->getMessage());
				}

			}else{
				
				header("Location:../../admin.php?psd=none");
			
				exit;

			}

			}else{
			
				header("Location:../../admin.php?psd=off");
			
				exit;

			}
		}

	catch(Exception $e)
	{
			die('Erreur : ' .$e->getMessage());
	}

?>
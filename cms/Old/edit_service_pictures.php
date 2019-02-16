<?php
$num=$_POST['Clef'];
$ref=$_POST['Ref'];
$page=$_POST['Page'];
//On verifie si la case delete a ete coché
if(isset($_POST['delete'])){
	// Si c'est le cas on se connecte a la base de données
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=reside_1', 'root', 'root', $pdo_options);
		
		//Grace a la clef recupéré dans l'input Hidden du formulaire concerné, on elimine la bonne ligne.
		//On prepare la ligne avec la variable de la page et l'ID
		$slider = $bdd->query("SELECT Pictures FROM property WHERE Reference='$ref'");
		$myarray = Array();
		//On lance la boucle pour créer toutes les images.
		while ($donnees = $slider->fetch())
		{
			$images = explode(';', $donnees['Pictures']);
			$myarray = array_merge($myarray,$images);
			$number = count($myarray);
			$number = $number-1;
		}
		for($i = 0; $i <= $number ;$i++){
			
			if($myarray[$i] != null){
			
				if($i == $num){
			
					$pictures = $pictures;
			
				}else if($i == $number){

					$pictures= $pictures.$myarray[$i];
				
				}else{
				
					$pictures= $pictures.$myarray[$i].";";
				
				}
			
			}
		}
		//On arrete la lecture de la table.
		$slider->closeCursor();
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=reside_1', 'root', 'root', $pdo_options);
		$req = $bdd->query("UPDATE property SET Pictures= '$pictures' WHERE Reference='$ref'");
		$req->closeCursor();
		//On relance la page avec la notion supp=on ui declenche l'affichage d'un message de confirmation de suppression
		header("Location:../../property_edit_picture.php?page=".$page."&delete=on&reference=".$ref);
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
}else if(isset($_FILES['Image']) AND $_FILES['Image']['error'] == 0)
{
	//Testons si le fichier n'est pas trop gros
	if($_FILES['Image']['size']<= 1000000)
	{
		//Testons si l'extension est autorisée
		$infosfichier = pathinfo($_FILES['Image']['name']);
		$extension_upload = strtolower($infosfichier['extension']);
		$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
		//On récupère le nom de l'image
		$ImageNews = getimagesize($_FILES['Image']['tmp_name']);
		if (in_array($extension_upload, $extensions_autorisees))
		{			
			$NomImageExploitable = time();	

			//On crée une variable pour récupérer le nouveau nom complet de l'image.
			$Nom_nouvelleImage = $NomImageExploitable.'.'.$extension_upload;
			
			//On peut valider le fichier et le stocker définitivement
			move_uploaded_file($_FILES['Image']['tmp_name'], '/images/'. basename($Nom_nouvelleImage));
				try
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host=localhost;dbname=reside_1', 'root', 'root', $pdo_options);
					$slid = $bdd->query("SELECT Pictures FROM property WHERE Reference='$ref'");
					$myarray = Array();
					//On lance la boucle pour créer toutes les images.
					while ($donnees = $slid->fetch())
					{
						$images = explode(';', $donnees['Pictures']);
						$myarray = array_merge($myarray,$images);
						$myarray[$num] = "images/".$Nom_nouvelleImage;
						$number = count($myarray);
						$number= $number-1;
					}
					for($i = 0; $i < count($myarray);$i++){
						if($i == $number)
						{
							$pictures= $pictures.$myarray[$i];
						}else{
							$pictures= $pictures.$myarray[$i].";";
						}
					}
					//On arrete la lecture de la table.
					$slid->closeCursor();
				}
				//Au cas ou ca ne fonctionne pas :
				catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
				try
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host=localhost;dbname=reside_1', 'root', 'root', $pdo_options);
					$req = $bdd->query("UPDATE property SET Pictures= '$pictures' WHERE Reference='$ref'");
					$req->closeCursor();
					header("Location:../../property_edit_picture.php?page=".$page."&edit=on&reference=".$ref);
				}
				catch(Exception $e)
				{
					die('Erreur : ' .$e->getMessage());
				}					
		}else{
			header("Location:../../property_edit_picture.php?page=".$page."&ext=on");
		}
	}else{
		header("Location:../../property_edit_picture.php?page=".$page."&size=on");
	}
}

?>
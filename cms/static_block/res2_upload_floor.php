<?php
	
	//Testons si l'extension est autorisée
	$infosfichier = pathinfo($_FILES['Image']['name']);
	$extension_upload = strtolower($infosfichier['extension']);
	$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
	
	//On récupère le nom de l'image
	$ImageNews = getimagesize($_FILES['Image']['tmp_name']);

	if (in_array($extension_upload, $extensions_autorisees))
	{
		if($extension_upload == 'png')
		{

			//On sauvegarde l'image temporaire avec son format
			$ImageChoisie = imagecreatefrompng($_FILES['Image']['tmp_name']);
			
			//On recupere sa taille
			$TailleImageChoisie = getimagesize($_FILES['Image']['tmp_name']);
		
			//On definie la largeur qu'elle doit avoir au final
			$NouvelleLargeur = $new_width;
		
			//On defini la nouvelle hauteur proportionnelement par rapport a la largeur de l'image de base.
			$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
			
			$NouvelleImg = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die ("Erreur"); 
			imagecolortransparent($NouvelleImg, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($NouvelleImg, false);
			imagesavealpha($NouvelleImg, true);
			imagecopyresampled($NouvelleImg, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
			
		}else{

			//On sauvegarde l'image temporaire avec son format
			$ImageChoisie = imagecreatefromjpeg($_FILES['Image']['tmp_name']);
		
			//On recupere sa taille
			$TailleImageChoisie = getimagesize($_FILES['Image']['tmp_name']);
			
			//On definie la largeur qu'elle doit avoir au final
			$NouvelleLargeur = $new_width;
			
			//On defini la nouvelle hauteur proportionnelement par rapport a la largeur de l'image de base.
			$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
			
			//On crée une nouvelle image avec les dimensions que l'on vient de definir.
			$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
			
			//on ré-échantillonne la nouvelle image en précisant des paramètres qui doivent vous laisser perplexes.  
			//On place d'abord entre les parenthèses la variable qui correspond à notre image redimensionnée ($NouvelleImage)
			//puis on indique celle que l'on a utilisée ($ImageChoisie). Ensuite, on indique la position relative de la nouvelle image en précisant les éventuels 
			//décalages que l'on veut lui attribuer : ici, j'ai choisi de ne rien décaler, donc j'ai mis 0, 0, 0, 0 pour caler les deux images aux 
			//mêmes coordonnées (abscisses et ordonnées). Puis on précise les nouvelles dimensions de la future image $NouvelleLargeur et $NouvelleHauteur. 
			//Enfin, il ne faut pas oublier de préciser les dimensions de l'ancienne image ($TailleImageChoisie[0] (= la largeur), $TailleImageChoisie[1] (= la hauteur)).
			imagecopyresampled($NouvelleImage, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
		}
		
		//On détruit l'image au grand format de départ
		imagedestroy($ImageChoisie);
		
		//On récupère le nom de l'image sans l'extention.
		$NomImageChoisie = explode('.', $ImageNews);
		
		//On cripte le nom de l'image pour éviter les doublons.
        $NomImageExploitable = time();

		if($extension_upload == 'png'){
		
			//On écrit le nouveau nom de l'image.
			imagepng($NouvelleImg , '../../../images/'.$NomImageExploitable.'.'.$extension_upload);
		
		}else{
			
			//On écrit le nouveau nom de l'image.
			imagejpeg($NouvelleImage , '../../../images/'.$NomImageExploitable.'.'.$extension_upload);
			
		}

		//On crée une variable pour récupérer le nouveau nom complet de l'image.
		$Nom_nouvelleImage = $NomImageExploitable.'.'.$extension_upload;

	}else{

		$issue_extension = true;
		// header("Location:property_add.php?page=".$page."&ext=on");
	}

?>
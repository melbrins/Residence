<?php
	
	//Testons si l'extension est autorisée
	$infosfichier = pathinfo($_FILES['Image']['name']);
	$extension_upload = strtolower($infosfichier['extension']);
	$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
	
	//On récupère le nom de l'image
	$ImageNews = getimagesize($_FILES['Image']['tmp_name']);

	if (in_array($extension_upload, $extensions_autorisees))
	{	
		// echo ('extension autorisee');
		//On recupere sa taille
		$TailleImageChoisie = getimagesize($_FILES['Image']['tmp_name']);
		

		//// THUMBNAIL
		// Define the final width from previous script
		$NouvelleLargeur = $new_width;
		// We keep the ratio based on the new width
		$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );

		//// SHOP SCREEN SLIDE
		// SPECIAL: Define the shop screen slide width
		$NouvelleLargeurXL = $new_widthXL;
		// SPECIAL: We keep the ratio based on the new width for the shop screen slide
		$NouvelleHauteurXL = ( ($TailleImageChoisie[1] * (($NouvelleLargeurXL)/$TailleImageChoisie[0])) );


		if($extension_upload == 'png')
		{

			// On sauvegarde l'image temporaire avec son format
			$ImageChoisie = imagecreatefrompng($_FILES['Image']['tmp_name']);
			
			//// THUMBNAIL
			// Create the empty image
			$NouvelleImg = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die ("Erreur"); 
			imagecolortransparent($NouvelleImg, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($NouvelleImg, false);
			imagesavealpha($NouvelleImg, true);

			// Copy the image in the empty one
			imagecopyresampled($NouvelleImg, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
			

			//// SHOP SCREEN SLIDE
			// Create the empty image for the slide
			$NouvelleImgXL = imagecreatetruecolor($NouvelleLargeurXL, $NouvelleHauteurXL) or die ("Erreur"); 
			imagecolortransparent($NouvelleImgXL, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($NouvelleImgXL, false);
			imagesavealpha($NouvelleImgXL, true);

			// Copy the image in the empty one
			imagecopyresampled($NouvelleImgXL, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeurXL, $NouvelleHauteurXL, $TailleImageChoisie[0],$TailleImageChoisie[1]);

			
		}else if($extension_upload == 'gif'){

			// On sauvegarde l'image temporaire avec son format
			$ImageChoisie = imagecreatefromgif($_FILES['Image']['tmp_name']);
			
			//// THUMBNAIL
			// Create the empty image
			$NouvelleImg = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die ("Erreur"); 
			imagecolortransparent($NouvelleImg, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagefill($NouvelleImg, 0, 0, IMG_COLOR_TRANSPARENT); 
			imagealphablending($NouvelleImg, false);
			imagesavealpha($NouvelleImg, true);

			// Copy the image in the empty one
			imagecopyresampled($NouvelleImg, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);

			//// SHOP SCREEN SLIDE
			// Create the empty image for the slide
			$NouvelleImgXL = imagecreatetruecolor($NouvelleLargeurXL, $NouvelleHauteurXL) or die ("Erreur"); 
			imagecolortransparent($NouvelleImgXL, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagefill($NouvelleImgXL, 0, 0, IMG_COLOR_TRANSPARENT); 
			imagealphablending($NouvelleImgXL, false);
			imagesavealpha($NouvelleImgXL, true);
			
			// Copy the image in the empty one
			imagecopyresampled($NouvelleImgXL, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeurXL, $NouvelleHauteurXL, $TailleImageChoisie[0],$TailleImageChoisie[1]);

		}else{

			// On sauvegarde l'image temporaire avec son format
			$ImageChoisie = imagecreatefromjpeg($_FILES['Image']['tmp_name']) or die ("Erreur");

			//// THUMBNAIL
			// Create the empty image
			$NouvelleImg = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
			//on ré-échantillonne la nouvelle image en précisant des paramètres qui doivent vous laisser perplexes.  
			//On place d'abord entre les parenthèses la variable qui correspond à notre image redimensionnée ($NouvelleImage)
			//puis on indique celle que l'on a utilisée ($ImageChoisie). Ensuite, on indique la position relative de la nouvelle image en précisant les éventuels 
			//décalages que l'on veut lui attribuer : ici, j'ai choisi de ne rien décaler, donc j'ai mis 0, 0, 0, 0 pour caler les deux images aux 
			//mêmes coordonnées (abscisses et ordonnées). Puis on précise les nouvelles dimensions de la future image $NouvelleLargeur et $NouvelleHauteur. 
			//Enfin, il ne faut pas oublier de préciser les dimensions de l'ancienne image ($TailleImageChoisie[0] (= la largeur), $TailleImageChoisie[1] (= la hauteur)).
			imagecopyresampled($NouvelleImg, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
			
			//// SHOP SCREEN SLIDE
			// Create the empty image for the slide
			$NouvelleImgXL = imagecreatetruecolor($NouvelleLargeurXL , $NouvelleHauteurXL) or die ("Erreur");

			// Copy the image in the empty one
			imagecopyresampled($NouvelleImgXL, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeurXL, $NouvelleHauteurXL, $TailleImageChoisie[0],$TailleImageChoisie[1]);

		}
		
		//On détruit l'image au grand format de départ
		imagedestroy($ImageChoisie);
		
		//On cripte le nom de l'image pour éviter les doublons.
        $NomImageExploitable = time();

		if($extension_upload == 'png'){
			
			//// THUMBNAIL
			// We define the new name of the picture.
			imagepng($NouvelleImg , '../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload);

			//// SHOP SCREEN SLIDE
			// We define the new name of the picture.
			imagepng($NouvelleImgXL , '../../../'.$cheminXL.'/'.$NomImageExploitable.'.'.$extension_upload);
		
		}else if ($extension_upload == 'gif'){

			//// THUMBNAIL
			// We define the new name of the picture.
			imagegif($NouvelleImg , '../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload);

			//// SHOP SCREEN SLIDE
			// We define the new name of the picture.
			imagegif($NouvelleImgXL , '../../../'.$cheminXL.'/'.$NomImageExploitable.'.'.$extension_upload);

		}else{
			
			//// THUMBNAIL
			// We define the new name of the picture.
			imagejpeg($NouvelleImg , '../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload);

			//// SHOP SCREEN SLIDE
			// We define the new name of the picture.
			imagejpeg($NouvelleImgXL , '../../../'.$cheminXL.'/'.$NomImageExploitable.'.'.$extension_upload);
			
		}

		//On crée une variable pour récupérer le nouveau nom complet de l'image.
		$Nom_nouvelleImage = $NomImageExploitable.'.'.$extension_upload;

	}else{

		$issue_extension = true;
	}

?>
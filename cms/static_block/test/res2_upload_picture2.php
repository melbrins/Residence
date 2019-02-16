<?php
	
	//Testons si l'extension est autorisée
	$infosfichier = pathinfo($_FILES['Image']['name']);
	$extension_upload = strtolower($infosfichier['extension']);
	$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
	
	//On récupère le nom de l'image
	$ImageNews = getimagesize($_FILES['Image']['tmp_name']);

	if (in_array($extension_upload, $extensions_autorisees))
	{

		//On recupere sa taille
		$TailleImageChoisie = getimagesize($_FILES['Image']['tmp_name']);
		
		//On definie la largeur qu'elle doit avoir au final
		$new_w = $new_width;
		
		//On defini la nouvelle hauteur proportionnelement par rapport a la largeur de l'image de base.
		$new_h = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );

		//On cripte le nom de l'image pour éviter les doublons.
		$NomImageExploitable = time();

		//On crée une variable pour récupérer le nouveau nom complet de l'image.
		$Nom_nouvelleImage = $NomImageExploitable.'.'.$extension_upload;

		$newImage = '../../../'.$chemin.'/'.$Nom_nouvelleImage; //full path

		$dst_img = imagecreatetruecolor($new_w,$new_h);

        /* fix PNG transparency issues */                       
        imagefill($dst_img, 0, 0, IMG_COLOR_TRANSPARENT);         
        imagesavealpha($dst_img, true);      
        imagealphablending($dst_img, true);                 
        imagecopyresampled($dst_img,$img,0,0,0,0,$new_w,$new_h,imagesx($img),imagesy($img));


	    switch($extension_upload)
          {

           case 'png' : $img = imagepng($dst_img,'../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload,9);
           break;
           
           case 'jpg' : $img = imagejpeg($dst_img,'../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload,100);
           break;
           
           case 'jpeg' : $img = imagejpeg($dst_img,'../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload,100);
           break;
           
           case 'gif' : $img = imagegif($dst_img,'../../../'.$chemin.'/'.$NomImageExploitable.'.'.$extension_upload);
           break;
          
          }

	     imagedestroy($dst_img);

	}else{

		$issue_extension = true;
		// header("Location:property_add.php?page=".$page."&ext=on");
	}

?>
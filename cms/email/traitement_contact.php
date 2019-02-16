<?php
try
	{
		include '../../static_block/bdd.php';
		
		//On r�cup�re tout le contenu de la table news
		$Info = $bdd->query('SELECT * FROM information');
		//On lance la boucle pour cr�er toutes les images.
		while ($donnees = $Info->fetch())
		{

			// (1) Code PHP pour traiter l'envoi de l'email
				  
			// R�cup�ration des variables et s�curisation des donn�es
            if (isset($_POST['firstname']) AND $_POST['firstname'] != null){
                exit;
            }

            $name = htmlentities($_POST['name']); // htmlentities() convertit des caract�res "sp�ciaux" en �quivalent HTML
            $email = htmlentities($_POST['email']);
            $phone = htmlentities($_POST['phone']);
            $message = htmlentities($_POST['message']); 

			// Variables concernant l'email
			$destinataire = $donnees['Email']; //'melbrins@gmail.com'; // Adresse email du webmaster (� personnaliser)
			$sujet = 'Contact'; // Titre de l'email
			$contenu = '<style type="text/css">
    .ExternalClass{width:100% !important;}
    a.link:hover{text-decoration:underline !important;}
    a.link2:hover{text-decoration:none !important;}

    .appleLinks a {color:#404041; text-decoration:none;}
</style>

<!-- START Page table-->
<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#f7f6f5">

    <tr>
        <td style="padding:12px 10px 40px;">

            <!-- START Email table-->
            <table width="700" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">

                <tr>
                    <td align="center" valign="top">

                        <!-- [ header starts here] -->
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">

                            <tr>
                                <td colspan="2" style="height:10px;" height="10"></td>
                            </tr>
                            <tr>
                                <td width="480" style="width:480px; padding:0 0 0 20px;">

                                    <font style="font-size:10px; font-family:arial, helvetica, sans-serif; color:#818285;">'.$title.' '.$name.' sent you an email</font>

                                </td>

                                <td width="180" style="width:180px; text-align:right; padding:0 20px 0 0;">
                                    <a href="mailto:'.$email.'" style="font-size:12px; font-family: Arial, helvetica, sans-serif; color:#EF7F00; text-decoration:underline;">Reply to this email</a>
                                </td>
                            </tr>

                            <tr><td height="10" style="font-size:0; line-height:0; border-bottom:1px solid #dddddd" colspan="2">&nbsp;</td></tr>

                            <tr>
                                <td>
                                    <a style="color:#7d479f;" href="http://www.residenceestates.com/index.php">
                                        <img src="http://www.residenceestates.com/images/logo.png" alt="Residence" border="0"/>
                                    </a>
                                </td>

                                <td>
                                    <!-- <font style="font-size:36px; font-family: Arial, Helvetica, sans-serif; font-weight:bold; color:#552F01;">Contact Us</font> -->
                                </td>
                            </tr>

                            <tr><td height="5" style="font-size:0; line-height:0; background-color:#EF7F00;" colspan="2">&nbsp;</td></tr>


                            <tr>
                                <td style="padding:30px 20px 40px;" colspan="2">
                                    <table width="100%" cellpadding="0" cellspacing="0">

                                        <tr>
                                            <td style="padding:0 0 40px;">
                                                <font style="font-size:20px; font-family: Arial, Helvetica, sans-serif; line-height:22px; color:#552F01;">
                                                    <b>'.$title.' '.$name.' sent you an email</b>
                                                </font>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:0 0 20px;">
                                                <font style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:16px; color:#404041;">
                                                    <b>Email :</b> '.$email.'
                                                </font>
                                            </td>
                                        </tr>

                                         <tr>
                                            <td style="padding:0 0 20px;">
                                                <font style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:16px; color:#404041;">
                                                    <b>Message:</b> '.nl2br($message).'
                                                </font>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:40px 0 20px 0;">
                                                <a href="mailto:'.$email.'">
                                                    <img src="http://www.melbrins.com/residence/cms/email/images/btn_reply.jpg" width="100" height="25"/>
                                                </a>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr style="background-color:#EF7F00;">
                                            <td style="padding:5px 0 6px 20px;">
                                                <a href="http://www.melbrins.com/residence/cms/login.php" style="font-size:10px; font-family:Arial, Helvetica, sans-serif; color:#ffffff;">Administration</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>


                        </table>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <img src="http://www.melbrins.com/residence/cms/email/images/bottom_email.jpg" border="0" align="top" style="vertical-align:top;" width="700" height="20" alt="Bottom Email" />
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>';
			$contenu .= '</body></html>'; // Contenu du message de l'email (en XHTML)
				  
			// Pour envoyer un email HTML, l'en-t�te Content-type doit �tre d�fini
			$headers = 'MIME-Version: 1.0'."\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
            $headers .= '<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />'."\r\n";
				  
			// Envoyer l'email
			$sent = mail($destinataire, $sujet, $contenu, $headers);
	
		    if($sent){  
		        echo 'sent'; // we are sending this text to the ajax request telling it that the mail is sent..
                header("Location:../../contact-us.php?sent=success");
		    }else{  
		        echo 'failed';// ... or this one to tell it that it wasn't sent  
                header("Location:../../contact-us.php?sent=fail");
		    }
	
		}
	//On arrete la lecture de la table.
	$Info->closeCursor();
	}
	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
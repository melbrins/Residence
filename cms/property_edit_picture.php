<?php
session_start(); 

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

	// WE check that we have the information to display the page properly.
	if(isset($_GET['page']) AND isset($_GET['reference'])){

		$currentpage = $_GET['page'];
		$ref = $_GET['reference'];
	
	}else{
	
		// If we don't have the information we need we go back on the admin page.
		header("Location:admin.php?info=off");
	
	}

	try
		{
								
			//We take on the database the property we want to edit.
			$Property = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");

		}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="js/jquery.js"></script>
	<script src="js/jquery.tools.min.js"></script>
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	<link href="css/cms-ie.css" type="text/css" rel="stylesheet" media="screen"/>

</head>

<body>

<div id="header">

	<div id="logo">
		
		<a href="../index.php">
			<img src="../images/logo_cms.png" alt="Logo Residence Estate" height="50px"/>
		</a>
	
	</div><!-- END : Logo -->

	<div id="company">
	
		<h1><span style="color:#552F01">RESIDENCE</span> <span style="color:#EF7F00">ESTATES</span></h1>
	
	</div><!-- END : company -->

</div><!-- END : Header -->

<div id="navigation">
	
	<?php include 'static_block/admin_menu.php'; ?>

</div><!-- END : Navigation -->

<?php

	//On lance la boucle pour créer toutes les images.
	while ($donnees = $Property->fetch())
		{

			$homepage_picture= $donnees['Pictures'];

			if($donnees['Statut'] == 'Archive'){
			
				$currentpage = 'archive';
			
			}

?>

			<div class="page">

				<h2>Property - <?php if($donnees['Page'] != 'commercial' OR $donnees['Page'] != 'short'){ ?>To <?php } echo $donnees['Page']; ?> - "<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>"</h2>

				<?php include '../static_block/message.php'; ?>

				<div class="property_pictures  push">

					<div class="menu_property">

						<ul>
						
							<li class="float"><a href="property_edit_overview.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Overview</a></li>
						
							<li class="float"><a href="property_edit_details.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Details</a></li>
						
							<li class="float"><a href="property_edit_room.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Room</a></li>
						
							<li class="float selected"><a href="property_edit_picture.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Pictures</a></li>
						
							<li class="right"><a href="admin.php?page=<?php echo $currentpage; ?>">Back to list</a></li>

							<li style="clear:both;"></li>

						</ul>

					</div><!-- END : Menu_property -->

					<ul>

							<li class="content_gallery" style="width:260px;">

								<form method="post" action="script/property/add_picture.php" enctype="multipart/form-data">

									<input type="hidden" name="Page" value="<?php  echo $currentpage; ?>"/>
									<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
									
									<div class="picture_gallery">
										
										<img src="../images/new_picture.jpg" alt="pictures"/>
									
									</div><!-- END : picture_gallery -->

									<div class="form_gallery">
									
										<div class="btn_upload">
									
											<input type="file" name="Image"/>
									
										</div>

										<div class="res2-btn">

											<button class="btn" type="submit">
												
												<span>Add</span>

											</button>

										</div>
									
									</form>

								</div><!-- END : form_gallery -->

							</li>

						

						<?php

							try{

								$slid = $bdd->query("SELECT * FROM property_picture WHERE Reference='$ref' ORDER BY ID DESC");

								//On lance la boucle pour créer toutes les images.
								while ($donnees = $slid->fetch())
								{
							
							?>

									<li class="content_gallery">
											
										

										<div class="picture_gallery">
											<img src="../images/<?php echo $donnees['Picture'];?>" alt="pictures" height="270"/>
										</div>

										<div class="form_gallery">
											<form method="post" action="script/property/edit_picture.php" enctype="multipart/form-data">
												<div class="btn_upload">
												
													<input type="file" name="Image"/>
												
												</div>

												<div class="delete_box">
												
													<input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label>
												
												</div>

												<div class="delete_box">
												
													<input type="checkbox" name="select" id="select" <?php if($donnees['Picture'] == $homepage_picture){echo('checked="checked"');}?>/><label for="select">Homepage Picture</label>
												
												</div>

												<input type="hidden" name="Id" value="<?php echo $donnees['ID']; ?>"/>
												<input type="hidden" name="Ref" value="<?php echo $ref; ?>"/>
												<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
												<input type="hidden" name="old_picture" value="<?php echo $donnees['Picture']?>"/>

												<div class="res2-btn">

													<button class="btn" type="submit">
														
														<span>Submit</span>

													</button>

												</div>
											</form>
										</div><!-- END : .form_gallery -->
									
									</li><!-- END : .content_gallery -->

							<?php 		

								}
								//On arrete la lecture de la table.
								$slid->closeCursor();
							}

							//Au cas ou ca ne fonctionne pas :
							catch (Exception $e)
							{
								die('Erreur : ' . $e->getMessage());
							}

						?>	

					</ul>

				</div><!-- END : property_pictures -->

			</div><!-- END : page -->

<?php

		if($donnees['Statut'] == 'Archive'){

			$currentpage = 'archive';
		
		}

?>
		
		<style type="text/css">
		
			#<?php echo $currentpage; ?> a, #<?php echo $currentpage; ?> a:link { color:#FFF;}
		
		</style>

<?php

	}
	//We stop the current cursor.
	$Property->closeCursor();

?>

	<!-- Change page in fonction of the url -->
	<script>
		
		var page = '<?php echo $currentpage; ?>'; 

		$(document).ready(function(){

				$('.menu').removeClass('active');
				$('#'+ page).addClass('active');	
		
		});
	
	</script>
	
	<script type="text/javascript" src="js/cms_script.js"></script>

</body>

</html>
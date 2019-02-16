<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.tools.min.js"></script>
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	<link href="css/cms-ie.css" type="text/css" rel="stylesheet" media="screen"/>

</head>

<body>
<?php

	// WE check that we have the information to display the page properly.
	if(isset($_GET['page']) AND isset($_GET['reference'])){

		$currentpage = $_GET['page'];
		$ref = $_GET['reference'];

	}else{

		// If we don't have the information we need we go back on the admin page.
		header("Location:admin.php?info=off");

		exit;

	}

	try{

			//We take on the database the property we want to edit.
			$Property = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
			$Property_details = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
	
		}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>

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

?>
			<div class="page">

				<h2>Property - <?php if($donnees['Page'] != 'commercial' OR $donnees['Page'] != 'short'){ ?>To <?php } echo $donnees['Page']; ?> - "<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>"</h2>
				<?php include '../static_block/message.php'; ?>
				
				<div class="property_details  push">

					<div class="menu_property">

						<ul>
					
							<li class="float"><a href="property_edit_overview.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Overview</a></li>
					
							<li class="float selected"><a href="property_edit_details.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Details</a></li>
					
							<li class="float"><a href="property_edit_room.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Room</a></li>
					
							<li class="float"><a href="property_edit_picture.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Pictures</a></li>
					
							<li class="right"><a href="admin.php?page=<?php echo $currentpage; ?>">Back to list</a></li>
					
							<li class="clear"></li>
					
						</ul>

					</div><!-- END : Menu_property -->

		<?php

			//On lance la boucle pour créer toutes les images.
			while ($donnees = $Property_details->fetch())
				{

		?>
					
					<ul class="details">

						<form method="post" action="script/property/edit_details.php">

							<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
							<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
							<input type="hidden" name="Page" value="<?php  echo $donnees['Page']; ?>"/>
							
							<li class="float">
								
								<div class="res2-row">

									<label for="Tenure">Tenure</label>
									<span class="text-holder"><input class="input" type="text" name="Tenure" value="<?php echo stripslashes($donnees['Tenure']);?>"></span>

								</div>
								
							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="GroundRent">Ground Rent</label>
									<span class="text-holder"><input class="input" type="text" name="GroundRent" value="<?php echo stripslashes($donnees['GroundRent']);?>"></span>

								</div>
					
							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="LocalAuthority">Local Authority</label>
									<span class="text-holder"><input class="input" type="text" name="LocalAuthority" value="<?php echo stripslashes($donnees['LocalAuthority']);?>"></span>

								</div>
					
							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="TotalSq">Total Sq Ft</label>
									<span class="text-holder"><input class="input" type="text" name="TotalSq" value="<?php echo stripslashes($donnees['TotalSq']);?>"></span>

								</div>
							
							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="ServiceCharge">Service Charge</label>
									<span class="text-holder"><input class="input" type="text" name="ServiceCharge" value="<?php echo stripslashes($donnees['ServiceCharge']);?>"></span>

								</div>
						
							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="CouncilTax">Council Tax</label>
									<span class="text-holder"><input class="input" type="text" name="CouncilTax" value="<?php echo stripslashes($donnees['CouncilTax']);?>"></span>

								</div>
					
							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="EpcCurrent">Epc Current</label>
									<span class="text-holder"><input class="input" type="text" name="EpcCurrent" value="<?php echo stripslashes($donnees['EpcCurrent']);?>"></span>

								</div>

							</li>
						
							<li class="float">

								<div class="res2-row">

									<label for="EpcPotential">Epc Potential</label>
									<span class="text-holder"><input class="input" type="text" name="EpcPotential" value="<?php echo stripslashes($donnees['EpcPotential']);?>"></span>

								</div>

							</li>
						
							<li style="clear:both;"></li>
						
							<li class="float" style="width:245px;">
								<div class="res2-row">

									<label for="Statut">Type</label>
									<span class="text-holder">
										<select name="Type" size="1">
					
						<?php
									
									if($donnees['Page'] == 'commercial_buy' OR $donnees['Page'] == 'commercial_rent'){
						
						?>
									
											<option value="Office" <?php if($donnees['Type'] == 'Office'){echo('selected');}?>>Office</option>
											<option value="Shop" <?php if($donnees['Type'] == 'Shop'){echo('selected');}?>>Shop</option>
					
						<?php
						
									}else{
						
						?>
									
											<option value="Flat" <?php if($donnees['Type'] == 'Flat'){echo('selected');}?>>Flat</option>
											<option value="Apartment" <?php if($donnees['Type'] == 'Apartment'){echo('selected');}?>>Apartment</option>
											<option value="Studio" <?php if($donnees['Type'] == 'Studio'){echo('selected');}?>>Studio</option>
											<option value="House" <?php if($donnees['Type'] == 'House'){echo('selected');}?>>House</option>
											<option value="House" <?php if($donnees['Type'] == 'Garage'){echo('selected');}?>>Garage</option>
					
						<?php
						
									}
						
						?>
					
										</select>
									</span>

								</div>

							</li>

					<?php

							if($donnees['Page'] != 'commercial_buy' AND $donnees['Page'] != 'commercial_rent'){
					
					?>

								<li class="float">
									
									<div class="res2-row">

										<label for="Bedroom">Bedroom</label>
										<span class="text-holder">
											<select name="Bedroom" size="1">
								
												<option value="Studio" <?php if($donnees['Bedroom'] == 'Studio'){echo('selected');}?>>Studio</option>
												<option value="1" <?php if($donnees['Bedroom'] == '1'){echo('selected');}?>>1</option>
												<option value="2" <?php if($donnees['Bedroom'] == '2'){echo('selected');}?>>2</option>
												<option value="3" <?php if($donnees['Bedroom'] == '3'){echo('selected');}?>>3</option>
												<option value="4" <?php if($donnees['Bedroom'] == '4'){echo('selected');}?>>4</option>
												<option value="5" <?php if($donnees['Bedroom'] == '5'){echo('selected');}?>>5</option>
												<option value="6+" <?php if($donnees['Bedroom'] == '6'){echo('selected');}?>>6</option>
												<option value="6+" <?php if($donnees['Bedroom'] == '6+'){echo('selected');}?>>6+</option>
									
											</select>
										</span>

									</div>
								
								</li>

					<?php
						
							}
					
					?>
						
							<li style="clear:both;">
						
							<li class="float">

								<div class="res2-btn">
									<button class="btn" type="submit">
										
										<span>Save</span>

									</button>
								</div>
							
							</li>
						</form>					
					</ul><!-- END : details -->

										<div class="title_categorie"><h4>Floor Map</h4></div>					

					<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
					<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
					
					<ul>

							<li class="content_gallery">
								
								<form method="post" action="script/property/add_floor.php" enctype="multipart/form-data">

									<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
									<input type="hidden" name="Page" value="<?php  echo $currentpage; ?>"/>
									
									<img src="../images/new_picture.jpg" alt="pictures"/>
									

									<div class="form_gallery">
									
										<div class="btn_upload">
											<input type="hidden" name="Ref" value="<?php echo $ref; ?>"/>
											<input type="file" name="Image"/>
										</div>

										<div class="res2-btn">
											<button class="btn" type="submit">
												
												<span>Add</span>

											</button>
										</div>
									
									</div><!-- END : form_gallery -->

								</form>
							
							</li>

					<?php

						}

						//We stop the current cursor.
						$Property->closeCursor();
					
						try{

							$slid = $bdd->query("SELECT * FROM floor WHERE Reference='$ref'");

							//On lance la boucle pour créer toutes les images.
							while ($donnees = $slid->fetch())
							{
								
					?>


										<li class="content_gallery">
											
											<form method="post" action="script/property/edit_floor.php" enctype="multipart/form-data">

												<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
												<input type="hidden" name="Ref" value="<?php echo $ref; ?>"/>
												<input type="hidden" name="Page" value="<?php  echo $currentpage; ?>"/>
												
												<img src="../images/map/<?php echo $donnees['Picture']; ?>" alt="Floor Map <?php echo $donnees['Reference']; ?>" height="250px;"/>

												<div class="form_gallery">
													
													<div class="btn_upload">
													
														<input type="file" name="Image"/>
													
													</div>

													<div class="delete_box">
													
														<input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label>
													
													</div>

													<div class="res2-btn">
														<button class="btn" type="submit">
															
															<span>Save</span>

														</button>
													</div>
												
												</div><!-- END : .form_gallery -->
										
											</form>
										
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

		</div><!-- END : property_details -->

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
$Property_details->closeCursor();

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
<!-- Prepare query to have all the area entered on the website -->

<?php
try
	{
		include '/static_block/bdd.php';
							
		//On récupère tout le contenu de la table news
		$Area = $bdd->query("SELECT DISTINCT Area FROM property ORDER BY Area");

	}
	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>





																<!-- HTML HEADER-->
												<?php include("static_block/html-header.php"); ?>





<!-- If no type of property selected, goes to default = buy  --> 

<?php 

	if(isset($_GET['properties'])){

		$Page = $_GET['properties'];

	}else{

		$Page = 'buy';
	
	}

?>



<!-- PAGE TITLE -->

<title><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></title>


<style type="text/css">

	html,body,#container{
	
		height:100%;
	
	}
	
	.ca-menu li.<?php echo $_GET['properties'] ;?>{

    	background: #EF7F00;
	
	}

	.<?php echo $_GET['properties'] ;?>, .<?php echo $_GET['properties'] ;?>:link{background-color:#EF7F00; color:#FFF;}
	
<?php 

		if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){

?>
			#Section2{

				height:75px;
			}

<?php 

		}else{

?>
			#Section1{

				height:75px;
			
			}
	
<?php 

		}

?>

</style>		

<script type="text/javascript" src="js/jquery.min.js"></script>

</head>

<body>

	<div id="contener">

		<div id="sidebar">

			<div id="logo">

				<a href="http://www.residenceestates.com/index.php">
					<img src="images/logo.png" alt="logo"/>
				</a>

			</div>

			<div id="menu">

				<? include 'static_block/menu.php'; ?>

			</div>

		</div>

		<div id="header">

				<img src="images/<?php echo($Page); ?>_header.jpg" border="0" alt="House" style="float:right;" />

				<h1><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></h1>

		</div>

		<div id="content">

			<div id="form_search">

				<form method="get" action="search_result.php" enctype="multipart/form-data">

					<div id="search_details">

						<?php

							if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){

						?>

								<div class="search_title">

										<h3>SEARCH A COMMERCIAL PROPERTY</h3>

								</div>

								<fieldset class="holder">

									<ol>

										<li class="single">
											<label>Commercial type</label>

											<fieldset>

												<select name="Type" size="1">

													<option value="Office" <?php if($donnees['Type'] == 'Office'){echo('selected');}?>>Office</option>
													<option value="Shop" <?php if($donnees['Type'] == 'Shop'){echo('selected');}?>>Shop</option>

												</select>

						<?php

							}else{

						?>

								<div class="search_title">

									<h3>SEARCH A PROPERTY</h3>

								</div>


								<fieldset class="holder">

									<ol>
										<li class="single">	

											<label>Property type</label>

											<fieldset>

												<select name="type" size="1">

													<option value="All_type" selected="selected">All type</option>
													<option value="Studio">Studio</option>
													<option value="Apartment">Apartment</option>
													<option value="Flat">Flat</option>
													<option value="House">House</option>
													<option value="Garage">Garage</option>

												</select>

						<?php

							}
						
						?>
										</li>

										<li>	
											<label>Price</label>
									
										<?php 
									
											if($Page == 'buy' OR $Page == 'commercial_buy'){ 

										?>

												<fieldset>

													<select name="price_from" size="1">

														<?php include("static_block/price_from_commercial.php");?>
																											<!-- Select Price Min Commercial -->
													</select> to <select name="price_max" size="1">
																											<!-- Select Price Max Commercial -->
														<?php include("static_block/price_max_commercial.php");?>

													</select>

												</fieldset>

										<?php 

											}else{ 

										?>

												<fieldset>

													<select name="price_from" size="1">
																											<!-- Select Price Min -->
														<?php include("static_block/price_from.php"); ?>

													</select> to <select name="price_max" size="1">
																											<!-- Select Price Max -->
														<?php include("static_block/price_max.php"); ?>

													</select>

												</fieldset>

										<?php 
									
											}
									
										?>
							
										</li>

										<li class="single">	

											<label>Area</label>

											<fieldset>

												<select name="area" size="1">

													<option value="All_area" selected="selected">All area</option>

													<?php 
															//On lance la boucle pour créer toutes les images.
															while ($donnees = $Area->fetch())
															{
													?>
																
																<option value="<?php echo $donnees['Area']; ?>"><?php echo $donnees['Area']; ?></option>
													<?php
															}
															
															//On arrete la lecture de la table.
															$Area->closeCursor();
													?>
												</select>

											</fieldset>

										</li>

										<?php if($Page != 'commercial_buy' AND $Page != 'commercial_rent'){?>
										
										<li>

											<label>Bedroom</label>

											<fieldset>

												<select name="bedrooms" size="1">
													<option value="0" selected="selected">Studio</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
												</select> to <select name="bedrooms_max" size="1">
													<option value="99" selected="selected">All bedroom</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="99">6+</option>
												</select>
											</fieldset>
										</li>
										<?php } ?>

									</ol>
						
						<input type="hidden" value="<?php echo $_GET['properties']; ?>" name="properties">
						<input type="hidden" value="0" name="nav">
						<input type="hidden" value="10" name="affichage">
						</fieldset>
					</div>
				<div class="submit_form">
					Search
					<input type="image" value="Edit"/>
				</div>
				</form>
			</div>

			<div id="breadcrumbs">
				<ul>
					<li>
						<a href="/index.php" title="Back to home page">Home</a>
						<span> |</span>
					</li>
					<li>
						<span class="current">Search <?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></span>
					</li>
				</ul>
			</div>

			<div id="title_search" class="title">

				<h2><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></h2>

			</div>

		<?php 

			$nav = intval(trim($_GET['nav']));
			$affichage = 10;
			$prems =  $nav * $affichage;

			try
			{

				$count = $bdd->query("SELECT * FROM property WHERE Page='$Page' AND Statut != 'Archive'");
				$rResult = $count->rowCount();
				
			}

			//Au cas ou ca ne fonctionne pas :
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
	
			if($rResult > $affichage){

		?>

			<span class="pagination alone">

					<?php include 'statick_block/pagination_search.php'; ?>

			</span>

		<?php 

			}

		?>

			<div id="result_search">
				<ul>
				<?php
					try
				{
					$count_result=0;

					//We select all the property from the page selected
					$reponse = $bdd->query("SELECT * FROM property WHERE Page='$Page' AND Statut != 'Archive' LIMIT $prems, $affichage");

					//On lance la boucle pour créer toutes les images.
					while ($donnees = $reponse->fetch())
					{

						$chaine=stripslashes($donnees['Short']);
						$max=125;
						if(strlen($chaine)>=$max)
						{
							$chaine=substr($chaine,0,$max);
							$espace=strrpos($chaine," ");
					
							if($espace)
							{
								$chaine=substr($chaine,0,$espace);
								$chaine .= ' [...]';
							}
						}
					$count_result++;
			?>
					
					<?php include 'static_block/property_result.php'; ?>

			<?php
					}
					
					//On arrete la lecture de la table.
					$reponse->closeCursor();
				}
				//Au cas ou ca ne fonctionne pas :
				catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
			?>		
				</ul>

			<?php 

				if($count_result == 0){

			?>
				<div class="empty_message">

					<br>
					<p>We are sorry but we don't have this kind of property currently.</p>
					<br>
					<br>
					
				</div>
			<?php

				}
			?>
			</div>

			<div class="clearfix"></div>

		<?php
	
			if($rResult > $affichage){

		?>

			<span class="pagination alone">
				<?php include("pagination_search.php");?>
			</span>

		<?php 

			}

		?>
			<div id="footer">
		        <?php include 'static_block/footer.php'; ?>
		    </div>

		</div>
	</div>
<script type="text/javascript">
	var arrow_properties = true;
	$('.arrow_link_properties').click(function(){
		if( arrow_properties == true){
			$('.arrow_right_properties').addClass("close");
			$('#Section1').css({height: '75px'});
			arrow_properties = false;
		}else{
			$('.arrow_right_properties').removeClass("close");
			$('#Section1').css({height: '0em'});
			arrow_properties = true;
		}
	});
	var arrow_commercials = true;
	$('.arrow_link_commercials').click(function(){
		if( arrow_commercials == true){
			$('.arrow_right_commercials').addClass("close");
			$('#Section2').css({height: '50px'});
			arrow_commercials = false;
		}else{
			$('.arrow_right_commercials').removeClass("close");
			$('#Section2').css({height: '0em'});
			arrow_commercials = true;
		}
	});
</script>
</body>
</html>
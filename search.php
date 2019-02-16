<?php

	session_start(); 
	session_destroy();

	$_SESSION['properties']=$_GET['properties'];
	$_SESSION['nav']=$_GET['nav'];

	// PDO STATEMENT
	include 'static_block/bdd.php';

	try
		{
								
			//On récupère tout le contenu de la table news
			$Area = $bdd->query("SELECT DISTINCT Area FROM property WHERE Statut != 'Archive' ORDER BY Area");

		}
		
		//Au cas ou ca ne fonctionne pas :
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}

	// HTML HEADER 
	include 'static_block/html-header.php';

	//GET PAGE NAME
	if(isset($_GET['properties'])){
		
		$Page = $_GET['properties'];

	}else{

		$Page = 'buy';

	}

?>

	<title><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?> - Residence Estates</title>

	<style type="text/css">
		html, body, #container{
			height:100%;
		}

		.ca-menu li.<?php echo $_GET['properties'] ;?>{
	    background: #EF7F00;
		}
		
		.<?php echo $_GET['properties'] ;?>, .<?php echo $_GET['properties'] ;?>:link{
			background-color:#EF7F00; 
			color:#FFF;
		}
		
<?php if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){?>
		
		@media only screen and (min-width: 1200px) {
			#Section2{
				height:50px;
			}
		}
		@media only screen and (min-width: 300px) and (max-width: 1200px) {

			.commercials a{border-bottom:3px solid #EF7F00;}

		}
	<?php }else{?>

		@media only screen and (min-width: 1200px) {
			#Section1{
				height:75px;
			}
		}

		@media only screen and (min-width: 300px) and (max-width: 1200px) {

			.properties a{border-bottom:3px solid #EF7F00;}

		}
<?php } ?>
	</style>

</head>

<body>

	<div id="contener" class="search">

		<div id="sidebar">

			<div id="logo">
				<a href="index.php">
					<img src="images/logo.png" alt="logo"/>
				</a>
			</div>

			<div id="menu">
				<? include 'static_block/menu.php'; ?>
			</div>

			<div id="footer">
		        <?php include 'static_block/footer.php'; ?>
		    </div>
		</div>
		
		<div id="header">
				<img src="images/<?php echo($Page); ?>_header.jpg" border="0" alt="House"/>
				<!-- <h1><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></h1> -->
		</div>
		
		<div id="content">

			<div id="form_search">

				<form method="get" action="search_result.php">

					<div id="search_details">

						<?php
							if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){
						?>

						<div class="search_title">
							<a href="#" class="open_search">
								Search for a commercial property
								<span class="tri"></span>
							</a>
						</div>
						<div id="search_content">
						<fieldset class="holder">
						<table>
						
							<tr>
								<td>
									<label>Type</label>
								</td>
								
								<td>
									<fieldset>
										<select name="Type" size="1">
											<option value="Office" <?php if($donnees['Type'] == 'Office'){echo('selected');}?>>Office</option>
											<option value="Shop" <?php if($donnees['Type'] == 'Shop'){echo('selected');}?>>Shop</option>
										</select>
									</fieldset>
							
					<?php
					
						}else{
			

					?>
	
							<div class="search_title">
									<a href="#" class="open_search">
										Search for a property
										<span class="tri"></span>
									</a>
								</div>
							<div id="search_content">
							<fieldset class="holder">
							<table>
								<tr>
									<td>
										<label>Type</label>
									</td>
									<td>
										<fieldset>
											<select name="type" size="1">
												<option value="" selected="selected">All type</option>
												<option value="Studio">Studio</option>
												<option value="Apartment">Apartment</option>
												<option value="Flat">Flat</option>
												<option value="House">House</option>
												<option value="Garage">Garage</option>
											</select>
										</fieldset>
						<?php

							}

						?>
									</td>
								</tr>

								<tr>
									<td>
										<label>Area</label>
									</td>
									<td>
										<fieldset>
											<select name="area" size="1">
												<option value="" selected="selected">All area</option>
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
									</td>
								</tr>

								<tr>
									<td>
										<label>Price</label>
									</td>
									<td>
										<?php if($Page == 'buy' OR $Page == 'commercial_buy'){ ?>
										<fieldset>
											<select name="price_from" size="1">
												<option value="" selected="selected">From cheapest</option>
												<option value="100000">100,000</option>
												<option value="125000">125,000</option>
												<option value="150000">150,000</option>
												<option value="175000">175,000</option>
												<option value="200000">200,000</option>
												<option value="250000">250,000</option>
												<option value="300000">300,000</option>
												<option value="350000">350,000</option>
												<option value="400000">400,000</option>
												<option value="450000">450,000</option>
												<option value="500000">500,000</option>
												<option value="600000">600,000</option>
												<option value="700000">700,000</option>
												<option value="800000">800,000</option>
												<option value="900000">900,000</option>
												<option value="1000000">1,000,000</option>
												<option value="1500000">1,500,000</option>
												<option value="2000000">2,000,000</option>
											</select> to <select name="price_max" size="1">
												<option value="" selected="selected">No price limit</option>
												<option value="100000">100,000</option>
												<option value="125000">125,000</option>
												<option value="150000">150,000</option>
												<option value="175000">175,000</option>
												<option value="200000">200,000</option>
												<option value="250000">250,000</option>
												<option value="300000">300,000</option>
												<option value="350000">350,000</option>
												<option value="400000">400,000</option>
												<option value="450000">450,000</option>
												<option value="500000">500,000</option>
												<option value="600000">600,000</option>
												<option value="700000">700,000</option>
												<option value="800000">800,000</option>
												<option value="900000">900,000</option>
												<option value="1000000">1,000,000</option>
												<option value="1500000">1,500,000</option>
												<option value="2000000">2,000,000</option>
											</select>
										</fieldset>
									<?php }else{ ?>
									<fieldset>
										<select name="price_from" size="1">
											<option value="" selected="selected">From cheapest</option>
											<option value="175">175</option>
											<option value="250">250</option>
											<option value="350">350</option>
											<option value="500">500</option>
											<option value="750">750</option>
											<option value="1000">1,000</option>
											<option value="1500">1,500</option>
											<option value="2000">2,000</option>
											<option value="2500">2,500</option>
											<option value="3000">3,000</option>
											<option value="5000">5,000</option>
										</select> to <select name="price_max" size="1">
											<option value="" selected="selected">No price limit</option>
											<option value="175">175</option>
											<option value="250">250</option>
											<option value="350">350</option>
											<option value="500">500</option>
											<option value="750">750</option>
											<option value="1000">1,000</option>
											<option value="1500">1,500</option>
											<option value="2000">2,000</option>
											<option value="2500">2,500</option>
											<option value="3000">3,000</option>
											<option value="5000">5,000</option>
										</select>
									</fieldset>
									<?php }?>
									</td>
								</tr>

								<?php if($Page != 'commercial_buy' AND $Page != 'commercial_rent'){?>
								<tr>
									<td>
										<label>Bedroom</label>
									</td>
									<td>
										<fieldset>
											<select name="bedroom" size="1">
												<option value="" selected="selected">Studio</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
											</select> to <select name="bedroom_max" size="1">
												<option value="" selected="selected">All bedroom</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="99">6+</option>
											</select>
										</fieldset>
									</td>
								</tr>
								<?php } ?>
							</table>
						
						<input type="hidden" value="<?php echo $_GET['properties']; ?>" name="properties">
						<input type="hidden" value="0" name="nav">
						<input type="hidden" value="10" name="affichage">
						</fieldset>

						<div class="res2-btn">
							<button class="btn brown" type="submit">
								<span>Submit</span>
							</button>
						</div>
						</div>
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
						<span class="current"><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></span>
					</li>
				</ul>
			</div>

			<div id="title_search" class="title">

				<h1><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></h1>

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
				<?php include 'static_block/pagination_search.php';?>
			</span>

		<?php 

			}

		?>

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
			$('#Section1').css({height: '0px'});
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
			$('#Section2').css({height: '0px'});
			arrow_commercials = true;
		}
	});


	// var arrow_search = true;
	// $('.open_search').click(function(){
	// 	if( arrow_search == true){
	// 		$('.search_title').addClass("active");
	// 		$('#search_content').fadeIn(600);
	// 		$('#search_content').css({height: '245px', margin: '20px 0'});
	// 		arrow_search = false;
	// 	}else{
	// 		$('.search_title').removeClass("active");
	// 		$('#search_content').fadeOut(600);
	// 		$('#search_content').css({height: '0px', margin: '0'});
	// 		arrow_search = true;
	// 	}
	// });
</script>

<script type="text/javascript">
    $("#search_content").hide();
    $(".open_search").click(function () {
        $("#search_content").slideToggle(500);
        $(".search_title").toggleClass("active");
    });
</script>

</body>
</html>

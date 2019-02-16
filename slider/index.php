<!-- PDO -->					
<?php include '../static_block/bdd.php'; ?>

<?php 

	try
	{
							
		$Advert = $bdd->query("SELECT * FROM screen WHERE Advertising = 'true' ORDER BY Ordre");
		$Screen = $bdd->query('SELECT * FROM screen ORDER BY Ordre');
		$Screen_banner = $bdd->query('SELECT Category, Ordre FROM screen ORDER BY Ordre');

	}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Residence Estates - Property Showcase</title>

		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
		
		<link rel="stylesheet" href="style/main.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		<link rel="stylesheet" href="style/slider-style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		<link rel="stylesheet" href="style/slider.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		
		<script src="js/modernizr.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/cute/cute.slider.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/cute/cute.transitions.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
		
	</head>
	<body>

	<div id="start-box">
		<span id="start">Start</span>
	</div>

	<div id="box" class="hide">

			<ul id="slide-banner">

				<?php
					//On lance la boucle pour créer toutes les images.
					while ($donnees = $Screen_banner->fetch())
						{

							// NOT DISPLAY THE ADVERT IN THE SLIDER
							if($donnees['Advertising'] != 'true'){
				?>

						<li class="<?php echo $donnees['Category'];?>"></li>

				<?php
							}

						}
						//On arrete la lecture de la table.
						$Screen_banner->closeCursor();

				?>
			</ul>

		<div id="wrapper" class="wrapper" >

			

			<div id="slider" class="cute-slider" data-width="1420" data-height="950" data-force="">
				<ul data-type="slides">

				<?php

					//On lance la boucle pour créer toutes les images.
					while ($donnees = $Screen->fetch())
						{

							// NOT DISPLAY THE ADVERT IN THE SLIDER
							if($donnees['Advertising'] != 'true'){
				?>

						<li class="slide-item" data-delay="4" data-trans3d="tr2,tr20,tr57" data-trans2d="tr1,tr14,tr26">
							<img src="images/<?php echo $donnees['Picture']?>" data-src="images/<?php echo $donnees['Picture']?>" data-thumb="images/thumbs/<?php echo $donnees['Picture']?>" style="max-height:950px; max-width:1420px;"/>
							<div data-type="info" class="info1" data-align="right">
								<div>
									<p class="title"><?php echo $donnees['Bedroom']; ?> bed <?php echo $donnees['Type']; ?>, <?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></p>
									<p class="price">&pound;<?php echo $donnees['Price']; ?> <?php echo $donnees['PricePer']; ?></p>
								</div>
							</div>
						</li> 

				<?php
							}else{
				?>

						<li class="slide-item" data-delay="4" data-trans3d="tr2,tr20,tr57" data-trans2d="tr1,tr14,tr26">
							<img src="images/<?php echo $donnees['Picture']?>" data-src="images/<?php echo $donnees['Picture']?>" data-thumb="images/thumbs/<?php echo $donnees['Picture']?>" style="max-height:950px; max-width:1420px;"/>
							<div data-type="info" class="info1" data-align="right">
								<div>
								</div>
							</div>
						</li>

				<?php
							}

						}
						//On arrete la lecture de la table.
						$Screen->closeCursor();

				?>
						
					</ul>

					<ul data-type="controls" style="z-index:999999999;">			
						<li data-type="slideinfo" data-effect="fade"> </li>
						<li data-type="thumblist" data-dir="vertical" data-autohide="true"> </li>

						
						<!-- <li data-type="circletimer" data-color="#333333" data-stroke="13"> </li>
						<li data-type="next"> </li>
						<li data-type="previous"> </li>
						<li data-type="slidecontrol" data-thumbalign="up"> </li> -->	
						
					</ul>
				</div>
				
			</div>

		</div>	
	</body>
</html>

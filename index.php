<!-- HTML HEADER-->
<?php include 'static_block/html-header.php'; ?>

<!-- PDO -->					
<?php include 'static_block/bdd.php'; ?>


<title>Residence Estates</title>
<meta name="description" content="North West and Central London real estate agents,  RESIDENCE ESTATES specialised in high quality residential property, sales, acquisitions, lettings and investments">

<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
<link rel="stylesheet" href="theme/supersized.shutter.css" type="text/css" media="screen" />
<script src="js/jquery.min.js"></script>
<script src="js/supersized.3.2.7.js"></script>
<script src="theme/supersized.shutter.min.js"></script>

<style type="text/css">

	html,body,#container,#content{height:100%;}

	@media only screen and (min-width: 300px) and (max-width: 1200px) {

		html,body,#container,#content{height:94%;}

	}
	#content{padding:0px;}

	#content{overflow:hidden;}
	
</style>

		
</head>

<body>

<div id="contener" class="residence">
	
	<div id="sidebar">
		
		<div id="logo">
			<a href="index.php">
				<img src="images/logo.png" alt="logo"/>
			</a>
		</div>
		
		<div id="menu">
			<?php include 'static_block/menu.php'; ?>	
		</div>

		<div id="footer">
	        <?php include 'static_block/footer.php'; ?>
	    </div>
	
	</div>
	
	<div id="content" class="homepage">

		<script>
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,		
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   5000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade
					transition_speed		:	1000,		// Speed of transition
					new_window				:	0,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	3,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size &amp; Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   0,			// Portrait images will not exceed browser height
					fit_landscape			:   1,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	false,	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images

			<?php

				try
				{
					
					//On récupère tout le contenu de la table news
					$reponse = $bdd->query('SELECT * FROM property WHERE Home="true" AND Statut != "Archive" ORDER BY Ordre');
					$number= $reponse->rowCount();
					$nom=1;
					//On lance la boucle pour créer toutes les images.
					while ($donnees = $reponse->fetch())
					{

						if($donnees['Page'] == 'short'){

							$page= 'Short let';
						
						}else if($donnees['Page'] == 'buy'){

							$page = 'For Sale';

						}else if($donnees['Page'] == 'rent'){

							$page = 'To Rent';

						}


						if($donnees['Page'] == 'commercial_buy' ){

							if( $donnees['Statut'] != 'Available' ){

								$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Type'].' '.$donnees['Statut'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].'</h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

							}else{

								$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Type'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].' - For Sale </h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

							}

						}else if($donnees['Page'] == 'commercial_rent'){

							if( $donnees['Statut'] != 'Available' ){

								$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Type'].' '.$donnees['Statut'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].'</h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

							}else{

								$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Type'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].' - To Rent </h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

							}

						}else{

							if($donnees['Type'] != 'Studio' AND $donnees['Bedroom'] != '0'){

								if( $donnees['Statut'] != 'Available' ){

									$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Bedroom'].' bedroom(s) '.$donnees['Type'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].' - '.$donnees['Statut'].'</h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

								}else{

									$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Bedroom'].' bedroom(s) '.$donnees['Type'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].' - '.$page.'</h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

								}

							}else{

								$caption= '<div class="slidecaption-wrap '.$donnees['CaptionPosition'].' white bg-dark"><h1>'.$donnees['Street'].', '.$donnees['Area'].'</h1><div class="caption-text"><h2>'.$donnees['Type'].' - &pound;'.$donnees['Price'].' '.$donnees['PricePer'].' - '.$page.'</h2></div><a href="property.php?properties='.$donnees['Page'].'&reference='.$donnees['Reference'].'" class="caption-btn">View this property</a></div>';

							}

						}

						if($donnees['Pictures'] != null){

							?>
							{image : <?php echo ("'images/".$donnees['Pictures']."'");?>, 
							title : <?php echo ("'".$caption."'");?>} <?php if ($nom != $number){ ?> , <?php }
							$nom++;

						}else{

						?>
							{image :  'images/default_picture.png', 
							title : <?php echo ("'".$caption."'");?>} <?php if ($nom != $number){ ?> , <?php }
							$nom++;
						}
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
					]
					
				});
		    });
		    
		</script>
	
		<!--Arrow Navigation-->
		<a id="prevslide" class="load-item"></a>

		<a id="nextslide" class="load-item"></a>
		
		<div id="slidecaption"></div>
		
		<!--Control Bar-->
		<ul id="slide-list"></ul>
		
		<div id="supersized-loader"></div>

	</div>

</div><!-- END: Content -->

<!-- Menu -->
<script>

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

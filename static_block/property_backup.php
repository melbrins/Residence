<?php
	
	// PDO STATEMENT
	include 'static_block/bdd.php';

	try
	{
							
		$ref= htmlentities($_GET['reference']);

		//On récupère tout le contenu de la table news
		$info = $bdd->query('SELECT Phone FROM information');
		$page_title = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$title = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$slid = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$details = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$map = $bdd ->query("SELECT * FROM property WHERE Reference='$ref'");

	}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>
<?php
  //On lance la boucle pour créer toutes les images.
    while ($donnees = $info->fetch())
    {

		$phone = $donnees['Phone'];

    }
    //On arrete la lecture de la table.
    $info->closeCursor();
  ?>





                                                                <!-- HTML HEADER-->
                                                <?php include("static_block/html-header.php"); ?>




<?php

	//On lance la boucle pour créer toutes les images.
	while ($donnees = $page_title->fetch())
	{


?>

		<title><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></title>

<?php 

	}
	
	//On arrete la lecture de la table.
	$page_title->closeCursor();

?>
<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

<style type="text/css">
	html,body,#container,#content{height:90%;}
	#content{overflow:hidden; }
	.ca-menu li.properties{
    background: #EF7F00;
	}
	.<?php echo $_GET['properties'] ;?>, .<?php echo $_GET['properties'] ;?>:link{background-color:#EF7F00; color:#FFF;}
	<?php if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){?>
		#Section2{height:75px;}
	<?php }else{?>
		#Section1{height:75px;}
	<?php }?>
</style>
		<link rel="stylesheet" href="theme/supersized.shutter.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		
		<script type="text/javascript" src="js/supersized.3.2.7.js"></script>
		<script type="text/javascript" src="theme/supersized.shutter.min.js"></script>
		<script src="script/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
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

		<div id="content" class="property_page">

	<?php

		//On lance la boucle pour créer toutes les images.
		while ($donnees = $title->fetch())
		{

	?>

			<div id="over_info">

				<div id="over_title"><h1><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></h1></div>

				<div id="over_details">

					<div id="over_statut">

						<p>
							<?php 
								if( $donnees['Statut'] != 'Available')
								{
									echo $donnees['Statut']; 
								}else{
									if($donnees['Page'] == 'commercial_buy'){
										?> Commercial to Buy <?php 
									}else if($donnees['Page'] == 'commercial_rent'){
										?> Commercial to Rent <?php 
									}else{
										echo($donnees['Page']);
									}
								}
							?>
						</p>

					</div>

					<div id="over_price">
						<p>&pound;<?php echo $donnees['Price']; ?> <?php echo $donnees['PricePer']; ?></p>
					</div>

				</div>
			<?php 

				if(isset($_GET['type']) AND $_GET['type'] != Null){

			?>

				<div id="return">

					<a href="search_result.php?type=<?php echo $_GET['type']; ?>&price_from=<?php echo $_GET['price_from']; ?>&price_max=<?php echo $_GET['price_max']; ?>&area=<?php echo $_GET['area']; ?>&bedrooms=<?php echo $_GET['bedrooms']; ?>&bedrooms_max=<?php echo $_GET['bedrooms_max']; ?>&nav=<?php if($_GET['nav'] == null) { ?>0<?php }else{ echo $_GET['nav']; } ?>&affichage=10&properties=<?php echo $donnees['Page']; ?>">
						<img src="images/back.png" alt="back"/>

						<p>Back to results</p>
					</a>

				</div>

			<?php 

				}

			?>

			</div>

	<?php

			$area = $donnees['Area'];
		}


		try
		{

			//On récupère tout le contenu de la table news
			$same = $bdd->query("SELECT * FROM property WHERE Area = '$area' AND Statut != 'Archive' ORDER BY RAND() LIMIT 4");

			//On arrete la lecture de la table.
			$title->closeCursor();


		}

		//Au cas ou ca ne fonctionne pas :
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}	
		
	?>
		<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	0,		
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   5000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade
					transition_speed		:	1000,		// Speed of transition
					new_window				:	0,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	1,			// Image will never exceed browser width or height (Ignores min. dimensions)
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

						$myarray = Array();
						$nom=1;

						//On lance la boucle pour créer toutes les images.
						while ($donnees = $slid->fetch())
						{

							$images = explode(';', $donnees['Pictures']);
							$myarray = array_merge($myarray,$images);
							$number = count($myarray);

							if($donnees['Pictures'] == null){

								$default = true;

							}else{

								$default = false;

							}

						}

						if($default == false){

							foreach ($myarray as &$value) {
									if($value != null){
								?>
									{image : <?php echo ("'".$value."'");?>, 
									title : <?php echo ("'".$number."'");?>} <?php if ($nom != $number){ ?> , <?php }
									$nom++;
									}
							}

						}else if($default == true){

						?>

							{image : 'images/default_picture.png', 
								title : <?php echo ("'".$number."'");?>} <?php if ($nom != $number){ ?> , <?php }

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

<div id="property_details">

<?php

	//On lance la boucle pour créer toutes les images.
	while ($donnees = $details->fetch())
	{

?>
		<div id="property_menu">

			<ul>

				<li>
					<a href="property.php?type=<?php echo $_GET['type']; ?>&price_from=<?php echo $_GET['price_from']; ?>&price_max=<?php echo $_GET['price_max']; ?>&area=<?php echo $_GET['area']; ?>&bedrooms=<?php echo $_GET['bedrooms']; ?>&bedrooms_max=<?php echo $_GET['bedrooms_max']; ?>&properties=<?php echo $_GET['properties']; ?>&nav=<?php echo $_GET['nav']; ?>&affichage=<?php echo $_GET['affichage']; ?>&reference=<?php echo $donnees['Reference']?>" class="active">Overview</a>
				</li>

				<li>
					<a href="map.php?type=<?php echo $_GET['type']; ?>&price_from=<?php echo $_GET['price_from']; ?>&price_max=<?php echo $_GET['price_max']; ?>&area=<?php echo $_GET['area']; ?>&bedrooms=<?php echo $_GET['bedrooms']; ?>&bedrooms_max=<?php echo $_GET['bedrooms_max']; ?>&properties=<?php echo $_GET['properties']; ?>&nav=<?php echo $_GET['nav']; ?>&affichage=<?php echo $_GET['affichage']; ?>&reference=<?php echo $donnees['Reference']?>">Map</a>
				</li>

			</ul>

		</div>

		<div id="breadcrumbs">

			<ul>

				<li>
					<a href="/index.php" title="Back to home page">Home</a>
					<span> |</span>
				</li>

				<li>
					<a href="search.php?properties=<?php echo $donnees['Page']; ?>" title="Back to search">Search</a>
					<span> |</span>
				</li>

				<li>
					<span class="current">Property ref: <?php echo $donnees['Reference']; ?></span>
				</li>

			</ul>

		</div>


		<div id="title_search" class="title">

			<h2><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></h2>

		</div>

		<div class="property_text">

			<div id="picture">
				<?php 

				if($donnees['Small_picture'] == null)
				{

			?>

					<img src="images/no_picture.jpg" alt="residence property" />

			<?php

				}else{

			?>

				<img src="images/<?php echo $donnees['Small_picture']; ?>" alt="residence property" />
			<?php

				}

			?>
				
				<p>Call <?php echo $phone;?> between 8am-8pm</p>
				<a href="arrange-view.php?reference=<?php echo $donnees['Reference']?>">ARRANGE A TIME TO VISIT</a>
			</div>

			<p class="short_desc"><?php echo nl2br($donnees['Short']); ?></p>
			<p class="desc"><?php echo nl2br($donnees['Description']); ?></p>

		</div>

		<div class="clearfix"></div>

		<div class="detail epc">

			<div class="property_title">

				<h3>Energy Performance Certificates</h3>

			</div>

			<div id="epc">

				<?php include 'static_block/epc.php';?>

			</div>

		</div>

		<div id="details" class="further-details">

			<?php include('static_block/further_details.php');?>

		</div>

		<div style="clear:both;"></div>
			

	<?php

		}

		//On arrete la lecture de la table.
		$details->closeCursor();

		while($donnees=$map->fetch())
		{

			if($donnees['FloorMap'] != null){

	?>

				<div class="detail floor_map">

					<div class="property_title">

						<h3>Floor Map</h3>

					</div>

	<?php

			

					$images = explode(';', $donnees['FloorMap']);
					$pictures = $donnees['FloorMap'];
					$myarray = array_merge($images);

					foreach ($myarray as &$value) {
						if($value != null){

	?>

							<div id="floor_map" style="float:left;">

								<a href="images/map/<?php echo($value); ?>" rel="prettyPhoto"><img src="images/map/<?php echo($value); ?>" alt="Floor map of this property" style="height:100%;"/></a>

							</div>

	<?php

						}
					}
	?>

				</div>

	<?php

			}

	?>	

			

			<div class="clearfix"></div>

	<?php 

		}
		$map->closeCursor();

	?>

	<!-- </div> -->

	<div id="same_area">

		<div class="property_title">

			<h2>In the same area</h2>

		</div>

		<div id="same">

			<ul>

		<?php

			//On lance la boucle pour créer toutes les images.
			while($donnees = $same->fetch())
			{

				$chaine=stripslashes($donnees['Short']);
				$max=200;
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
			?>
				
			<?php include 'static_block/property_result.php';?>

		<?php

			}
			//On arrete la lecture de la table.
			$same->closeCursor();
		?>
				</ul>

			</div>

	</div>
	
	<div class="clearfix"></div>

	<div id="footer">
        <?php include 'static_block/footer.php'; ?>
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
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 960,
			default_height: 660,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_square', /* light_rounded / pp_default / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image" style="display:"inline; ">Expand</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
            <a href="#" class="pp_arrow_previous">Previous</a> \
            <p class="currentTextHolder">0/0</p> \
            <a href="#" class="pp_arrow_next">Next</a> \
           </div> \
		   <p class="pp_description"></p> \
											<a class="pp_close" href="#">Close</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
		});
	});	
</script>

</body>

</html>
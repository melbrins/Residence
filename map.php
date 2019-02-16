<?php

session_start(); 

?>

<!-- HTML HEADER-->
<?php include("static_block/html-header.php"); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>		
<script src="js/slides.min.jquery.js"></script>

<script>
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: 'images/loading.gif',
			autoHeight: true,
			autoHeightSpeed: 350,
			start: 1
		});
	});
</script>
<?php
	try
	{
		include 'static_block/bdd.php';
							
		$ref= htmlentities($_GET['reference']);
		//On récupère tout le contenu de la table news
		$info = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$page_title = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$Address = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$details = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
		$room = $bdd ->query("SELECT * FROM room WHERE Reference='$ref'");
		$map = $bdd ->query("SELECT Floor, FloorMap FROM property WHERE Reference='$ref'");
	}
	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
<?php

	//On lance la boucle pour créer toutes les images.
	while ($donnees = $page_title->fetch())
	{


?>

		<title>Map - <?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?> - Residence Estates</title>
		<meta property="og:title" content="<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>">
		<meta property="og:image" content="http://www.residenceestates.com/images/<?php echo $donnees['Small_picture']; ?>">
		<meta property="og:description" content="<?php echo $donnees['Short'];?>">
		<meta property="og:site_name" content="Residencesestates.com">
		<meta property="og:url" content="http://www.residenceestates.com/property.php?properties=<?php echo $donnees['Page']; ?>&reference=<?php echo $donnees['Reference']; ?>">
		<meta property="og:type" content="website">

		<meta name="description" content="<?php echo $donnees['Short'];?>">

<?php 

	}
	
	//On arrete la lecture de la table.
	$page_title->closeCursor();

?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuvh-zMRUmY34x6eplFLlGMS347qME1-0&sensor=false"></script>
<script type="text/javascript">
		var geocoder;
  		var map;
      function initialize() {
	    geocoder = new google.maps.Geocoder();
	    // Create an array of styles.
		  var styles = [
		    {
		      stylers: [
		        { hue: "#EF7F00" },
		        { saturation: -20 }
		      ]
		    },{
		      featureType: "road",
		      elementType: "geometry",
		      stylers: [
		        { lightness: 100 },
		        { visibility: "simplified" }
		      ]
		    },{
		      featureType: "road",
		      elementType: "labels",
		      stylers: [
		        { visibility: "off" }
		      ]
		    }
		  ];

		  // Create a new StyledMapType object, passing it the array of styles,
		  // as well as the name to be displayed on the map type control.
		  var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
			    var mapOptions = {
			      	zoom: 14, //Change the Zoom level to suit your needs
			      	scrollwheel: false, 
			     	 mapTypeControlOptions: {
		      			mapTypeId: [google.maps.MapTypeId.ROADMAP, 'map_style']
		   		 	},
				    panControl: true,
				    panControlOptions: {
				        position: google.maps.ControlPosition.RIGHT_TOP
				    },
				    zoomControl: true,
				    zoomControlOptions: {
				        style: google.maps.ZoomControlStyle.LARGE,
				        position: google.maps.ControlPosition.RIGHT_TOP
				    },
				    streetViewControl: true,
				    streetViewControlOptions: {
				        position: google.maps.ControlPosition.RIGHT_TOP
				    }
			    }
		    //map_canvas is just a <div> on the page with the id="map_canvas"
		    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		  <?php
		  	while ($donnees = $Address->fetch())
				{
					?>
					 //Your Variable Containing The Address
					var address = "<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>"; 
					<?php
				}
				//On arrete la lecture de la table.
				$Address->closeCursor();
			?>
			geocoder.geocode( { 'address': address}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
			    map.setCenter(results[0].geometry.location);
			    //places a marker on every location
			    var marker = new google.maps.Marker({
			        map: map,
			        position: results[0].geometry.location
			    });
			  } else {
			    alert('Geocode was not successful for the following reason: ' + status);
			  }
			});
		  //Associate the styled map with the MapTypeId and set it to display.
		  map.mapTypes.set('map_style', styledMap);
		  map.setMapTypeId('map_style');
		}
</script>


<style type="text/css">
	html,body,#content{height:90%;}
	#content{overflow:hidden;}
	/*.ca-menu li.properties{
    	background: #EF7F00;
	}
	.properties a, .properties a:link{background-color:#EF7F00; color:#FFF;}*/
	#map_canvas { height: 100%; position:absolute; top:0px; }

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
<body onload="initialize()">
	<div id="contener" class="map_page">
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
		<?php
		//On lance la boucle pour créer toutes les images.
			while ($donnees = $details->fetch())
			{
				?>
		<div id="content">
		
		<div id="over_info">

			<div id="over_title"><h2><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></h2></div>

			<div id="over_details">

				<div id="over_statut">

					<p>
						<?php 
							if( $donnees['Statut'] != 'Available')
							{
								echo $donnees['Statut']; 
							}else{
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
							}
						?>
					</p>

				</div>

				<div id="over_price">
					<p>&pound;<?php echo $donnees['Price']; ?> <?php echo $donnees['PricePer']; ?></p>
				</div>

			</div>

		</div>
			<div id="map_canvas" style="width:100%; height:100%"></div>
		</div>
	<div id="property_details">

		<div id="property_menu">
			<ul>
				<li>
					<a href="property.php?properties=<?php echo $_GET['properties']; ?>&reference=<?php echo $donnees['Reference']?>">Overview</a>
				</li>
				<li>
					<a href="map.php?properties=<?php echo $_GET['properties']; ?>&reference=<?php echo $donnees['Reference']?>" class="active">Map</a>
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
					<a href="search.php?properties=<?php echo $donnees['Page']; ?>" title="Back to search"><?php echo $donnees['Page']; ?></a>
					<span> |</span>
				</li>

				<li>
					<span class="current">Property ref: <?php echo $donnees['Reference']; ?></span>
				</li>

			</ul>

		</div>


		<div id="title_search" class="title">

			<h1><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></h1>

		</div>
	
			<?php

            	//On lance la boucle pour créer toutes les images.
                while ($donnees = $info->fetch())
                {
            ?>

				<div id="visite">
					<div id="visite_contact">
						<p>Call <?php echo $donnees['Phone']; ?> between 8am - 8 pm</p>
						<div id="view_map">
							<a href="arrange-view.php?properties=<?php echo $donnees['Page']; ?>&reference=<?php echo $_GET['reference']?>">Arrange a time to visit</a>
						</div>
					</div>
			
			<?php
            
                }
                //On arrete la lecture de la table.
                $info->closeCursor();
            
              ?>
			
			<div id="visite_content">
				<?php 
					while($donnees = $room->fetch())
					{
				?>

						<span style="font-weight:bold; color:#552F01; margin-right:10px;"><?php echo($donnees['Title']);?></span><?php echo($donnees['Size']);?><br/>
<br/>
				<p><?php echo($donnees['Description']); ?></p>
<br/>
				<?php
					}
					$room->closeCursor();
				?>
			</div>
			<?php
			}
			//On arrete la lecture de la table.
					$details->closeCursor();
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
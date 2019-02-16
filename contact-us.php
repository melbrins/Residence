<!-- HTML HEADER-->
<?php include 'static_block/html-header.php'; ?>

<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- PDO -->                    
<?php include 'static_block/bdd.php'; ?>

<?php

    try
    {
                            
        $Address = $bdd->query("SELECT Address FROM information");

    }

    //Au cas ou ca ne fonctionne pas :
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    if (isset($_GET['sent']) AND $_GET['sent'] == 'success'){
?>

        <script type="text/javascript">

            jQuery(document).ready(function(){

                $('.success, .pagecover, .succeed').fadeIn(200);
                $('.success, .pagecover, .succeed').delay(2000).fadeOut(500); 

            });
            
        </script>

<?php
    }
?>

<title>Contact us - Residence Estates</title>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> -->
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationengine.jquery.css" type="text/css"/>

<script>

        jQuery(document).ready(function(){
            // binds form submission and fields to the validation engine
            jQuery("#formID").validationEngine();

            $("#formID").bind("jqv.form.validating", function(event){
                $("#hookError").html("")
            })

            $("#formID").bind("jqv.form.result", function(event , errorFound){
                if(errorFound) $("#hookError").append("There is some problems with your form");
            })
        });

</script>


<style type="text/css">

    @media only screen and (min-width: 1200px) {
        #menu li.contact{
            background: #EF7F00;
        }
        
        .contact a, .contact a:link{background-color:#EF7F00; color:#FFF;}
    }
    @media only screen and (min-width: 300px) and (max-width: 1200px) {

      #menu dt.contact a{border-bottom:3px solid #EF7F00;}

    }

</style>


<script type="text/javascript">

	$(function() {
			// Check for input placeholder support 
			if (!Modernizr.input.placeholder) {
				makePlaceholders();
			}
		});

</script>
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
                    var address = "<?php echo $donnees['Address']; ?>"; 
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

</head>

<body>

<?php

    try
        {

            $ref = $_GET['reference'];                    
            //On récupère tout le contenu de la table news
            $info = $bdd->query('SELECT * FROM information');

        }

    //Au cas ou ca ne fonctionne pas :
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

?>

<div class="pagecover"></div>

<div id="contener" class="contacts"><!-- START: Contener -->
		
        
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
        
        
        <div id="header"><!-- START: Header -->
<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?q=7+Hoop+Lane,+Golders+Green,+NW11+8JR&amp;ie=UTF8&amp;hq=&amp;hnear=7+Hoop+Ln,+London+NW11+8JR,+United+Kingdom&amp;gl=uk&amp;t=m&amp;z=14&amp;ll=51.573475,-0.199184&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.uk/maps?q=7+Hoop+Lane,+Golders+Green,+NW11+8JR&amp;ie=UTF8&amp;hq=&amp;hnear=7+Hoop+Ln,+London+NW11+8JR,+United+Kingdom&amp;gl=uk&amp;t=m&amp;z=14&amp;ll=51.573475,-0.199184&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
            <!-- <div id="map_canvas" style="width:100%; height:300px"></div> -->
        </div><!-- END: Header -->
        
        
        <div id="content"><!-- START: Content -->
        	
            <div id="contact-bar" class="empty" ><!-- START: Orange Contact Bar -->
            </div>
            <div class="success"><!-- <img class="loading" src="images/progress.gif" alt="loading"/> --><p class="succeed">Your email have been send correctly!</p></div>

                <div id="breadcrumbs">
                    <ul>
                        <li>
                            <a href="/index.php" title="Back to home page">Home</a>
                            <span> |</span>
                        </li>
                        <li>
                            <span class="current">Contact</span>
                        </li>
                    </ul>
                </div>

                <div id="title_search" class="title">

                  <h1>Get in touch</h1>

                </div>

                <!-- <div class="left-col column" style="width:507px;">
                    <img src="images/contact.jpg" alt="office with chairs"/>
                </div> -->
            
                <div class="left-col column">

                    <form id="formID" method="post" action="cms/email/traitement_contact.php">
                        <table>

                            <tr>
                                <td><label>Title <span class="required">*</span></label></td>
                                <td>
                                    <select id="title" name="title" class="validate[required]">
                                      <option value=""></option>
                                      <option value="Mr">Mr.</option>
                                      <option value="Mrs">Mrs.</option>
                                      <option value="Miss">Miss</option>
                                      <option value="Sir">Sir</option>
                                      <option value="Dr">Dr.</option>
                                    </select>
                                </td>
                            </tr>

                            <tr style="position:absolute; left:-9999999px;">
                                <td><label>Firstname</label></td>
                                <td><input name="firstname" id="firstname" type="text" /></td>
                            </tr>

                            <tr>
                                <td><label>Name <span class="required">*</span></label></td>
                                <td><input id="name" name="name"  class="validate[required,custom[onlyLetterSp]] text-input" type="text" /></td>
                            </tr>

                            <tr>
                                <td><label>Email <span class="required">*</span></label></td>
                                <td><input id="email" name="email" class="validate[required,custom[email]]" type="text" /></td>
                            </tr>

                            <tr>
                                <td><label>Message <span class="required">*</span></label></td>
                                <td><textarea id="message" name="message"  class="validate[required] text-input" rows="10"></textarea></td>
                            </tr>

                            <tr>
                                <td colspan="2" class="left"><span class="required small-text">*Required</span></td>
                            </tr>

                        </table>

                        <div class="btn-wrap">
                            <button id="submit" type="submit">Send message</button>
                            <button id="c-reset" type="reset">Reset form</button>
                        </div>
                    </form>             
                </div>

            <?php
                //On lance la boucle pour créer toutes les images.
                while ($donnees = $info->fetch())
                {

              ?>

                  <div class="left-col column1">

                    <ul>
                    
                      <li>
                        <img src="images/Address.png" alt="icon house" />
                        <p><?php echo $donnees['Address']; ?></p>
                      </li>
                    
                      <li>
                        <img src="images/Tel.png" alt="icon phone"/>
                        <p><?php echo $donnees['Phone']; ?></p>
                      </li> 
                    
                      <li>
                        <img src="images/Email.png" alt="icon pen"/>
                        <a href="contact-us.php" alt="contact us"><?php echo $donnees['Email']; ?></a>
                      </li>   
                    
                    </ul>                    
                      
                  </div>
                
              <?php
              
                }
                //On arrete la lecture de la table.
                $info->closeCursor();
              
              ?>
        
             </div><!-- END: Content -->
        
        
</div><!-- END: Contener -->

<!-- Menu -->
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

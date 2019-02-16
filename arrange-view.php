<!-- HTML HEADER-->
<?php include 'static_block/html-header.php'; ?>

<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- PDO -->                    
<?php include 'static_block/bdd.php'; ?>

<title>Arrange a view - Residence Estates</title>

<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/placeholder.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script> -->
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link  href="css/validationengine.jquery.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript">

	$(function() {
			// Check for input placeholder support 
			if (!Modernizr.input.placeholder) {
				makePlaceholders();
			}
		});

</script>

<?php

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

<style type="text/css">
    html,body,#container{height:100%;}

    @media only screen and (min-width: 1200px) {
        #menu li.contact{
            background: #EF7F00;
        }
        .contact a, .contact a:link{background-color:#EF7F00; color:#FFF;}
    }
    @media only screen and (min-width: 300px) and (max-width: 1200px) {

      #menu dt.contact a{border-bottom:3px solid #EF7F00;}

    }
    

/*        <?php if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){?>
    #Section2{
        height:50px;
    }
    <?php }else{?>
        #Section1{
            height:75px;
        }
<?php } ?>*/

</style>

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

</head>

<body>
<?php
try
    {
        $ref = $_GET['reference'];                    
        //On récupère tout le contenu de la table news
        $info = $bdd->query('SELECT * FROM information');
        $contact_property = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
        $img_property = $bdd->query("SELECT Picture FROM property_picture WHERE Reference='$ref' LIMIT 1");
        $fill_form = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
    }
    //Au cas ou ca ne fonctionne pas :
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
?>

<div class="pagecover"></div>
<div id="contener" class="contacts2"><!-- START: Contener -->
		
        
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

        <?php
        while ($donnees = $contact_property->fetch())
        {
        ?> 
            <div id="over_info">

                <div id="over_title">
                    <h2><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></h2>
                </div>

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

            </div>


             <?php
            }
            //We stop the current cursor
            $contact_property->closeCursor();
        ?>

            
        <?php
        while ($donnees = $img_property->fetch())
        {
        ?>

            <img src="images/<?php echo $donnees['Picture']; ?>" border="0" alt="Flat Screenshot" />
            
        <?php

            }
            //We stop the current cursor
            $img_property->closeCursor();
        ?>
        </div><!-- END: Header -->
       
        
        <div id="content"><!-- START: Content -->
        	
            <?php
              //On lance la boucle pour créer toutes les images.
                while ($donnees = $info->fetch())
                {
            ?>
            <div id="contact-bar"><!-- START: Orange Contact Bar -->
            	<a id="contact-btn" class="c-bar-details" href="property.php?properties=<?php echo $_GET['properties']; ?>&reference=<?php echo $ref ?>">Back To Property</a>
                <span id="call-us" class="c-bar-details">Call <?php echo $donnees['Phone']; ?> between 8am and 8pm </span>
                <div class="clearfix"></div>
            </div>
            <?php
                }
                //On arrete la lecture de la table.
                $info->closeCursor();

                while ($donnees = $fill_form->fetch())
                {

            ?>

            <div class="success"><p class="succeed">Your email have been send correctly!</p></div>

            <div id="breadcrumbs">
                
                <ul>

                    <li>
                        <a href="index.php" title="Back to home page">Home</a>
                        <span> |</span>
                    </li>
                
                    <li>
                        <a href="search.php?properties=<?php echo $donnees['Page']; ?>" title="Back to search">Search</a>
                        <span> |</span>
                    </li>
                    
                    <li>
                        <a href="property.php?reference=<?php echo $donnees['Reference']; ?>" title="Back to property page">Property ref: <?php echo $donnees['Reference']; ?></a>
                        <span> |</span>
                    </li>

                    <li>
                        <span class="current">Arrange a visit</span>
                    </li>
                
                </ul>
            
            </div>

            <div id="title_search" class="title">

              <h1>Arrange a visit</h1>

            </div>

            <form id="formID" method="post" action="cms/email/traitement_view.php">

            <div class="left-col column"  style="width:400px;">
                 <div id="your-details">
                	<h3>Your details</h3>
                    
                    <table>
                    	<tr>
                        	<td>Title <span class="required">*</span></td>
                            <td>
                            	<select id="title" name="title" class="validate[required]">
                                	<option value=""></option>
                                    <option value="Mr">Mr.</option>
                                    <option value="Mrs">Mrs.</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr.</option>
                                </select>
                            </td>
                        </tr>

                        <tr style="position:absolute; left:-9999999px;">
                            <td><label>Name</label></td>
                            <td><input name="name" id="name" type="text" /></td>
                        </tr>

                    	<tr>
                        	<td>First name</td>
                            <td><input type="text" name="firstname" class="validate[required,custom[onlyLetterSp]] text-input"  id="firstname"/></td>
                        </tr>

                    	<tr>
                        	<td>Last name <span class="required">*</span></td>
                            <td><input type="text" name="lastname" class="validate[required,custom[onlyLetterSp]] text-input" id="lastname" /></td>
                        </tr>

                        <tr>
                        	<td>Email <span class="required">*</span></td>
                            <td><input type="text" name="email" class="validate[required,custom[email]]" id="email" /></td>
                        </tr>

                        <tr>
                        	<td>Phone number <span class="required">*</span></td>
                            <td><input type="text" name="phone" class="validate[required,custom[phone]] text-input" id="phone" /></td>
                        </tr>
                    </table>

                </div>
            </div>
            
            
            <div class="left-col column">
                 <div id="property-details">
                	<h3>When are you available?</h3>
                    
                    <form>
                    	<table>
                        	<tr>
                            	<td>During the day <span class="required">*</span></td>
                                <td>
                                	<select id="daytime" class="validate[required]" name="Daytime">
                                    	<option value="">Select an option</option>
                                    	<option value="Morning">Morning</option>
                                        <option value="Evening">Evening</option>
                                        <option value="Free all day">Free all day</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            	<td>During the week <span class="required">*</span></td>
                                <td>
                                	<select id="weektime" class="validate[required]" name="Weektime">
                                    	<option value="">Select an option</option>
                                        <option value="All the week">All the week</option>
                                        <option value="Monday to Friday">Monday to Friday</option>
                                    	<option value="Saturday or Sunday">Saturday or Sunday</option>
                                    </select>
                                </td>
                            </tr>
                             <tr>
                                <td><label>Further information</label></td>
                                <td><textarea name="Further" id="Further" rows="4"></textarea></td>
                            </tr>                   
                        </table>
                        
                        <p class="required">*Required</p>

                        <p id="submit-note">
                        	We will get back to you as soon as possible to give you a date<br />
                        </p>

                        <input type="hidden" name="Page" value="<?php echo $donnees['Page']; ?>"/>
                        <input type="hidden" name="Reference" value="<?php echo $donnees['Reference']; ?>"/>
                        <input type="hidden" name="Area" value="<?php echo $donnees['Area']; ?>"/>
                        <input type="hidden" name="Street" value="<?php echo $donnees['Street']; ?>"/>
                        <input type="hidden" name="Postcode" value="<?php echo $donnees['Postcode']; ?>"/>
                        <input type="hidden" name="Image" value="<?php echo $donnees['Small_picture']; ?>"/>
                        <input type="hidden" name="Price" value="<?php echo $donnees['Price']; ?>"/>
                        <input type="hidden" name="PricePer" value="<?php echo $donnees['PricePer']; ?>"/>
                        <input type="hidden" name="Bedroom" value="<?php echo $donnees['Bedroom']; ?>"/>
                        <button id="c2-submit" type="submit">Send message</button>
                    
                </div>
            </div>

            </form>

        <div class="clearfix"></div>

        </div><!-- END: Content -->
          <?php
                }
                //On arrete la lecture de la table.
                $fill_form->closeCursor();

            ?>
        
</div><!-- END: Contener -->
<!-- Validation form -->
<!-- <script type="text/javascript" src="js/validation.js"></script> -->
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

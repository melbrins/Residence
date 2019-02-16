<!-- HTML HEADER-->
<?php include 'static_block/html-header.php'; ?>

<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- PDO -->                    
<?php include 'static_block/bdd.php'; ?>

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

    @media only screen and (min-width: 1200px) {
        #menu li.design{
            background: #EF7F00;
        }
        
        .design a, .design a:link{background-color:#EF7F00; color:#FFF;}
    }
    @media only screen and (min-width: 300px) and (max-width: 1200px) {

      #menu dt.design a{border-bottom:3px solid #EF7F00;}

    }

</style>

<title>Design Studio - Residence Estates</title>

<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/placeholder.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script> -->

<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationengine.jquery.css" type="text/css"/>

<script type="text/javascript">

	$(function () {
		var radio = $('.radio-holder').find('.radio');
		var radioFlat = $('#radio-flat');
		var radioHouse = $('#radio-house');
		var radioSale = $('#radio-sale');
		var radioLet = $('#radio-let');
		
		radioFlat.click(function () {
			if ($(this).hasClass('off')) {
				$(this).removeClass('off').addClass('on');
				radioHouse.removeClass('on').addClass('off')
			}
		});
		
		radioHouse.click(function () {
			if ($(this).hasClass('off')) {
				$(this).removeClass('off').addClass('on');
				radioFlat.removeClass('on').addClass('off')
			}
		});
		
		radioSale.click(function () {
			if ($(this).hasClass('off')) {
				$(this).removeClass('off').addClass('on');
				radioLet.removeClass('on').addClass('off')
			}
		});
		
		radioLet.click(function () {
			if ($(this).hasClass('off')) {
				$(this).removeClass('off').addClass('on');
				radioSale.removeClass('on').addClass('off')
			}
		});
		
		
	});

</script>

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
        //On récupère tout le contenu de la table news
        $info = $bdd->query('SELECT * FROM information');
        $data = $bdd->query('SELECT * FROM contact WHERE Page="design"');
    }
    //Au cas ou ca ne fonctionne pas :
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
?>

<div class="pagecover"></div>
<div id="contener" class="design_page"><!-- START: Contener -->
		
        
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
            <img src="images/design_header.jpg" border="0" alt="House"/>
        	<!-- <h1>Design Studio</h1> -->
            <span class="h1-shadow">Design Studio</span>
        </div><!-- END: Header -->
        
        
        <div id="content"><!-- START: Content -->
        	
            <?php
              //On lance la boucle pour créer toutes les images.
                while ($donnees = $info->fetch())
                {
            ?>
            <div id="contact-bar"><!-- START: Orange Contact Bar -->
            	<a id="contact-btn" class="c-bar-details" href="contact-us.php">Contact Us</a>
                <span id="call-us" class="c-bar-details">Call us between 8am and 8pm: <?php echo $donnees['Phone']; ?></span>
                <div class="clearfix"></div>
            </div>
            <?php
                }
                //On arrete la lecture de la table.
                $info->closeCursor();
              ?>
            
            <div class="success"><p class="succeed">Your email have been send correctly!</p></div>

            <div id="breadcrumbs">
                <ul>
                    <li>
                        <a href="/index.php" title="Back to home page">Home</a>
                        <span> |</span>
                    </li>
                    <li>
                        <span class="current">Design Studio</span>
                    </li>
                </ul>
            </div>

            <div id="title_search" class="title">

              <h1>Design Studio</h1>

            </div>

            <div id="intro_design">
            
            <?php
            
                //On lance la boucle pour créer toutes les images.
                while ($donnees = $data->fetch())
                {
                    if($donnees['Picture'] != null){
            ?>

                    <div id="intro_picture">
                        <img src="images/contact/<?php echo $donnees['Picture']; ?>" width="400" border="0" alt="House" />
                    </div><!-- END : Intro_picture -->

            <?php
                    }
            ?>
                    <div id="intro_text">

                        <p class="desc"><?php echo nl2br($donnees['Text']); ?></p>

                    </div><!-- END : Intro_text -->

            <?php
                }
                //On arrete la lecture de la table.
                $data->closeCursor();
                ?>
            </div><!-- END : Intro_design -->

            <div class="clearfix"></div>

           <form id="formID" method="post" action="cms/email/traitement_design.php">
            
            
            <div class="left-col column">
                <div id="your-details"><!-- START: Your details -->
                    <h3>Your details</h3>
                    
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
                            <td><label>Name</label></td>
                            <td><input name="name" id="name" type="text"/></td>
                        </tr>

                        <tr>
                            <td><label>First name </label></td>
                            <td><input id="firstname" name="firstname" type="text"/></td>
                        </tr>

                        <tr>
                            <td><label>Last name <span class="required">*</span></label></td>
                            <td><input id="lastname" name="lastname" type="text" class="validate[required,custom[onlyLetterSp]] text-input"/></td>
                        </tr>

                        <tr>
                            <td><label>Email <span class="required">*</span></label></td>
                            <td><input id="email" name="email" type="text" class="validate[required,custom[email]]"/></td>
                        </tr>

                        <tr>
                            <td><label>Phone number <span class="required">*</span></label></td>
                            <td><input id="phone" name="phone" type="text" class="validate[required,custom[phone]]"/></td>
                        </tr>

                        <tr>
                            <td>Area <span class="required">*</span></td>
                            <td><input id="area" name="area" type="text" class="validate[required,custom[onlyLetterSp]]"/></td>
                        </tr>

                        <tr>
                            <td><label>Address</label> <span class="required">*</span></td>
                            <td><textarea id="address" name="address" rows="4" style="width:50%;" class="validate[required,custom[onlyLetterNumber]]"></textarea></td>
                        </tr>
                        
                        <tr>
                            <td><label>Postcode</label> <span class="required">*</span></td>
                            <td><input id="postcode" name="postcode" type="text" class="validate[required,custom[onlyLetterNumber]]"/></td>
                        </tr>
                        
                    </table>

                
                </div>
            </div>


             <div class="left-col column"><!-- START: Left Column -->
                <div id="property-details"><!-- START: Property Details -->

                    <h3>Property details</h3>
                    
                    <table>
                        
                        <tr>
                            <td>About your home: <span class="required">*</span></td>
                            <td><textarea id="Home" name="Home" rows="4" placeholder="1950s semi-detached house in prime condition..." class="validate[required]"></textarea></td>
                        </tr>
                        
                        <tr>
                            
                            <td>Hope to achieve: <span class="required">*</span></td>
                            <td><textarea id="hope" name="hope" rows="4" placeholder="We are looking to reconfigure the ground floor of our house..." class="validate[required]"></textarea></td>
                        </tr>
                        
                        <tr>
                            
                            <td>Describe your style: <span class="required">*</span></td>
                            <td><textarea id="style" name="style" rows="4" placeholder="Contemporary, traditional, modern,..." class="validate[required]"></textarea></td>
                        </tr>

                        <tr>
                            <td>Information or queries:</td>
                            <td><textarea id="other" name="other" rows="4"></textarea></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" class="left"><span class="required small-text">*Required</span></td>
                        </tr>
                        
                    </table>
                
                    <div class="submit-holder">
                        <p id="submit-note">We will get back to you as soon as possible to give you the value of your property</p>
                        <button type="submit" id="ds-submit">Submit</button>     
                    </div>
                </div>
            </form>
        </div>

    <div class="clearfix"></div>
            
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

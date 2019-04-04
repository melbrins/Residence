<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';
	include 'Slider/Block/Slider.php';

	$slider = new Slider();

	$slider_settings = $slider->getScreenSettings();

	try
		{
								
		//We take on the database the property we want to edit.
		$PropertyScreen = $bdd->query("SELECT * FROM screen");

		}

	//IF ERROR
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	// We check that we have the information to display the page properly.
	if(isset($_GET['page'])){

		$currentpage = $_GET['page'];

	}else{

		// If we don't have the information we need we go back on the admin page.
		header("Location:admin.php?info=off");

	}

	//COUNT HOW MANY PROPERTY ON HOMEPAGE
	$num_rows = $PropertyScreen->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">

	<meta charset="ISO-8859-1" />

	<script src="js/jquery.js"></script>
	<script src="js/jquery.tools.min.js"></script>
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	<link href="css/cms-ie.css" type="text/css" rel="stylesheet" media="screen"/>

</head>

<body>

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

	<style type="text/css">
		#<?php echo $currentpage; ?> a, #<?php echo $currentpage; ?> a:link { color:#FFF;}
	</style>

	<?php include 'static_block/admin_menu.php'; ?>

</div><!-- END : Navigation -->


<div class="page">

	<h2>Screen - New Property</h2>

	<?php include '../static_block/message.php'; ?>

	<div id="add_buy_overview" class="property_overview  push">

		<form method="post" action="script/screen/add_screen.php" enctype="multipart/form-data">

			<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="picture_property float">
					
				<img src="../images/new_picture.jpg" alt="new property"/>
				
				<div class="res2-row btn_upload">
					<input required="required" class="image-file" type="file" name="Image"/>
				</div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Speed</label>
                    <input name="Speed" id="screen-speed" value="" placeholder="<?php echo($slider_settings['speed']) ? $slider_settings['speed'] : ''?>" type="number" />
                </div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Transition</label>
                    <select name="Transition" id="slide-transition">
                        <option value="">Random</option>
                        <?php for ($i=1; $i <= 61; $i++){ ?>
                            <option <?php echo($donnees['Transition'] == 'tr'.$i) ? 'selected' : ''; ?> value="tr<?php echo $i; ?>">tr<?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>

			</div>

			<div class="float">

				<div class="res2-row-head">
					<span class="res2-row-title">Enter new details</span><br>
				</div>

				<div class="res2-row">

					<label for="Bedroom">Bedroom</label>
					<span class="text-holder">
						<select name="Bedroom" size="1">
			
							<option value="0">Studio</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="6+">6+</option>
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Category">Category</label>
					<span class="text-holder">
						<select name="Category" size="1">
							
							<option value="">---</option>
							<option value="For Sale">For Sale</option>
							<option value="To Let">To Let</option>
							<option value="Let By">Let By</option>
							<option value="Sold">Sold</option>

							<!-- <option value="Buy">Buy</option>
							<option value="Rent">Rent</option>
							<option value="Short Let">Short Let</option>

							<option></option>
							<option>---</option>
							<option></option>

							<option value="Commercial to buy">Commercial to buy</option>
							<option value="Commercial to rent">Commercial to rent</option> -->
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Statut">Type</label>
					<span class="text-holder">
						<select name="Type" size="1">
					
							<option value="Flat">Flat</option>
							<option value="Apartment">Apartment</option>
							<option value="Studio">Studio</option>
							<option value="House">House</option>
							<option value="Garage">Garage</option>
							
							<option></option>
							<option>---</option>
							<option></option>

							<option value="Office">Office</option>
							<option value="Shop">Shop</option>

						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Street">Street <span>*</span></label>
					<span class="text-holder"><input required="required" class="input" type="text" name="Street" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Postcode">Postcode <span>*</span></label>
					<span class="text-holder"><input required="required" class="input" type="text" name="Postcode" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Area">Area <span>*</span></label>
					<span class="text-holder"><input required="required" class="input" type="text" name="Area" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Price">Price <span>*</span></label>
					<span class="text-holder"><input required="required" class="input" type="text" name="Price" value=""></span>

				</div>

				<div class="res2-row">

					<label for="PricePer">Price Per <span>*</span></label>
					<span class="text-holder">
						<select name="PricePer" size="1">
							
							<option value=""> -- </option>
							<option value="pw">Week</option>
							<option value="pcm">Calendar Month</option>
				
						</select>
					</span>

				</div>

				<div class="res2-btn right">
					<button class="btn" type="submit">
						
						<span>Save</span>

					</button>
				</div>

				<div class="res2-row-head">
					<span class="res2-row-or">Or</span><br>
					<span class="res2-row-title">Use existing property details</span><br>
				</div>

				<div class="res2-row">

					<label for="Category">Category</label>
					<span class="text-holder">
						<select name="Category_reference" size="1">
							
							<option value="">---</option>
							<option value="For Sale">For Sale</option>
							<option value="To Let">To Let</option>
							<option value="Let By">Let By</option>
							<option value="Sold">Sold</option>
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Reference">Reference</label>
					<span class="text-holder"><input class="input" type="text" name="Reference" value=""></span>

				</div>

				<div class="res2-btn right">
					<button class="btn" type="submit">
						
						<span>Submit</span>

					</button>
				</div>

			</div>

			<div class="clear"></div>

		</form>

	</div><!-- END : property_overview -->

	<div id="add_advert" class="property_overview  push">

		<form method="post" action="script/screen/add_screen_advert.php" enctype="multipart/form-data">

			<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="picture_property float">
					
				<img src="../images/new_picture.jpg" alt="new property"/>
				
				<div class="res2-row btn_upload">
					<input required="required" class="image-file" type="file" name="Image"/>
				</div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Speed</label>
                    <input name="Speed" id="screen-speed" value="" placeholder="<?php echo($slider_settings['speed']) ? $slider_settings['speed'] : ''?>" type="number" />
                </div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Transition</label>
                    <select name="Transition" id="slide-transition">
                        <option value="">Random</option>
                        <?php for ($i=1; $i <= 61; $i++){ ?>
                            <option <?php echo($donnees['Transition'] == 'tr'.$i) ? 'selected' : ''; ?> value="tr<?php echo $i; ?>">tr<?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>

			</div>

			<div class="float">

				<div class="res2-row-head">
					<span class="res2-row-or">Or</span><br>
					<span class="res2-row-title">Set up an advert</span><br>
				</div>

				<div class="res2-row">

					<label for="Street">Advertising Title <span>*</span></label>
					<span class="text-holder"><input required="required" class="input" type="text" name="Street" value=""></span>

				</div>

				<!-- <div class="res2-row">

					<label for="Repeat">Repeat advert every </label>
					<span class="text-holder">
						<select name="Repeat" size="1">
			
							<option value="" selected>Don't repeat</option>
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
				
						</select>
					</span>

				</div> -->

				<div class="res2-btn right">
					<button class="btn" type="submit">
						
						<span>Save</span>

					</button>
				</div>

			</div>

			<div class="clear"></div>

		</form>

	</div><!-- END : property_overview -->

</div><!-- END : page -->


<script type="text/javascript">

	var page = '<?php echo $currentpage;; ?>'; 

	$(document).ready(function(){

		$('.menu').removeClass('active');
		$('#'+ page).addClass('active');	

	});

    $('.image-file').bind('change', function() {

        $(this).parent().children('.message').remove();

        var image_size = this.files[0].size/1024/1024;

        if (image_size > 2) {
            $(this).parent().prepend('<div class="message" style="height: 80px;"><p>Image Size: ' + Math.round(image_size) + 'MB</br>Image needs to be under 2MB</p></div>');
        }
    });

</script>

<script src="js/cms_script.js"></script>



</body>
</html>
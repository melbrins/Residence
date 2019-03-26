<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

	include 'Slider/Block/Slider.php';

	$slider = new Slider();

	$slider_settings = $slider->getScreenSettings();


?>

<!DOCTYPE html>

<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.tools.min.js"></script>
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	<link href="css/cms-ie.css" type="text/css" rel="stylesheet" media="screen"/>
	
</head>

<body>

<?php

	if(isset($_GET['page']) AND isset($_GET['reference'])){

		$currentpage    = $_GET['page'];
		$ref            = $_GET['reference'];

	}else{

		header("Location:admin.php?info=off");

	}

	try{

			$Property       = $bdd->query("SELECT * FROM screen WHERE Reference='$ref'");
			$PropertyScreen = $bdd->query("SELECT * FROM screen");

		}

	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$num_rows = $PropertyScreen->rowCount();
	$num_rows--;

?>

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
	
	<?php include 'static_block/admin_menu.php'; ?>

</div><!-- END : Navigation -->

<?php

	while ($donnees = $Property->fetch())
		{
            $title = $slider->getScreenTitlePerId($donnees['ID']);
?>

	<div class="page">

		<h2>Screen - <?php echo $title; ?></h2>

		<?php include '../static_block/message.php'; ?>

		<div class="property_overview  push">
			
			<form method="post" action="script/screen/edit_screen.php" enctype="multipart/form-data">

			<!-- <div class="title_categorie"><h4>Overview</h4></div> -->

			<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
			<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="picture_property float">

				<img src="../slider/images/thumbs/<?php echo $donnees['Picture'];?>" alt="Screen <?php echo $donnees['Reference'];?>"/>
				
				<div class="res2-row btn_upload">
					<input type="file" name="Image"/>
				</div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Speed</label>
                    <input name="Speed" id="screen-speed" value="<?php echo ($donnees['Speed']) ? $donnees['Speed'] : '' ?>" placeholder="<?php echo($slider_settings['speed']) ? $slider_settings['speed'] : ''?>" type="number" />
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

                <a class="btn secondary" href="<?php echo ($donnees['Transition']) ? 'http://'.$_SERVER['SERVER_NAME'].'/slider/preview.php?Transition='.$donnees['Transition']: 'http://'.$_SERVER['SERVER_NAME'].'/slider/preview.php' ;?>" target="_blank">Preview</a>

				<div class="delete_box">
					<input type="checkbox" name="delete" id="delete"/>
					<label for="delete">Delete</label>
				</div>

			</div><!-- END : picture_property -->

			<div class="float">

				<div class="res2-row-head">
					<span class="res2-row-title">Change Property Details</span><br>
				</div>

				<div class="res2-row">

					<label for="Bedroom">Bedroom</label>
					<span class="text-holder">
						<select name="Bedroom" size="1">
			
							<option value="0" <?php if($donnees['Bedroom'] == '0'){echo('selected');}?>>Studio</option>
							<option value="1" <?php if($donnees['Bedroom'] == '1'){echo('selected');}?>>1</option>
							<option value="2" <?php if($donnees['Bedroom'] == '2'){echo('selected');}?>>2</option>
							<option value="3" <?php if($donnees['Bedroom'] == '3'){echo('selected');}?>>3</option>
							<option value="4" <?php if($donnees['Bedroom'] == '4'){echo('selected');}?>>4</option>
							<option value="5" <?php if($donnees['Bedroom'] == '5'){echo('selected');}?>>5</option>
							<option value="6" <?php if($donnees['Bedroom'] == '6'){echo('selected');}?>>6</option>
							<option value="6+" <?php if($donnees['Bedroom'] == '6+'){echo('selected');}?>>6+</option>
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Category">Category</label>
					<span class="text-holder">
						<select name="Category" size="1">
							
							<option value="">---</option>
							<option value="For Sale" <?php if($donnees['Category'] == 'For Sale'){echo('selected');}?>>For Sale</option>
							<option value="To Let" <?php if($donnees['Category'] == 'To Let'){echo('selected');}?>>To Let</option>
							<option value="Let By" <?php if($donnees['Category'] == 'Let By'){echo('selected');}?>>Let By</option>
							<option value="Sold" <?php if($donnees['Category'] == 'Sold'){echo('selected');}?>>Sold</option>

							<!-- <option value="Buy" <?php if($donnees['Category'] == 'Buy'){echo('selected');}?>>Buy</option>
							<option value="Rent" <?php if($donnees['Category'] == 'Rent'){echo('selected');}?>>Rent</option>
							<option value="Short Let" <?php if($donnees['Category'] == 'Short Let'){echo('selected');}?>>Short Let</option>

							<option></option>
							<option>---</option>
							<option></option>

							<option value="Commercial to buy" <?php if($donnees['Category'] == 'Commercial to buy'){echo('selected');}?>>Commercial to buy</option>
							<option value="Commercial to rent"<?php if($donnees['Category'] == 'Commercial to rent'){echo('selected');}?>>Commercial to rent</option> -->
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Statut">Type</label>
					<span class="text-holder">
						<select name="Type" size="1">
					
							<option value="Flat" <?php if($donnees['Type'] == 'Flat'){echo('selected');}?>>Flat</option>
							<option value="Apartment" <?php if($donnees['Type'] == 'Apartment'){echo('selected');}?>>Apartment</option>
							<option value="Studio" <?php if($donnees['Type'] == 'Studio'){echo('selected');}?>>Studio</option>
							<option value="House" <?php if($donnees['Type'] == 'House'){echo('selected');}?>>House</option>
							<option value="Garage" <?php if($donnees['Type'] == 'Garage'){echo('selected');}?>>Garage</option>
							
							<option></option>
							<option>---</option>
							<option></option>

							<option value="Office" <?php if($donnees['Type'] == 'Office'){echo('selected');}?>>Office</option>
							<option value="Shop" <?php if($donnees['Type'] == 'Shop'){echo('selected');}?>>Shop</option>

						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Street">Street <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Street" value="<?php echo stripslashes($donnees['Street']);?>"></span>

				</div>

				<div class="res2-row">

					<label for="Postcode">Postcode <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Postcode" value="<?php echo stripslashes($donnees['Postcode']);?>"></span>

				</div>

				<div class="res2-row">

					<label for="Area">Area <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Area" value="<?php echo stripslashes($donnees['Area']);?>"></span>

				</div>

				<div class="res2-row">

					<label for="Price">Price <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Price" value="<?php echo stripslashes($donnees['Price']);?>"></span>

				</div>

					<div class="res2-row">

						<label for="per">Price Per <span>*</span></label>
						<span class="text-holder">
							<select name="per" size="1">
								
								<option value=""> -- </option>
								<option value="pw" <?php if($donnees['PricePer'] == 'pw'){echo('selected');}?>>Week</option>
								<option value="pcm" <?php if($donnees['PricePer'] == 'pcm'){echo('selected');}?>>Calendar Month</option>
					
							</select>
						</span>

					</div>

				<div class="res2-btn right clear">
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
							<option value="For Sale" <?php if($donnees['Category'] == 'For Sale'){echo('selected');}?>>For Sale</option>
							<option value="To Let" <?php if($donnees['Category'] == 'To Let'){echo('selected');}?>>To Let</option>
							<option value="Let By" <?php if($donnees['Category'] == 'Let By'){echo('selected');}?>>Let By</option>
							<option value="Sold" <?php if($donnees['Category'] == 'Sold'){echo('selected');}?>>Sold</option>

						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Reference">Reference <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Reference" value=""></span>

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

	</div><!-- END : page -->

	<?php

			if(isset($donnees['Statut']) && $donnees['Statut'] == 'Archive'){
				$currentpage = 'archive';
			}
	?>
			<style type="text/css">
				#<?php echo $currentpage; ?> a, #<?php echo $currentpage; ?> a:link { color:#FFF;}
			</style>

	<?php

		}
		//We stop the current cursor.
		$Property->closeCursor();
	?>

	<!-- Change page in fonction of the url -->
	<script>
		var page = '<?php echo $currentpage; ?>'; 
		$(document).ready(function(){
				$('.menu').removeClass('active');
				$('#'+ page).addClass('active');	
		});
	</script>

	<script type="text/javascript" src="js/cms_script.js"></script>

</body>
</html>
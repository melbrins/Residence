<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

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

		<form method="post" action="script/property/add_overview.php" enctype="multipart/form-data">

			<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="picture_property float">
					
				<img src="../images/new_picture.jpg" alt="new property"/>
				
				<div class="btn_upload">
					<input type="file" name="Image"/>
				</div>

			</div>

			<div class="float">

				<div class="res2-row">

					<label for="Statut">Category</label>
					<span class="text-holder">
						<select name="Statut" size="1">
			
							<option value="Let">Buy</option>
							<option value="Rent">Rent</option>
							<option value="Short Let">Short Let</option>
							<option value="Commercial to buy">Commercial to buy</option>
							<option value="Commercial to rent">Commercial to rent</option>
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Street">Street <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Street" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Postcode">Postcode <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Postcode" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Area">Area <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Area" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Price">Price <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Price" value=""></span>

				</div>

				<div class="res2-row">

					<label for="Price">Price Per <span>*</span></label>
					<span class="text-holder">
						<select name="Statut" size="1">
							
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

			</div>

		</form>

	</div><!-- END : property_overview -->

	<div id="add_advert" class="property_overview  push">

		<form method="post" action="script/property/add_advert.php" enctype="multipart/form-data">

			<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="picture_property float">
					
				<img src="../images/new_picture.jpg" alt="new property"/>
				
				<div class="btn_upload">
					<input type="file" name="Image"/>
				</div>

			</div>

			<div class="float">

				<div class="res2-row">

					<label for="Street">Advertising Title <span>*</span></label>
					<span class="text-holder"><input class="required input" type="text" name="Street" value=""></span>

				</div>

				<div class="res2-row">

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

				</div>

				<div class="res2-btn right">
					<button class="btn" type="submit">
						
						<span>Save</span>

					</button>
				</div>

			</div>

		</form>

	</div><!-- END : property_overview -->

</div><!-- END : page -->

<!-- Change page in fonction of the url -->
<script>

	var page = '<?php echo $currentpage;; ?>'; 

	$(document).ready(function(){

		$('.menu').removeClass('active');
		$('#'+ page).addClass('active');	

	});

</script>

<script src="js/cms_script.js"></script>

</body>
</html>
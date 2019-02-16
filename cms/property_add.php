<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

	try
		{
								
		//We take on the database the property we want to edit.
		$PropertyHome = $bdd->query("SELECT * FROM property WHERE Home = 'true' AND Statut != 'Archive'");

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
	$num_rows = $PropertyHome->rowCount();

	//WE MINUS BY 1
	$num_rows--;

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

	<h2>Property - <?php if($currentpage != 'commercial' OR $donnees['Page'] != 'short'){ ?>To <?php } echo $currentpage; ?> - New Property</h2>

	<?php include '../static_block/message.php'; ?>

	<div id="add_buy_overview" class="property_overview  push">

		<form method="post" action="script/property/add_overview.php" enctype="multipart/form-data">

			<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="menu_property">

				<ul>

					<li class="right"><a href="admin.php?page=buy">Back to list</a></li>

					<li class="right">
						
						<label for="Caption">Caption Position</label>
						
						<select name="Caption" size="1">
						
							<option value="right-bottom" selected>right-bottom</option>
							<option value="right-top">right-top</option>
							<option value="left-bottom">left-bottom</option>
							<option value="left-top">left-top</option>
							
						</select>
					
					</li>

					<li class="right">

						<label for="Home">Home?</label><input type="checkbox" name="Home" id="select" <?php if($donnees['Home'] == 'true'){echo('checked="checked"');}?>/>
					
					</li>

					<li style="clear:both;"></li>

				</ul>

			</div>

			<div class="picture_property float">
					
				<img src="../images/new_picture.jpg" alt="new property"/>
				
				<div class="btn_upload">
					<input type="file" name="Image"/>
				</div>

			</div>

			<div class="float">

				<div class="res2-row">

					<label for="Statut">Statut</label>
					<span class="text-holder">
						<select name="Statut" size="1">
			
							<option value="Available">Available</option>
							<option value="Let">Let</option>
							<option value="Sold">Sold</option>
							<option value="Archive" >Archive</option>
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Number">Number</label>
					<span class="text-holder"><input class="input" type="text" name="Number" value=""></span>

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

				<div class="res2-row">
				
					<label for="Short">Short Description <span>*</span></label>
					<textarea name="Short" class="textarea"rows="8" cols="80"></textarea>

				</div>

				<div class="res2-row">
				
					<label for="Description">Description <span>*</span></label>
					<textarea name="Description" class="textarea"rows="8" cols="80"></textarea>

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
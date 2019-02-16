<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

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

	// WE check that we have the information to display the page properly.
	if(isset($_GET['page']) AND isset($_GET['reference'])){

		$currentpage = $_GET['page'];
		$ref = $_GET['reference'];

	}else{

		// If we don't have the information we need we go back on the admin page.
		header("Location:admin.php?info=off");

	}

	try{
								
			//We take on the database the property we want to edit.
			$Property = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");
			$PropertyHome = $bdd->query("SELECT * FROM property WHERE Home = 'true' AND Statut != 'Archive'");

		}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$num_rows = $PropertyHome->rowCount();
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

	//On lance la boucle pour créer toutes les images.
	while ($donnees = $Property->fetch())
		{

?>

	<div class="page">

		<h2>Property - <?php if($donnees['Page'] != 'commercial' OR $donnees['Page'] != 'short'){ ?>To <?php } echo $donnees['Page']; ?> - "<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>"</h2>

		<?php include '../static_block/message.php'; ?>

		<div class="property_overview  push">
			
			<form method="post" action="script/property/edit_overview.php" enctype="multipart/form-data">

			<div class="menu_property">

				<ul>
					<li class="float selected"><a href="property_edit_overview.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Overview</a></li>
					
					<li class="float"><a href="property_edit_details.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Details</a></li>
					
					<li class="float"><a href="property_edit_room.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Room</a></li>
					
					<li class="float"><a href="property_edit_picture.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Pictures</a></li>
					
					<li class="right"><a href="admin.php?page=<?php echo $currentpage; ?>">Back to list</a>
					</li>

					<li class="right">
					
						<label for="Caption">Caption Position</label>
					
						<select name="Caption" size="1">
					
							<option value="left-bottom">left-bottom</option>
							<option value="left-top">left-top</option>
							<option value="right-bottom" selected>right-bottom</option>
							<option value="right-top">right-top</option>
					
						</select>
					
					</li>
					
					<li class="right">
						<label for="Home">Home?</label><input type="checkbox" name="Home" id="select" <?php if($donnees['Home'] == 'true'){echo('checked="checked"');}?>/>
					</li>
					
					<li style="clear:both;"></li>
				
				</ul>

			</div><!-- END : Menu_property -->

			<!-- <div class="title_categorie"><h4>Overview</h4></div> -->

			<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
			<input type="hidden" name="Page" value="<?php echo $donnees['Page']; ?>"/>
			<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

		<?php

				if($donnees['Small_picture'] != 'no_picture.jpg'){

		?>

			<div class="picture_property float">

				<img src="../images/<?php echo $donnees['Small_picture'];?>" alt="property <?php echo $donnees['Reference'];?>"/>
				
				<div class="btn_upload">
					<input type="file" name="Image"/>
				</div>

				<div class="delete_box">
					<input type="checkbox" name="delete_cover" id="delete_cover"/>
					<label for="delete">Delete</label>
				</div>

			</div><!-- END : picture_property -->

		<?php 

				}else{ 	

		?>

					<div class="picture_property float">

						<img src="../images/new_picture.jpg" alt="new property"/>

						<div class="btn_upload">
							<input type="file" name="Image"/>
						</div>

					</div><!-- END : picture_property -->

		<?php 	

				} 	

		?>

			<div class="float">

				<div class="res2-row">

					<label for="Statut">Statut</label>
					<span class="text-holder">
						<select name="Statut" size="1">
			
							<option value="Available" <?php if($donnees['Statut'] == 'Available'){echo('selected');}?>>Available</option>
							<option value="Let" <?php if($donnees['Statut'] == 'Let'){echo('selected');}?>>Let</option>
							<option value="Sold" <?php if($donnees['Statut'] == 'Sold'){echo('selected');}?>>Sold</option>
							<option value="Archive" <?php if($donnees['Statut'] == 'Archive'){echo('selected');}?>>Archive</option>
				
						</select>
					</span>

				</div>

				<div class="res2-row">

					<label for="Number">Number</label>
					<span class="text-holder"><input class="input" type="text" name="Number" value="<?php echo stripslashes($donnees['Number']);?>"></span>

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

						<label for="Price">Price Per <span>*</span></label>
						<span class="text-holder">
							<select name="per" size="1">
								
								<option value=""> -- </option>
								<option value="pw" <?php if($donnees['PricePer'] == 'pw'){echo('selected');}?>>Week</option>
								<option value="pcm" <?php if($donnees['PricePer'] == 'pcm'){echo('selected');}?>>Calendar Month</option>
					
							</select>
						</span>

					</div>

				<div class="res2-row">
				
					<label for="Short">Short Description <span>*</span></label>
					<textarea name="Short" class="textarea"rows="8" cols="80"><?php echo stripslashes($donnees['Short']);?></textarea>

				</div>

				<div class="res2-row">
				
					<label for="Description">Description <span>*</span></label>
					<textarea name="Description" class="textarea"rows="8" cols="80"><?php echo stripslashes($donnees['Description']);?></textarea>

				</div>

				<div class="delete_box right">
					<input type="checkbox" name="delete" id="delete"/>
					<label for="delete">Delete</label>
				</div>

				<div class="res2-btn right clear">
					<button class="btn" type="submit">
						
						<span>Save</span>

					</button>
				</div>

			</div>

			</form>

		</div><!-- END : property_overview -->

	</div><!-- END : page -->

	<?php

			if($donnees['Statut'] == 'Archive'){
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
<?php
session_start(); 

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';

	// WE check that we have the information to display the page properly.
	if(isset($_GET['page']) AND isset($_GET['reference'])){

		$currentpage = $_GET['page'];
		$ref = $_GET['reference'];

	}else{

		// If we don't have the information we need we go back on the admin page.
		header("Location:admin.php?info=off");

	}

	try
		{
								
			//We take on the database the property we want to edit.
			$Property = $bdd->query("SELECT * FROM property WHERE Reference='$ref'");

		}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.tools.min.js"></script>
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	<link href="css/cms-ie.css" type="text/css" rel="stylesheet" media="screen"/>

</head>

<body>

<div id="header">

	<div id="logo">
		
		<a href="../index.php">
			<img src="../images/logo_cms.png" alt="Logo Residence Estate" height="50"/>
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

			if($donnees['Statut'] == 'Archive'){
				$currentpage = 'archive';
			
			}
?>

<style type="text/css">
	#<?php echo $currentpage; ?> a, #<?php echo $currentpage; ?> a:link { color:#FFF;}
</style>

<div class="page">

	<h2>Property - <?php if($donnees['Page'] != 'commercial' OR $donnees['Page'] != 'short'){ ?>To <?php } echo $donnees['Page']; ?> - "<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>"</h2>

	<?php include '../static_block/message.php'; ?>

	<div class="property_room push">

		<div class="menu_property">

			<ul>
				
				<li class="float"><a href="property_edit_overview.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Overview</a></li>
				
				<li class="float"><a href="property_edit_details.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Details</a></li>
				
				<li class="float selected"><a href="property_edit_room.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Room</a></li>
				
				<li class="float"><a href="property_edit_picture.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Pictures</a></li>
				
				<li class="right"><a href="admin.php?page=<?php echo $currentpage; ?>">Back to list</a></li>
				
				<li style="clear:both;"></li>
			
			</ul>

		</div><!-- END : Menu_property -->
		
		<div class="room_box float">

			<form method="post" action="script/property/edit_room_add.php">

				<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
				<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>

				<div class="res2-row">

					<label for="RoomTitle">Room Title</label>
					<span class="text-holder"><input class="input" type="text" name="RoomTitle" value=""></span>

				</div>

				<div class="res2-row">

					<label for="RoomSize">Room Size</label>
					<span class="text-holder"><input class="input" type="text" name="RoomSize" value=""></span>

				</div>

				<div class="res2-row">
				
					<label for="RoomDescription">Description <span>*</span></label>
					<textarea name="RoomDescription" class="textarea"rows="8" cols="48"></textarea>

				</div>

				<div class="res2-btn right">
					<button class="btn" type="submit">
						
						<span>Add</span>

					</button>
				</div>

			</form>

		</div>


			
	<?php
			$room = $bdd ->query("SELECT * FROM room WHERE Reference='$ref'");
			while($donnees = $room->fetch())
			{
	?>
			<div class="room_box float">

				<form method="post" action="script/property/edit_room_edit.php">

					<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
					<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
					<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>

					<div class="res2-row">

						<label for="RoomTitle">Room Title</label>
						<span class="text-holder"><input class="input" type="text" name="RoomTitle" value="<?php echo($donnees['Title']); ?>"></span>

					</div>

					<div class="res2-row">

						<label for="RoomSize">Room Size</label>
						<span class="text-holder"><input class="input" type="text" name="RoomSize" value="<?php echo($donnees['Size']); ?>"></span>

					</div>

					<div class="res2-row">
					
						<label for="RoomDescription">Description <span>*</span></label>
						<textarea name="RoomDescription" class="textarea"rows="8" cols="48"><?php echo $donnees['Description'];?></textarea>

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

				</form>

			</div>
				
		<?php
	
			}
			//We stop the current Cursor
			$room->closeCursor();

		?>

	</div><!-- END : property_room contener -->

</div><!-- END : page -->

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
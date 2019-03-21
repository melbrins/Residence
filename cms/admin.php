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

	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript" src="js/jquery.confirm.js">// <![CDATA[
	 
	// ]]></script><script type="text/javascript" language="javascript">// <![CDATA[
	// load jquery here before calling this
	$(document).ready(function() {
	 
	    // delete the entry once we have confirmed that it should be deleted
	    $('.delete').click(function() {
	        var parent = $(this).closest('tr');
	        $.ajax({
	            type: 'get',
	            url: 'script/property/delete.php', // <- replace this with your url here
	            data: 'ajax=1&delete=' + $(this).attr('id'),
	            beforeSend: function() {
	                parent.animate({'backgroundColor':'#fb6c6c'},300);
	            },
	            success: function() {
	                parent.fadeOut(300,function() {
	                    parent.remove();
	                });
	            }
	        });        
	    });
	 
	    // confirm that it should be deleted
	    $('.delete').confirm({
	        msg:'Remove this property? ',
	        timeout:3000
	    });   

	    // delete the entry once we have confirmed that it should be deleted
	    $('.delete_screen').click(function() {
	        var parent = $(this).closest('tr');
	        $.ajax({
	            type: 'get',
	            url: 'script/screen/delete.php', // <- replace this with your url here
	            data: 'ajax=1&delete=' + $(this).attr('id'),
	            beforeSend: function() {
	                parent.animate({'backgroundColor':'#fb6c6c'},300);
	            },
	            success: function() {
	                parent.fadeOut(300,function() {
	                    parent.remove();
	                });
	            }
	        });        
	    });
	 
	    // confirm that it should be deleted
	    $('.delete_screen').confirm({
	        msg:'Remove this property? ',
	        timeout:3000
	    }); 
	});
	// ]]></script>
</head>

<body>

<?php 

	if (isset($_GET['page'])) {

		$page = $_GET['page'];

	}else{

		$page = "informations";

	}

	if (isset($_GET['reference'])){

		$addref= $_GET['reference'];

	}

	try
	{

		$Info = $bdd->query('SELECT * FROM information');
		$PropertyScreen = $bdd->query("SELECT * FROM screen ORDER BY Ordre");
		$About = $bdd->query('SELECT * FROM aboutus');
		$PropertyHome = $bdd->query("SELECT * FROM property WHERE Home = 'true' AND Statut != 'Archive' ORDER BY Ordre");
		$PropertyBuy = $bdd->query("SELECT * FROM property WHERE Page = 'buy' AND Statut != 'Archive' ");
		$PropertyRent = $bdd -> query("SELECT * FROM property WHERE Page = 'rent' AND Statut != 'Archive' ");
		$PropertyShort = $bdd -> query("SELECT * FROM property WHERE Page = 'short' AND Statut != 'Archive' ");
		$PropertyCom = $bdd -> query("SELECT * FROM property WHERE Page = 'commercial_buy' AND Statut != 'Archive' ");
		$PropertyComRent = $bdd -> query("SELECT * FROM property WHERE Page = 'commercial_rent' AND Statut != 'Archive' ");
		$Archive = $bdd -> query("SELECT * FROM property WHERE Statut = 'Archive' ");

	}

	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>

<div id="header">

	<div id="logo">
		<a href="../index.php">
			<img src="../images/logo_cms.png" alt="Logo Residence Estate" height="50px"/>
		</a>
	</div>

	<div id="company">
		<h1><span style="color:#552F01">RESIDENCE</span> <span style="color:#EF7F00">ESTATES</span></h1>
	</div>

</div><!-- END : header -->

<div id="navigation">

	<style type="text/css">
		#<?php echo $page; ?> a, #<?php echo $page; ?> a:link { color:#FFF;}
	</style>

	<?php include 'static_block/admin_menu.php'; ?>

</div><!-- END : Navigation -->

<div id="page_informations" class="page">
	<?php include 'static_block/information.php'; ?>
</div>

<div id="page_screen" class="page">
	<?php include 'static_block/res2_admin_screen_home.php'; ?>
</div>

<div id="page_about" class="page">
	<?php include 'static_block/about.php'; ?>
</div>

<div id="page_valuation" class="page">
	<?php include 'static_block/cms_valuation.php'; ?>
</div>

<div id="page_acquisition" class="page">
	<?php include 'static_block/cms_acquisition.php'; ?>
</div>

<div id="page_design" class="page">
	<?php include 'static_block/cms_design.php'; ?>
</div>

<div id="page_home" class="page">
	<?php include 'static_block/res2_admin_property_home.php'; ?>
</div>



<!-- PAGE BUY -->
<div id="page_buy" class="page">

	<h2>Property - Buy</h2>

	<?php 
		include '../static_block/message.php';
		include 'static_block/res2_search.php'; 
	?>

	<div id="content_nutrition" class="categorie services">

		<div class="content_categorie nutrition">

			<a href="property_add.php?page=buy" class="new_article"><img src="../images/new_property.png"></a>

			<table>

		<?php

			$boolean=true;
			//On lance la boucle pour cr�er toutes les images.
			while ($donnees = $PropertyBuy->fetch())
				{

					if($boolean == true){
			?>
						<tr>
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
			
			<?php
			
						$boolean=false;
			
					}else{
					
				?>
				
						<tr class="grey">
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
				
				<?php 
			
						$boolean=true;
			
					}

				}
				//On arrete la lecture de la table.
				$PropertyBuy->closeCursor();

		?>
			</table>

		</div>

	</div>

</div>



<!-- PAGE RENT -->


<div id="page_rent" class="page">

	<h2>Property - Rent</h2>

	<?php 
		include '../static_block/message.php';
		include 'static_block/res2_search.php'; 
	?>

	<div id="content_nutrition" class="categorie services">

		<div class="content_categorie nutrition">

			<a href="property_add.php?page=rent" class="new_article"><img src="../images/new_property.png"></a>

			<table>
		
		<?php
			$boolean=true;
			
			//On lance la boucle pour cr�er toutes les images.
			while ($donnees = $PropertyRent->fetch())
				{



					if($boolean == true){
			?>
						<tr>
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
			
			<?php
			
						$boolean=false;
			
					}else{
					
				?>
				
						<tr class="grey">
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
				
				<?php 
			
						$boolean=true;
			
					}

				}
				//On arrete la lecture de la table.
				$PropertyRent->closeCursor();

		?>
			</table>

		</div>

	</div>

</div>



<!-- PAGE SHORT -->


<div id="page_short" class="page">

	<h2>Property - Short Let</h2>

	<?php 
		include '../static_block/message.php';
		include 'static_block/res2_search.php'; 
	?>

	<div id="content_nutrition" class="categorie services">

		<div class="content_categorie nutrition">

			<a href="property_add.php?page=short" class="new_article"><img src="../images/new_property.png"></a>

			<table>

		<?php

			$boolean=true;
			//On lance la boucle pour cr�er toutes les images.
			while ($donnees = $PropertyShort->fetch())
				{
		
					if($boolean == true){
			?>
						<tr>
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
			
			<?php
			
						$boolean=false;
			
					}else{
					
				?>
				
						<tr class="grey">
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
				
				<?php 
			
						$boolean=true;
			
					}

				}
				//On arrete la lecture de la table.
				$PropertyShort->closeCursor();
		
		?>
			</table>

		</div>

	</div>

</div>



<!-- PAGE COMMERCIAL BUY -->


<div id="page_commercial_buy" class="page">

	<h2>Property - Commercial to Buy</h2>

	<?php 
		include '../static_block/message.php';
		include 'static_block/res2_search.php'; 
	?>

	<div id="content_nutrition" class="categorie services">

		<div class="content_categorie nutrition">

			<a href="property_add.php?page=commercial_buy" class="new_article"><img src="../images/new_property.png"></a>

			<table>
				
	<?php
			$boolean=true;
			//On lance la boucle pour cr�er toutes les images.
			while ($donnees = $PropertyCom->fetch())
				{
	
					if($boolean == true){
			?>
						<tr>
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
			
			<?php
			
						$boolean=false;
			
					}else{
					
				?>
				
						<tr class="grey">
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
				
				<?php 
			
						$boolean=true;
			
					}

				}
				//On arrete la lecture de la table.
				$PropertyCom->closeCursor();
		
		?>
			</table>

		</div>

	</div>

</div>



<!-- PAGE COMMERCIAL RENT -->


<div id="page_commercial_rent" class="page">

	<h2>Property - Commercial to Rent</h2>

	<?php 
		include '../static_block/message.php';
		include 'static_block/res2_search.php'; 
	?>

	<div id="content_nutrition" class="categorie services">

		<div class="content_categorie nutrition">

			<a href="property_add.php?page=commercial_rent" class="new_article"><img src="../images/new_property.png"></a>

			<table>
	
	<?php
			$boolean=true;
			//On lance la boucle pour cr�er toutes les images.
			while ($donnees = $PropertyComRent->fetch())
				{

					if($boolean == true){
			?>
						<tr>
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
			
			<?php
			
						$boolean=false;
			
					}else{
					
				?>
				
						<tr class="grey">
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
				
				<?php 
			
						$boolean=true;
			
					}

				}
				//On arrete la lecture de la table.
				$PropertyComRent->closeCursor();
	
	?>
			</table>

		</div>

	</div>

</div>



<!-- PAGE ARCHIVE -->


<div id="page_archive" class="page">

	<h2>Property - Archive</h2>

	<?php 
		include '../static_block/message.php';
		include 'static_block/res2_search.php'; 
	?>

	<div id="content_nutrition" class="categorie services">

		<div class="content_categorie nutrition">

			<table>
	
	<?php
			$boolean=true;
			//On lance la boucle pour cr�er toutes les images.
			while ($donnees = $Archive->fetch())
				{
	
					if($boolean == true){
			?>
						<tr>
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
			
			<?php
			
						$boolean=false;
			
					}else{
					
				?>
				
						<tr class="grey">
							<?php include 'static_block/res2_row_property.php';  ?>	
						</tr>
				
				<?php 
			
						$boolean=true;
			
					}

				}
				//On arrete la lecture de la table.
				$Archive->closeCursor();
	
	?>
			</table>

		</div>

	</div>

</div>

<!-- Change page in fonction of the url -->
<script>

	var page = '<?php echo $page; ?>'; 

	$(document).ready(function(){

			$('.page').css({'display' : 'none'});
			$('#page_' + page).fadeIn(1);
			$('#page_' + page).animate({left: '186', opacity:'1'},200);
			$('.menu').removeClass('active');
			$('#'+ page).addClass('active');	

	});

</script>

<script src="js/cms_script.js"></script>
	
</body>
</html>
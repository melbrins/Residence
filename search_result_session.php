



                                                                <!-- HTML HEADER-->
                                                <?php include("static_block/html-header.php"); ?>




<?php 
if(isset($_GET['properties'])){
	$Page = $_GET['properties'];
		}else{
	$Page = 'buy';
}
?>

<title><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></title>

<style type="text/css">
	html,body,#container{height:100%;}
	.ca-menu li.<?php echo $_GET['properties'] ;?>{
    background: #EF7F00;
	}
	.<?php echo $_GET['properties'] ;?>, .<?php echo $_GET['properties'] ;?>:link{background-color:#EF7F00; color:#FFF;}
	<?php if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){?>
		#Section2{height:75px;}
	<?php }else{?>
		#Section1{height:75px;}
	<?php }?>
</style>		
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<?php
try
	{
		include '/static_block/bdd.php';
		

		// $affichage = $_GET['affichage'];
		$nav = intval(trim($_GET['nav']));
		$affichage = intval(trim($_GET['affichage']));
		$prems =  $nav * $affichage;
		$last = $prems + $affichage;
		$count_result_pagination = 0;
		


		//On récupère tout le contenu de la table news
		$Area = $bdd->query("SELECT DISTINCT Area FROM property");
		$price_min= $_GET['price_from'];
		$price_max= $_GET['price_max'];
		$area= str_replace ( '%20' , ' ' , $_GET['area']);
		$bed= $_GET['bedrooms'];
		$bed_max = $_GET['bedrooms_max'];
		$type=$_GET['type'];
		

		if($area == 'All_area' AND $type == 'All_type'){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND  Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");
			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);

		}else if($area == 'All_area' AND $type != "All_type"){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");
			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':type', $type, PDO::PARAM_STR, 255);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);



			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':type', $type, PDO::PARAM_STR, 255);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


		}else if($type == "All_type" AND $area != 'All_area'){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");
			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);

		}else if($type != "All_type" AND $area != 'All_area'){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");
			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':type', $type, PDO::PARAM_STR, 500);
			$count->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':type', $type, PDO::PARAM_STR, 500);
			$sth->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);

		}

		$sth->execute();
		$count->execute();
		
		$count_result_pagination = $count->rowCount();

	}
	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}


	if($last >= $count_result_pagination){
		$last = $count_result_pagination;
	}
?>
	<div id="contener">

		<div id="sidebar">

			<div id="logo">
				<a href="http://www.residenceestates.com/index.php">
					<img src="images/logo.png" alt="logo"/>
				</a>
			</div>

			<div id="menu">
				<? include 'static_block/menu.php'; ?>
			</div>

		</div>

		<div id="header">

				<img src="images/<?php echo($Page); ?>_header.jpg" border="0" alt="House" style="float:right;" />

				<h1><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></h1>
		
		</div>

		<div id="content">

			<div id="form_navigation">

				<form method="get" action="search_result.php" enctype="multipart/form-data">

					<div id="search_details">

						<fieldset class="holder">

							<ol>
								<li>	

									<fieldset>

										<select name="affichage" onchange="this.form.submit()" style="width:110px; margin-bottom:0px;">
											<option value="10"<?php if($_GET['affichage']=='10'){echo('selected="selected"');} ?>>10 per page</option>
											<option value="20"<?php if($_GET['affichage']=='20'){echo('selected="selected"');} ?>>20 per page</option>
											<option value="30"<?php if($_GET['affichage']=='30'){echo('selected="selected"');} ?>>30 per page</option>
											<option value="40"<?php if($_GET['affichage']=='40'){echo('selected="selected"');} ?>>40 per page</option>
											<option value="60"<?php if($_GET['affichage']=='60'){echo('selected="selected"');} ?>>60 per page</option>
										</select>

									</fieldset>

								</li>


								<li style="margin-right:40px;">	

									<fieldset>

										<select name="order" onchange="this.form.submit()" style="margin-bottom:0px;">
											<option value="1" <?php if($_GET['order']=='1'){echo('selected="selected"');} ?> >Lower price first</option>
											<option value="2" <?php if($_GET['order']=='2'){echo('selected="selected"');} ?> >Highest price first</option>
											<option value="3" <?php if($_GET['order']=='3'){echo('selected="selected"');} ?> >Order by latest first</option>
										</select>

									</fieldset>

								</li>
							</ol>

							<input type="hidden" value="<?php echo $_GET['price_from']?>" name="price_from">
							<input type="hidden" value="<?php echo $_GET['price_max']?>" name="price_max">
							<input type="hidden" value="<?php echo $_GET['area']?>" name="area">
							<input type="hidden" value="<?php echo $_GET['bedrooms']?>" name="bedrooms">
							<input type="hidden" value="<?php echo $_GET['bedrooms_max']?>" name="bedrooms_max">
							<input type="hidden" value="<?php echo $_GET['type']?>" name="type">
							<input type="hidden" value="<?php echo $_GET['properties']?>" name="properties">

						</fieldset>

					</div>

				</form>

			</div>

			<div id="breadcrumbs">
				<ul>
					<li>
						<a href="/index.php" title="Back to home page">Home</a>
						<span> |</span>
					</li>
					<li>
						<a href="search.php?properties=<?php echo $Page; ?>" title="Back to search">Search</a>
						<span> |</span>
					</li>
					<li>
						<span class="current"><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></span>
					</li>
				</ul>
			</div>



		<?php 

			if($count_result_pagination != 0 AND $count_result_pagination != Null){
				
				$prems++; 

		?>

			<div id="title_search" class="title">

				<h2>Property Results</h2>

				
				<span class="subtitle">Showing <?php echo $prems; ?> - <?php echo $last; ?> of <?php echo $count_result_pagination; ?> Results</span>

				<span class="back_search"><a href="search.php?properties=<?php echo $Page; ?>">Change search</a></span>

			</div>

		<?php

			}
		
		?>			

		<?php
		
			if($count_result_pagination > $affichage){

		?>

			<span class="pagination alone">

					<?php include("pagination.php");?>

			</span>

		<?php 

			}

		?>

			<div id="result_search">

				<ul>

			<?php

				try
				{

					$count_result=0;
					
					$prems =  $prems * $affichage;

					while ($donnees = $sth->fetch())
					{

						$chaine=stripslashes($donnees['Short']);

						$max=125;

						if(strlen($chaine)>=$max)
						{

							$chaine=substr($chaine,0,$max);
							$espace=strrpos($chaine," ");
					
							if($espace)
							{

								$chaine=substr($chaine,0,$espace);
								$chaine .= ' [...]';

							}

						}
						
						$count_result++;
													
			?>									

						<?php include 'static_block/property_result.php';?>

			<?php

					}

					//On arrete la lecture de la table.
					$sth->closeCursor();

				}

				//Au cas ou ca ne fonctionne pas :
				catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}

			?>	

				</ul>

			<?php 

				if($count_result == 0)
				{

			?>
					<div id="no_result">
						<p>We're really sorry but we couldn't find anything that matched your search term.</p>
						<span><a href="search.php?properties=<?php echo $Page; ?>">Change search</a><span>
					</div>

					<h2 style="margin-top:10px; margin-left:20px; width:97%;">Maybe you'll like those properties :</h2>

					<ul>

			<?php
						$random = $bdd -> query("SELECT * FROM property WHERE Page = '$Page' ORDER BY RAND() LIMIT 10");
						while ($donnees = $random->fetch())
						{

							$chaine=stripslashes($donnees['Short']);

							$max=150;

							if(strlen($chaine)>=$max)
							{

								$chaine=substr($chaine,0,$max);
								$espace=strrpos($chaine," ");
						
								if($espace)
								{

									$chaine=substr($chaine,0,$espace);
									$chaine .= ' [...]';

								}

							}
			?>
					
							<?php include 'static_block/property_result.php';?>

			<?php

						}

			?>

					</ul>

			<?php

					//We stop the current cursor
					$random->closeCursor();
				
				}
				
			?>
				
			</div>

			<div class="clearfix"></div>

		<?php
		
			if($count_result_pagination > $affichage){

		?>
		
			<span class="pagination alone">

					<?php include("pagination.php");?>

			</span>

		<?php 

			}

		?>

			<div id="footer">
		        <?php include 'static_block/footer.php'; ?>
		    </div>
	    
		</div><!-- END: Content -->


	</div>

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
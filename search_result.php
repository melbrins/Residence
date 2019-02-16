<?php 

session_start(); 

$_SESSION['type']=$_GET['type'];
$_SESSION['price_from']=$_GET['price_from'];
$_SESSION['price_max']=$_GET['price_max'];
$_SESSION['area']=$_GET['area'];
$_SESSION['bedroom']=$_GET['bedroom'];
$_SESSION['bedroom_max']=$_GET['bedroom_max'];
$_SESSION['properties']=$_GET['properties'];

$_SESSION['nav']=$_GET['nav'];
$_SESSION['affichage']=$_GET['affichage'];
$_SESSION['properties']=$_GET['properties'];
$_SESSION['order']=$_GET['order'];

// HTML HEADER
include 'static_block/html-header.php';

// PDO STATEMENT
include 'static_block/bdd.php';

//GET PAGE NAME
if(isset($_GET['properties'])){

	$Page = $_GET['properties'];

}else{

	$Page = 'buy';

}

?>

	<title><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?> - Residence Estates</title>

	<script type="text/javascript" src="js/jquery.min.js"></script>

	<style type="text/css">

		html,body,#container{
			height:100%;
		}

		.ca-menu li.<?php echo $_SESSION['properties'] ;?>{
	    	background: #EF7F00;
		}
		
		.<?php echo $_SESSION['properties'] ;?>, .<?php echo $_SESSION['properties'] ;?>:link{
			background-color:#EF7F00; color:#FFF;
		}
		
<?php if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){?>
		
		@media only screen and (min-width: 1200px) {
			#Section2{
				height:50px;
			}
		}
		@media only screen and (min-width: 300px) and (max-width: 1200px) {

			.commercials a{border-bottom:3px solid #EF7F00;}

		}
	<?php }else{?>

		@media only screen and (min-width: 1200px) {
			#Section1{
				height:75px;
			}
		}

		@media only screen and (min-width: 300px) and (max-width: 1200px) {

			.properties a{border-bottom:3px solid #EF7F00;}

		}
<?php } ?>

	</style>

</head>

<body>

<?php include 'static_block/res2_search_result.php'; ?>

<?php

	//Avoid to have last higher than the number of results
	// if($last >= $count_result_pagination){
	// 	$last = $count_result_pagination;
	// }

?>
	<div id="contener" class="search_result">

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

		<div id="header">

				<img src="images/<?php echo($Page); ?>_header.jpg" border="0" alt="House"/>

				<!-- <h1><?php if($Page == 'commercial_buy'){?> Commercial to Buy <?php }else if($Page == 'commercial_rent'){?> Commercial to Rent <?php }else{ ?>Properties for <?php if($Page!='short'){ echo($Page); }else{ ?> Short Let <?php } }?></h1> -->
		
		</div>

		<div id="content" class="search_result_page">

			<div id="form_navigation">

				<form method="get" action="search_result.php">

					<div id="search_details">

						<fieldset class="holder">

							<ol>

								<input type="hidden" value="<?php echo $_SESSION['type']?>" name="type">
								<input type="hidden" value="<?php echo $_SESSION['price_from']?>" name="price_from">
								<input type="hidden" value="<?php echo $_SESSION['price_max']?>" name="price_max">
								<input type="hidden" value="<?php echo $_SESSION['area']?>" name="area">
								<input type="hidden" value="<?php echo $_SESSION['bedroom']?>" name="bedroom">
								<input type="hidden" value="<?php echo $_SESSION['bedroom_max']?>" name="bedroom_max">
								<input type="hidden" value="<?php echo $_SESSION['properties']?>" name="properties">

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

										<select name="order" onchange="this.form.submit()" style="margin-bottom:0px; width:140px;">
											<option value="1" <?php if($_GET['order']=='1'){echo('selected="selected"');} ?> >Lower price first</option>
											<option value="2" <?php if($_GET['order']=='2'){echo('selected="selected"');} ?> >Highest price first</option>
											<option value="3" <?php if($_GET['order']!='1' AND $_GET['order']!='2' OR $_GET['order']== null) { echo('selected="selected"'); } ?> >Order by latest first</option>
										</select>

									</fieldset>

								</li>
							</ol>

						</fieldset>

					</div>

				</form>

				<span class="back_search"><a href="search.php?properties=<?php echo $Page; ?>">Change search</a></span>

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

				<h1>Property Results</h1>

				
				<span class="subtitle">Showing <?php echo $prems; ?> - <?php if( $last > $count_result_pagination ){ $last = $count_result_pagination; } echo $last; ?> of <?php echo $count_result_pagination; ?> Results</span>

			</div>

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

					while ($donnees = $sql->fetch())
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
					$sql->closeCursor();

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
					</div>

					<br>
					<br>

					<div id="title_search" class="title">

						<h1>Maybe you'll like those properties :</h1>

					</div>

					<ul>

			<?php
						$random = $bdd -> query("SELECT * FROM property WHERE Page = '$Page' AND Statut != 'Archive' ORDER BY RAND() LIMIT 10");
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

					<?php include 'static_block/pagination.php';?>

			</span>

		<?php 

			}

		?>
	    
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

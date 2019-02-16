<li class="mix <?php echo $donnees?> mixall">

<?php 

	if($donnees['Small_picture'] == null)
	{

?>

		<div class="search_picture"><a href="property.php?properties=<?php echo $_GET['properties']; ?>&reference=<?php echo $donnees['Reference']; ?>"><img src="images/no_picture.jpg" alt="no picture" /></a></div>

<?php

	}else{

?>

		<div class="search_picture"><a href="property.php?properties=<?php echo $_GET['properties']; ?>&reference=<?php echo $donnees['Reference']; ?>"><img src="images/<?php echo $donnees['Small_picture']; ?>" alt="residence property" /></a></div>
<?php

	}

?>
	<div class="search_content">

		<!-- PROPERTY STREET  -->
		<h5><a href="property.php?reference=<?php echo $donnees['Reference']; ?>"><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></a></h5>
		

		<span class="type"><?php if($donnees['Page'] == 'commercial_buy' OR $donnees['Page'] == 'commercial_rent'){ echo $donnees['Type']; } else if($donnees['Bedroom'] != 0) { echo $donnees['Type']; ?> - <?php echo $donnees['Bedroom']; ?> Bedroom(s)  <?php } else { echo $donnees['Type']; } ?> -</span>  <span class="price">&pound;<?php echo $donnees['Price'];?> <?php echo $donnees['PricePer']?></span>
		<br>
		<p class="short_description">
			<?php 
				if($chaine != null){
					echo $chaine;
				}else{ 
			?> 
					<!-- No description available  -->
			<?php 
				} 
			?>
		</p>

		<div class="result_link">

			<a href="property.php?properties=<?php echo $donnees['Page']; ?>&reference=<?php echo $donnees['Reference']; ?>" class="view">Visit this property</a>

		</div>

	</div>
</li>
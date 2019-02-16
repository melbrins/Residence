<?php 

	if( $count_result_pagination <= $affichage ){ 

?>


<?php

	}else{

		if($nav != 0){

?>

	<span class="pagi_link"> 
		<a href="search_result.php?price_from=<?php echo $_SESSION['price_from']; ?>&price_max=<?php echo $_SESSION['price_max']; ?>&area=<?php echo $_SESSION['area']; ?>&bedrooms=<?php echo $_SESSION['bedroom']; ?>&bedrooms_max=<?php echo $_SESSION['bedroom_max']; ?>&type=<?php echo $_SESSION['type']; ?>&x=20&y=4&properties=<?php echo $Page; ?>&nav=<?php echo $nav-1; ?>&affichage=<?php echo($_GET['affichage']); ?>">
		<
		</a>  
	</span>

<?php

	}

?>

	<?php 
	$nav = $_GET['nav'];
	$nbr_page = round($count_result_pagination / $affichage);
	
	//If the number of property is less than two pages, we shoudn't take off one to the number (otherwise we have only one page when we have 8 property for example)
	// AND $nbr_page < 2 to apply it only for the first page
	if ( ! is_int ( $nbr_page) AND $nbr_page < 2){

	}else{
		
		$nbr_page--;
	
	}

	for($i = 0 ; $i <= $nbr_page ; $i++){

		if($_GET['nav'] == $i){

	?>

			<span class="pagi_link active">

	<?php 
	
		}else{ 
	
	?>

			<span class="pagi_link">

	<?php 

		}
		
	?>			

			<a href="search_result.php?type=<?php echo $_SESSION['type']; ?>&price_from=<?php echo $_SESSION['price_from']; ?>&price_max=<?php echo $_SESSION['price_max']; ?>&area=<?php echo $_SESSION['area']; ?>&bedroom=<?php echo $_SESSION['bedroom']; ?>&bedroom_max=<?php echo $_SESSION['bedroom_max']; ?>&properties=<?php echo $_SESSION['properties']; ?>&nav=<?php echo $i; ?>&affichage=10">
			
	<?php 

			echo $i+1; 
			
	?>

			</a>
		</span>

	<?php 

		}

		if($nav != $nbr_page){

	?>
	
				<span class="pagi_link"> 

					<a href="search_result.php?type=<?php echo $_SESSION['type']; ?>&price_from=<?php echo $_SESSION['price_from']; ?>&price_max=<?php echo $_SESSION['price_max']; ?>&area=<?php echo $_SESSION['area']; ?>&bedroom=<?php echo $_SESSION['bedroom']; ?>&bedroom_max=<?php echo $_SESSION['bedroom_max']; ?>&properties=<?php echo $_SESSION['properties']; ?>&nav=<?php echo $nav+1; ?>&affichage=<?php echo($_GET['affichage']); ?>">
					>
					</a> 
				
				</span>

			<?php 

			}
	}
?>
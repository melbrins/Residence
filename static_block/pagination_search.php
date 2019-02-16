<?php 

	if( $rResult <= 6 ){ 

?>


<?php

	}else{

		if($nav != 0){

?>

	<span class="pagi_link"> 
		<a href="search.php?properties=<?php echo $Page; ?>&nav=<?php echo $nav-1;?>">
			<
		</a>  
	</span>

<?php

	}

?>

	<?php 
	$nav = $_GET['nav'];
	$nbr_page = round($rResult / 10);
	
	//If the number of property is less than two pages, we shoudn't take off one to the number (otherwise we have only one page when we have 8 property for example)
	// AND $nbr_page < 2 to apply it only for the first page
	if ( ! is_int ( $nbr_page) AND $nbr_page < 2){

	}else{
		
		$nbr_page--;
	
	}

	for($i = 0 ; $i <= $nbr_page ; $i++){

		if($_GET['nav'] == $i){?>

			<span class="pagi_link active">

		<?php 
		}else { 
		?>

			<span class="pagi_link">

		<?php 
			}
		?>
			
			<a href="search.php?properties=<?php echo $Page; ?>&nav=<?php echo $i; ?>">
			
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

					<a href="search.php?properties=<?php echo $Page; ?>&nav=<?php echo $nav+1; ?>">
						>
					</a> 
				
				</span>
			<?php 
			}
	}
?>
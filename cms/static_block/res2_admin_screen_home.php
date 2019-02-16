<h2>Shop Screen</h2>

<?php 
	include '../static_block/message.php';
?>


<div id="content_nutrition" class="categorie services">

	<div class="content_categorie nutrition">

		<a href="screen_add.php?page=screen" class="new_article"><img src="../images/new_property.png"></a>

		<form method="post" action="../cms/script/screen/screen_property.php" enctype="multipart/form-data">

			<table>

				<tbody>


				<?php

					$boolean=true;
					$num_rows = $PropertyScreen->rowCount();
					$num_rows--;

					//On lance la boucle pour créer toutes les images.
					while ($donnees = $PropertyScreen->fetch())
						{

							if($donnees['Advertising'] == 'true'){
					?>
								<tr class="orange">
									<?php include 'res2_row_screen_advert.php' ?>	
								</tr>
					<?php

							}else if($boolean == true){
					?>
								<tr>
									<?php include 'res2_row_screen.php' ?>	
								</tr>
					
					<?php
					
								$boolean=false;
					
							}else{
							
						?>
						
								<tr class="grey">
									<?php include 'res2_row_screen.php'; ?>	
								</tr>
						
						<?php 
					
								$boolean=true;
					
							}
						}

						//On arrete la lecture de la table.
						$PropertyScreen->closeCursor();

					?>


				</tbody>

			</table>

			<div class="res2-btn">

				<button class="btn" type="submit">
					
					<span>Save</span>

				</button>

			</div>

		</form>
	
	</div>

</div>
<h2>Homepage Properties</h2>

<?php 
	include '../static_block/message.php';
	include 'static_block/res2_search.php'; 
?>


<div id="content_nutrition" class="categorie services">

	<div class="content_categorie nutrition">

		<form method="post" action="../cms/script/property/home_property.php" enctype="multipart/form-data">

			<table>

				<tbody>


				<?php

					$boolean=true;
					$num_rows = $PropertyHome->rowCount();
					$num_rows--;

					//On lance la boucle pour créer toutes les images.
					while ($donnees = $PropertyHome->fetch())
						{

							if($boolean == true){
					?>
								<tr>
									<?php include 'res2_row_home.php' ?>	
								</tr>
					
					<?php
					
								$boolean=false;
					
							}else{
							
						?>
						
								<tr class="grey">
									<?php include 'res2_row_home.php'; ?>	
								</tr>
						
						<?php 
					
								$boolean=true;
					
							}
						}

						//On arrete la lecture de la table.
						$PropertyHome->closeCursor();

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
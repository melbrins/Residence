<?php 
	//On lance la boucle pour créer toutes les images.
	while ($donnees = $About->fetch())
	{

?>



	<h2>About Residence</h2>

	<?php include '../static_block/message.php'; ?>

	<div id="introduction" class="categorie" style="width:500px;">

		<form method="post" action="script/about/edit_about.php" enctype="multipart/form-data">
			<textarea name="Intro" class="textarea" rows="4" cols="80" placeholder="Write your introduction here :" ><?php echo stripslashes($donnees['Intro']);?></textarea>

			<textarea name="About" class="textarea" rows="20" cols="80" placeholder="Write your text here :" ><?php echo stripslashes($donnees['About']);?></textarea>


			<div class="res2-btn">

				<button class="btn" type="submit">
					
					<span>Save</span>

				</button>
			</div>
		</form>

	</div>


	<div class="title_categorie">
		<h3>Budys</h3>
	</div>

	<div>

		<ul>
			<form method="post" action="script/about/add_budys.php" enctype="multipart/form-data">

				<li class="content_gallery" style="height:45px;">

					<div class="picture_gallery">
						<img src="../images/new_budys.png" alt="pictures"/>
					</div><!-- END : picture_gallery -->

					<div class="form_gallery">
						<div class="btn_upload">
							<input type="file" name="Image"/>
						</div>

						<div class="res2-btn">

							<button class="btn" type="submit">
								
								<span>Add</span>

							</button>
						</div>
					</div><!-- END : form_gallery -->

				</li>

			</form>

			<?php
				try{

					$slid = $bdd->query("SELECT * FROM budys");
					

					//On lance la boucle pour créer toutes les images.
					while ($donnees = $slid->fetch())
					{
										
				?>
						<form method="post" action="script/about/edit_budys.php" enctype="multipart/form-data">

							<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>

							<li class="content_gallery">

								<div class="picture_gallery">
									<img src="../images/budys/<?php echo $donnees['Picture'];?>" alt="budys logo" height="45"/>
								</div>

								<div class="form_gallery">
									<div class="btn_upload">
										<input type="file" name="Image"/>
									</div>

									<div class="delete_box">
										<input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label>
									</div>

									<div class="res2-btn">

										<button class="btn" type="submit">
											
											<span>Save</span>

										</button>

									</div>

								</div><!-- END : .form_gallery -->
							</li><!-- END : .content_gallery -->

						</form>
				<?php 					

					}
					//On arrete la lecture de la table.
					$slid->closeCursor();
				}

				//Au cas ou ca ne fonctionne pas :
				catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
			?>

			<li class="clearfix"></li>			
			</ul>
	</div>

<?php

	}
	//On arrete la lecture de la table.
	$About->closeCursor();

?>

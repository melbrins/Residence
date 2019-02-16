<h2>Valuation</h2>

<?php 
	
	include '../static_block/message.php';

	try
	{		

		$data = $bdd->query('SELECT * FROM contact WHERE page="valuation"');

	}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{

		die('Erreur : ' . $e->getMessage());

	}

	//On lance la boucle pour créer toutes les images.
	while ($donnees = $data->fetch())
	{
		if($donnees['Picture'] != null){
?>

		<div class="pic_service float">
			<img src="../images/contact/<?php echo $donnees['Picture'];?>" alt="images service" width="380px"/>
		</div>

<?php }else{ ?>
		
		<div class="pic_service float">
			<img src="../images/new_picture.jpg" alt="new property">
		</div>

<?php } ?>

		<div class="ct_service float">

			<form method="post" action="script/contact/edit_contact.php" enctype="multipart/form-data">

				<textarea name="Text" class="textarea" rows="10" cols="60" placeholder="Write your text here :"><?php echo stripslashes($donnees['Text']);?></textarea>

				<input type="file" name="Image"/>

				<input type="hidden" name="Page" Value="<?php echo $donnees['Page']; ?>"/>

				<div class="res2-btn">

					<button class="btn" type="submit">
						
						<span>Save</span>

					</button>

				</div>

			</form>

		</div>

	<?php

		}
		//On arrete la lecture de la table.
		$data->closeCursor();

	?>
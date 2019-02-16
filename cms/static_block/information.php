<?php include '../static_block/message.php'; ?>

<h2>Hello Mr Customer !</h2>

<?php

//On lance la boucle pour créer toutes les images.
	while ($donnees = $Info->fetch())
	{

?>

	<form method="post" action="script/customer_details/edit_info.php" enctype="multipart/form-data">

		<div class="res2-row">

			<label for="Email">Email <span>*</span></label>
			<span class="text-holder"><input class="required-email input" type="text" name="Email" value="<?php echo stripslashes($donnees['Email']);?>" id="email"></span>

		</div>

		<div class="res2-row">

			<label for="Telephone">Telephone <span>*</span></label>
			<span class="text-holder"><input class="required input" type="text" name="Phone" value="<?php echo stripslashes($donnees['Phone']);?>" id="phone"></span>

		</div>

		<div class="res2-row">

			<label for="Mobile">Mobile <span>*</span></label>
			<span class="text-holder"><input class="required input" type="text" name="Mobile" value="<?php echo stripslashes($donnees['Mobile']);?>" id="mobile"></span>

		</div>

		<div class="res2-row">

			<label for="Address">Address <span>*</span></label>
			<span class="text-holder"><input class="required input" type="text" name="Address" value="<?php echo stripslashes($donnees['Address']);?>" id="address"></span>

		</div>

		<div class="res2-btn">

			<button class="btn" type="submit">
				
				<span>Submit</span>

			</button>

		</div>

	</form>

	

	<div class="title_categorie">

		<h4>Password</h4>

	</div>


	<form method="post" action="script/customer_details/edit_password.php" enctype="multipart/form-data">

		<div class="res2-row">

			<label for="c_password">Current Password <span>*</span></label>
			<span class="text-holder"><input class="required input" type="password" name="c_password" value="">

		</div>

		<div class="res2-row">

			<label for="n_password">New Password <span>*</span></label>
			<span class="text-holder"><input class="required input" type="password" name="n_password" value="">

		</div>

		<div class="res2-row">

			<label for="r_password">Repeat New Password <span>*</span></label>
			<span class="text-holder"><input class="required input" type="password" name="r_password" value="">

		</div>

		<div class="res2-btn">

			<button class="btn" type="submit">
				
				<span>Submit</span>

			</button>

		</div>

	</form>


	<div class="title_categorie">

		<h4>Social Links</h4>

	</div>


	<form method="post" action="script/customer_details/edit_social_link.php" enctype="multipart/form-data">

		<div class="res2-row">

			<label for="c_password">Facebook</label>
			<span class="text-holder"><input class="required input" type="text" name="sl_facebook" value="<?php echo $donnees['Facebook'];?>">

		</div>

		<div class="res2-row">

			<label for="n_password">Google +</label>
			<span class="text-holder"><input class="required input" type="text" name="sl_google" value="<?php echo $donnees['Google'];?>">

		</div>

		<div class="res2-row">

			<label for="r_password">Twitter</label>
			<span class="text-holder"><input class="required input" type="text" name="sl_twitter" value="<?php echo $donnees['Twitter'];?>">

		</div>

		<div class="res2-row">

			<label for="r_password">Pinterest</label>
			<span class="text-holder"><input class="required input" type="text" name="sl_pinterest" value="<?php echo $donnees['Pinterest'];?>">

		</div>

		<div class="res2-btn">

			<button class="btn" type="submit">
				
				<span>Submit</span>

			</button>

		</div>

	</form>

<?php
	
	}
	//On arrete la lecture de la table.
	$Info->closeCursor();

?>
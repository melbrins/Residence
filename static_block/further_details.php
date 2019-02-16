<div id="further_details" class="detail">

	<div class="property_title">

		<h3>Further details</h3>

	</div>

	<div class="property_text">

		<ul>

			<li>
				<p><span class="label_info">Reference :</span>  <?php echo $donnees['Reference']; ?></p>
			</li>

			<li>
				<p><span class="label_info">Local authority :</span>  <?php if($donnees['LocalAuthority'] != Null){echo $donnees['LocalAuthority']; }else{?> To be confirmed <?php } ?></p>
			</li>

			<li>
				<p><span class="label_info">Council tax :</span> <?php if($donnees['CouncilTax'] != Null){ echo $donnees['CouncilTax']; }else{?> To be confirmed <?php } ?></p>
			</li>

		<?php 

			if($donnees['Page'] != 'rent' AND $donnees['Page'] != 'short'){

		?>

			<li>
				<p><span class="label_info">Ground rent :</span> <?php if($donnees['GroundRent'] != Null){  echo $donnees['GroundRent']; }else{?> To be confirmed <?php } ?></p>
			</li>

			<li>
				<p><span class="label_info">Tenure :</span> <?php if($donnees['Tenure'] != Null){echo $donnees['Tenure'];}else{?> To be confirmed <?php } ?> </p>
			</li>

			<li>
				<p><span class="label_info">Total Sq ft :</span>  <?php if($donnees['TotalSq'] != Null){ echo $donnees['TotalSq']; }else{?> To be confirmed <?php } ?></p>
			</li>

			<li>
				<p><span class="label_info">Service charge :</span>  <?php if($donnees['ServiceCharge'] != Null){ echo $donnees['ServiceCharge']; }else{?> To be confirmed <?php } ?></p>
			</li>

		<?php 

			}
				
		?>

		</ul>

	</div>

</div>
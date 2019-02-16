<td class="date_nutrition">
	<span><?php echo stripslashes(nl2br($donnees['Date']));?></span>
</td>

<td class="reference_property">
	<span><?php echo $donnees['Reference']; ?></span>
</td>

<td class="statut_property">
	<span><?php echo $donnees['Statut']; ?></span>
</td>

<td class="price_property">
	<span>&pound;<?php echo $donnees['Price']; ?></span>
</td>

<td class="title_nutrition">
	<span><?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?></span>
</td>

<td class="link_property">
	<a href="property_edit_overview.php?page=<?php echo($donnees['Page']); ?>&reference=<?php echo($donnees['Reference']); ?>">Edit</a>
</td>

<td class="order_property">
	<input type="text" class="position[]" name="<?php echo $donnees['ID']; ?>" value="<?php echo $donnees['Ordre']; ?>" size="5" tabindex=<?php echo ++$donnees['Ordre']; ?>>
</td>

<td class="reference_property">
	<span><?php echo $donnees['Reference']; ?></span>
</td>

<td class="statut_property">
	<span><?php echo $donnees['Page']; ?></span>
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

<td class="checkbox_nutrition">
	<input id="<?php echo $donnees['ID']; ?>" class="delete" type="button" value="Remove">
</td>


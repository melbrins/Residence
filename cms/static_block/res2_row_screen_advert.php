<td class="order_property">
	<input type="text" class="position[]" name="<?php echo $donnees['ID']; ?>" value="<?php echo $donnees['Ordre']; ?>" size="5" tabindex=<?php echo ++$donnees['Ordre']; ?>>
</td>

<td class="reference_property">
	<span><?php echo $donnees['Reference']; ?></span>
</td>

<td class="statut_property">
	<span>Advertising</span>
</td>

<td class="price_property">
</td>

<td class="title_nutrition">
	<span><?php echo $donnees['Street'];?></span>
</td>

<td class="link_property">
	<a href="screen_edit_advert.php?page=screen&reference=<?php echo($donnees['Reference']); ?>">Edit</a>
</td>

<td class="checkbox_nutrition">
	<input id="<?php echo $donnees['ID']; ?>" class="delete_screen" type="button" value="Remove">
</td>
<?php
    $title = $slider->getScreenTitlePerId($donnees['ID']);
?>

<td class="order_property">
	<input type="text" class="position[]" name="<?php echo $donnees['ID']; ?>" value="<?php echo $donnees['Ordre']; ?>" size="5" tabindex=<?php echo ++$donnees['Ordre']; ?>>
</td>

<td class="table-product_image">
    <img src="/slider/images/thumbs/<?php echo $donnees['Picture'];?>" width="150"/>
</td>

<td class="reference_property">
	<span><?php echo $donnees['Reference']; ?></span>
</td>

<td class="statut_property">
	<span><?php echo $donnees['Category']; ?></span>
</td>

<td class="price_property">
	<span>&pound;<?php echo number_format($donnees['Price']); ?></span>
</td>

<td class="title_nutrition">
	<span><?php echo $title; ?></span>
</td>

<td class="link_property">
	<a href="screen_edit.php?page=screen&reference=<?php echo($donnees['Reference']); ?>">Edit</a>
</td>

<td class="checkbox_nutrition">
	<input id="<?php echo $donnees['ID']; ?>" class="delete_screen" type="button" value="Remove">
</td>


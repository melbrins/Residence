<form method="post" action="script/property/search_property.php" enctype="multipart/form-data">

	<div class="res2-row float">

		<label for="ref_property">Property Reference <span>*</span></label>
		<span class="text-holder"><input class="required input" type="text" name="ref_property" value=""></span>
		<input type="hidden" name="Page" value="<?php echo $_GET['page'];?>">

	</div>

	<div class="res2-btn">

		<button class="btn" type="submit">
			
			<span>Search</span>

		</button>
	</div>

</form>
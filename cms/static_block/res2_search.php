<form method="post" action="script/property/search_property.php" enctype="multipart/form-data">

    <input type="hidden" name="Page" value="<?php echo $_GET['page'];?>">

	<div class="res2-row">

		<label for="ref_property">Property Reference <span>*</span></label>
		<span class="text-holder"><input class="required input" type="text" name="ref_property" value=""></span>

        <button class="btn secondary" type="submit">
            <span>Search</span>
        </button>
	</div>

</form>
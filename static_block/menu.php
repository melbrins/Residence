<dl>
	<!-- <dt class="home"><a href="index.php">Home</a></dt> -->
	<dt class="who"><a href="about-us.php">About us</a></dt>
	
	<dt class="properties">
		<a href="#" class="arrow_link_properties">
			Properties
			<div class="arrow_right_properties <?php if($_GET['properties'] == 'buy' OR $_GET['properties'] == 'rent' OR $_GET['properties'] == 'short'){ ?>close<?php } ?>"></div>
		</a>
	</dt>
	
	<dd id="Section1" class="submenu">
		<a href="search.php?properties=buy&nav=0" class="buy">Buy</a>
		<a href="search.php?properties=rent&nav=0" class="rent">Rent</a>
		<a href="search.php?properties=short&nav=0" class="short">Short let</a>
<!-- 		<a href="search.php?properties=commercial" class="commercial">Commercial</a> -->
	</dd>
	
	<dt class="commercials">
		<a href="#" class="arrow_link_commercials">
			Commercials
			<div class="arrow_right_commercials <?php if($_GET['properties'] == 'commercial_buy' OR $_GET['properties'] == 'commercial_rent'){ ?>close<?php } ?>"></div>
		</a>
	</dt>
	
	<dd id="Section2" class="submenu">
		<a href="search.php?properties=commercial_buy&nav=0" class="commercial_buy">Buy</a>
		<a href="search.php?properties=commercial_rent&nav=0" class="commercial_rent">Rent</a>
	</dd>
	
	<dt class="valu"><a href="valuation.php">Valuation</a></dt>
	<dt class="acqui"><a href="acquisition.php">Acquisitions</a></dt>
	<dt class="design"><a href="design.php">Design Studio</a></dt>
	<dt class="contact"><a href="contact-us.php">Contact us</a></dt>
</dl>
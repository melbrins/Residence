<?php 

include '../../../static_block/bdd.php';

	// you will need your database connection string here
	if(isset($_GET['delete']))
	{
	
		$Propertydelete = $bdd->query('UPDATE property SET Home = "false" AND Ordre = null WHERE ID = '.(int)$_GET['delete']);
	    $result = mysql_query($Propertydelete,$link);
	
	}

?>
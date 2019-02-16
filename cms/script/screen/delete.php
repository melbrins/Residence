<?php 

include '../../../static_block/bdd.php';

	// you will need your database connection string here
	if(isset($_GET['delete']))
	{
	
		$Propertydeletescreen = $bdd->query('DELETE FROM screen WHERE ID = '.(int)$_GET['delete']);
	    $result = mysql_query($Propertydeletescreen,$link);
	
	}

?>
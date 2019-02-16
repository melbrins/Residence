<?php 

include '../../../static_block/bdd.php';

$image= $_GET['Image'];
$ref= $_GET['Ref'];
	// you will need your database connection string here
	// if(isset($_GET['Image']) AND isset($_GET['Ref']))
	// {

		echo $ref;

		$Pictureselect = $bdd->query('UPDATE property SET Pictures = "test6" WHERE Reference = "$ref"');
	    $result = mysql_query($Pictureelect,$link);
	
	// }

?>
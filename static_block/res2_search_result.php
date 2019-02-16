<?php
	
	try{

		$nav = $_SESSION['nav'];
		$affichage = $_SESSION['affichage'];

		

		$prems =  $nav * $affichage;
		$last = $prems + $affichage;

		// echo ($nav);
		// echo ($prems);
		// echo ($last);
		// exit;

		$whereClauses = array(); 

		// TEST VALUES TO POPULATE SQL QUERY
		if (! empty($_SESSION['type'])) $whereClauses[] ="Type='".$_SESSION['type']."'";
		if (! empty($_SESSION['price_from']) AND empty($_SESSION['price_max'])) $whereClauses[] ="Price >= '".$_SESSION['price_from']."'"; 
		if ( empty($_SESSION['price_from']) AND ! empty($_SESSION['price_max'])) $whereClauses[] ="Price <= '".$_SESSION['price_max']."'"; 
		if (! empty($_SESSION['price_from']) AND ! empty($_SESSION['price_max'])) $whereClauses[] ="Price BETWEEN '".$_SESSION['price_from']."' AND '".$_SESSION['price_max']."'"; 
		if (! empty($_SESSION['area'])) $whereClauses[] ="Area ='".$_SESSION['area']."'";
		if (! empty($_SESSION['bedroom']) AND empty($_SESSION['bedroom_max'])) $whereClauses[] ="Bedroom >= '".$_SESSION['bedroom']."'"; 
		if ( empty($_SESSION['bedroom']) AND ! empty($_SESSION['bedroom_max'])) $whereClauses[] ="Bedroom <= '".$_SESSION['bedroom_max']."'"; 
		if (! empty($_SESSION['bedroom']) AND ! empty($_SESSION['bedroom_max'])) $whereClauses[] ="Bedroom BETWEEN '".$_SESSION['bedroom']."' AND '".$_SESSION['bedroom_max']."'";
		if (! empty($_SESSION['properties'])) $whereClauses[] ="Page='".$_SESSION['properties']."'";
		 
		$where = ''; 
		
		// VALUES ENTERED IN SEARCH FORM
		if (count($whereClauses) > 0) { 

			$where = ' WHERE '.implode(' AND ',$whereClauses); 

			switch ($_GET['order']) {

				case 1:
					$sql = $bdd->query("SELECT * FROM property ".$where." AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $last");
					break;	

				case 2:
			        $sql = $bdd->query("SELECT * FROM property ".$where." AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $last");
			        break;	

			    case 3:
			        $sql = $bdd->query("SELECT * FROM property ".$where." AND Statut != 'Archive' ORDER BY Date LIMIT $prems, $last");
			        break;	

			    default:
					$sql = $bdd->query("SELECT * FROM property ".$where." AND Statut != 'Archive' ORDER BY Date LIMIT $prems, $last");
					break;	
			}

			// COUNT RESULTS
			$count_result_pagination = $bdd->query("SELECT COUNT(ID) FROM property ".$where." AND Statut != 'Archive'")->fetchColumn();  

		// NO VALUE ENTERED IN SEARCH FORM
		}else{

			$sql = $bdd->query("SELECT * FROM property WHERE Statut != 'Archive' AND Page = ".$_SESSION['properties']." ORDER BY Price LIMIT $prems, $last");

		} 

	// 	if(! empty($_SESSION['area'])){
	// 	echo $where;
	// 	echo $count_result_pagination;
	// }
	// 	exit;
	}

	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>
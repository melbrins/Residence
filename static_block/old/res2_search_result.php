
<?php

	try
	{

		//GET ALL VARIABLES
		// $Area = $bdd->query("SELECT DISTINCT Area FROM property");
		$price_min= $_GET['price_from'];
		$price_max= $_GET['price_max'];
		$area= str_replace ( '%20' , ' ' , $_GET['area']);
		$bed= $_GET['bedrooms'];
		$bed_max = $_GET['bedrooms_max'];
		$type=$_GET['type'];
		$nav = intval(trim($_GET['nav']));
		$affichage = intval(trim($_GET['affichage']));

		$prems =  $nav * $affichage;
		$last = $prems + $affichage;

		$count_result_pagination = 0;
		

		if($area == 'All_area' AND $type == 'All_type'){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND  Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");

			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);

		}else if($area == 'All_area' AND $type != "All_type"){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");

			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':type', $type, PDO::PARAM_STR, 255);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);



			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':type', $type, PDO::PARAM_STR, 255);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


		}else if($type == "All_type" AND $area != 'All_area'){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");
			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);

		}else if($type != "All_type" AND $area != 'All_area'){

			$count = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive'");
			$count->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$count->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$count->bindParam(':type', $type, PDO::PARAM_STR, 500);
			$count->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$count->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$count->bindParam(':bed', $bed, PDO::PARAM_INT);
			$count->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);


			if($_GET['order'] == '2'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price DESC LIMIT $prems, $affichage");

			}else if($_GET['order'] == '3'){

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Date DESC LIMIT $prems, $affichage");

			}else{

				$sth = $bdd->prepare("SELECT * FROM property WHERE Price BETWEEN :price_min AND :price_max AND Type LIKE :type AND Area LIKE :area AND Page = :page AND Bedroom BETWEEN :bed AND :bed_max AND Statut != 'Archive' ORDER BY Price LIMIT $prems, $affichage");

			}

			$sth->bindParam(':price_min', $price_min, PDO::PARAM_INT);
			$sth->bindParam(':price_max', $price_max, PDO::PARAM_INT);
			$sth->bindParam(':type', $type, PDO::PARAM_STR, 500);
			$sth->bindParam(':area', $area, PDO::PARAM_STR, 500);
			$sth->bindParam(':page', $Page, PDO::PARAM_STR, 255);
			$sth->bindParam(':bed', $bed, PDO::PARAM_INT);
			$sth->bindParam(':bed_max', $bed_max, PDO::PARAM_INT);

		}

		$sth->execute();
		$count->execute();
		
		$count_result_pagination = $count->rowCount();

	}
	//Au cas ou ca ne fonctionne pas :
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
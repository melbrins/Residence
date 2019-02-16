<?php
try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=mysql5-18.60gp;dbname=melbrins', 'melbrins', 'ender711', $pdo_options);
	$req = $bdd->prepare("INSERT INTO history (Quand, Quoi) VALUE ( :when, :what)");
	$req->execute(array(
	'when' => htmlentities($_POST['When']),
	'what' => htmlentities($_POST['What'])
	));
	$req->closeCursor();
	header("Location:admin.php?page=about&edit=on");
}
catch(Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}
?>
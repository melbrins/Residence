<?php 

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=mysql5-18.60gp;dbname=melbrins', 'melbrins', 'ender711', $pdo_options);

?>
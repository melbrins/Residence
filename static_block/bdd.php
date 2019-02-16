<?php 

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=db2;dbname=reside_1', 'reside_1', 'hcx2wpaw', $pdo_options);

?>
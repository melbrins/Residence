<?php

class BDD
{
    function getPdo()
    {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=residence', 'root', 'M4g3nt0123!', $pdo_options);

        return $bdd;
    }
}

//$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
//$bdd = new PDO('mysql:host=localhost;dbname=reside_1', 'root', 'root', $pdo_options);

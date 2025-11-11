<?php

try {

    $dbname = "gestion_factures";
    $host = "localhost";
    $dbuser = "root";
    $dbpassword = "";

    $bdd = new PDO("mysql:host=localhost;dbname=gestion_factures", $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur:' . $e->getMessage());
}

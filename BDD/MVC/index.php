<?php
session_start();

require_once "controller/PlainteController.php";
require_once "model/Plainte.php";
require_once "model/Database.php";

$bdd = new Database();
$plainteModel = new Plainte($bdd);
$plainteController = new PlainteController($plainteModel);

// Routage principal
if (isset($_GET['page'])) {
    switch ($_GET['page']) {

        case 'add_plainte':
            $plainteController->addPlainte();
            break;

        case 'show_plainte':
            $id=(int)$_GET['id'];
           $plainteController->showPlainte($id);
           break;

        default:
            $plainteController->index();
            break;
    }
} else {
    // Si aucun paramètre "page", on affiche la liste par défaut
    $plainteController->index();
}

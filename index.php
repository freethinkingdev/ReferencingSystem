<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:45
 * File name: index.php
 */

include_once "Controller/Controller.php";

$newController = new Controller();


if (isset($_GET['direction']) and !empty($_GET['direction'])) {
    $newController->{$_GET['direction']}();


} else if (isset($_GET['itemToDelete']) and !empty($_GET['itemToDelete'])) {
    $fn = "itemToDelete";
    $newController->$fn($_GET['itemToDelete']);


} else if (isset($_GET['lookFor']) and !empty($_GET['lookFor']) and isset($_GET['lookIn']) and !empty($_GET['lookIn'])) {
    $fn = "searchInDB";
    $newController->$fn($_GET['lookIn'], $_GET['lookFor']);


} else {
    $newController->defaultView();
}




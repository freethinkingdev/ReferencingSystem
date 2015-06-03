<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 15:33
 * File name: index.php
 */
session_start();


include_once "Model/ModelVideo.php";
include_once "Model/ModelUser.php";
include_once "Classes/PrivateListClass.php";
require_once("RequireOnceFile.php");

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("This is the help page. Make use of it... :D");

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
/*echo "<pre>";
print_r($_GET);*/


$nBook = new ModelBook();
$nJournal = new ModelJournal();
$nNewspaper = new ModelNewspaper();
$nWebsite = new ModelWebsite();
$nVideo = new ModelVideo();

$id = $_GET['id'];
$idOfUser = $_SESSION['id'];
$typeOfTheElement = "none";
$newUser = new ModelUser();
$newUser->showUserFirstName($idOfUser);
$dbName = "AddRefDB" . $newUser->showUserFirstName($idOfUser) . $idOfUser;
$privateConnection = new PrivateListClass($dbName);


echo "You chosen reference is: <br/>";

/* Switch statement which allows to display particular element in harvard style. */

echo "<hr/>";
switch ($_GET['source']) {
    case "book":
        $nBook->echoBookAsHarvardReferenceById($id);


        break;
    case "journal":
        $nJournal->echoJournalAsHarvardReferenceById($id);

        break;
    case "newspaper":
        $nNewspaper->echoNewspaperAsHarvardReferenceById($id);

        break;
    case "website":
        $nWebsite->echoWebsiteAsHarvardReferenceById($id);

        break;
    case "video":
        $nVideo->echoVideoAsHarvardReferenceById($id);


        break;


    default:
        echo "No found";
        break;
}


if ($privateConnection->checkIfDBExists($dbName)) {
    switch ($_GET['source']) {
        case "book":
            echo "<br/>Copy this book reference";
            //$privateConnection->copyBookReference($dbName,$nBook->getBook()->getAllBookDetailsById($id)->getSurname())
            break;
        case "journal":
            echo "<br/>Copy this journal reference";
            break;
        case "newspaper":
            echo "<br/>Copy this newspaper article reference";
            break;
        case "website":
            echo "<br/>Copy this website reference";
            break;
        case "video":
            echo "<br/>Copy this video reference";
            break;


        default:
            echo "No found";
            break;
    }
} else {

    echo "<hr/>In order to copy reference to your own list, you have to create youw own list first. Please navigate to 'Browse your own list'. Once you have created private list, please repeat steps which brought you here. ";
}

Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

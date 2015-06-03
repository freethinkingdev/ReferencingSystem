<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 16:22
 * File name: index.php
 */


session_start();

include_once "Model/ModelVideo.php";

require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("References list as XML");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");

switch ($_GET['source']) {
    case "book":
        $nModel = new ModelBook();
        echo '<pre>', htmlentities($nModel->viewBookDetailsAsXml()), '</pre>';
        break;
    case "journal":
        $jModel = new ModelJournal();
        echo '<pre>', htmlentities($jModel->viewJournalDetailsAsXml()), '</pre>';
        break;
    case "newspaper":
        $pModel = new ModelNewspaper();
        echo '<pre>', htmlentities($pModel->viewNewspaperDetailsAsXml()), '</pre>';
        break;
    case "website":
        $wModel = new ModelWebsite();
        echo '<pre>', htmlentities($wModel->viewWebsiteDetailsAsXml()), '</pre>';
        break;
    case "video":
        $nVideo = new ModelVideo();
        echo '<pre>', htmlentities($nVideo->viewVideoDetailsAsXml()), '</pre>';
        break;

    default:
        // Default action
        break;
}



echo "<hr/><a href='index.php?direction=browseReferences'>BACK TO TABLE VIEW</a>";
Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

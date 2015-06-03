<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 19:46
 * File name: index.php
 */

session_start();

header('Content-type: text/plain');
header('Content-disposition: attachment; filename="references.xml"');

/*$nModel = new ModelBook();
echo $nModel->viewBookDetailsAsXml();*/
include_once "Model/ModelVideo.php";

switch ($_GET['source']) {
    case "book":
        $nModel = new ModelBook();
        echo $nModel->viewBookDetailsAsXml();
        break;
    case "journal":
        $jModel = new ModelJournal();
        echo $jModel->viewJournalDetailsAsXml();
        break;
    case "newspaper":
        $pModel = new ModelNewspaper();
        echo $pModel->viewNewspaperDetailsAsXml();
        break;
    case "website":
        $wModel = new ModelWebsite();
        echo $wModel->viewWebsiteDetailsAsXml();
        break;
    case "video":
        $nVideo = new ModelVideo();
        echo $nVideo->viewVideoDetailsAsXml();
        break;

    default:
        // Default action
        break;
}
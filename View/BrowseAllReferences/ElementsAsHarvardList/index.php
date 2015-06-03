<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 16:05
 * File name: index.php
 */
session_start();
include_once "Model/ModelJournal.php";
include_once "Model/ModelNewspaper.php";
include_once "Model/ModelVideo.php";
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("References list as plain, harvard style text.");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");


/*Creating textual representation of book references*/
$bModel = new ModelBook();
foreach ($bModel->getAllIds() as $key => $value) {
    foreach ($bModel->returnArrayOfBookElementsAsHarvardList($value) as $key2 => $value2) {
        echo $value2;
    }
    echo "<br/>";
}
echo "<br/>";


/*Creating textual representation of journal references*/
$jjModel = new ModelJournal();
foreach ($jjModel->getAllIds() as $key3 => $value3) {
    foreach ($jjModel->returnArrayOfJournalElementsAsHarvardList($value3) as $key4 => $value4) {
        echo $value4;
    }
    echo "<br/>";
}
echo "<br/>";


/*Creating textual representation of newspaper references*/
$nModel = new ModelNewspaper();

foreach ($nModel->getAllIds() as $key5 => $value5) {
    foreach ($nModel->returnArrayOfNewspaperElementsAsHarvardList($value5) as $key6 => $value6) {
        echo $value6;
    }

    echo "<br/>";

}
echo "<br/>";

/*Creating textual representation of websites references*/
$wModel = new ModelWebsite();

foreach ($wModel->getAllIds() as $key5 => $value5) {
    foreach ($wModel->returnArrayOfWebsiteElementsAsHarvardList($value5) as $key6 => $value6) {
        echo $value6;
    }

    echo "<br/>";

}
echo "<br/>";


/*Creating textual representation of video references*/
$nVideo = new ModelVideo();

foreach ($nVideo->getAllIds() as $key5 => $value5) {
    foreach ($nVideo->returnArrayOfVideoElementsAsHarvardList($value5) as $key6 => $value6) {
        echo $value6;
    }

    echo "<br/>";

}
echo "<br/>";

echo "<a href='index.php?direction=saveListAsPlainText'>SAVE REFERENCES AS PLAIN TXT FILE</a>";
echo "<hr/><a href='index.php?direction=browseReferences'>BACK TO TABLE VIEW</a>";
Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

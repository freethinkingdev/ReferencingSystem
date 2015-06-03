<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 13:53
 * File name: index.php
 */


@session_start();

/*echo"<br/>";
print_r($_SESSION);
echo"<br/>";
if (isset($_GET)) {
    print_r($_GET);
}
echo "<hr/>";*/
require_once("RequireOnceFile.php");
include_once "Model/ModelBook.php";
include_once "Model/ModelJournal.php";
include_once "Model/ModelNewspaper.php";
include_once "Model/ModelWebsite.php";
include_once "Model/ModelVideo.php";
/*echo "<pre>";
print_r ($_GET);*/
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("Browse all references available in the service");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<p>You will find all references bellow</p>");


echo "<h3><a href='index.php?direction=viewElementsAsHarvardList'>View all references as harvard list</a></h3>";


/*********************************** Table bellow displays books list *************************************************/


/*This form provides an input field which is used to search for the items in the table*/
echo "<form class='search' method='get' action='index.php'>";
echo "Search for: ";
echo "<input title='Type in what you are looking for please.' required type='text' name='lookFor'/>";
echo " In: ";
echo "<select title='Choose, where you would like to search for a given criteria.' name='lookIn'>";
echo "<option value='surname'>Surname</option>";
echo "<option value='initials'>Initials</option>";
echo "<option value='year'>Year</option>";
echo "<option value='title'>Title</option>";
echo "<option value='description'>Description</option>";
echo "<option value='date_added'>Date added</option>";
echo "</select>";
echo " Source: ";
echo "<select title='Choose, what sources you would like to search.' name='source'>";
echo "<option value='books'>Books</option>";
echo "<option value='journals'>Journals</option>";
echo "<option value='newspaper'>Newspaper</option>";
echo "<option value='websites'>Websites</option>";
echo "<option value='video'>Video</option>";
echo "</select>";
echo "<input title='Click here in order to look for a positions in the table.' type='submit' value='SEARCH'/>";
echo "</form>";


$bModel = new ModelBook();
$jModel = new ModelJournal();
$nModel = new ModelNewspaper();
$webModel = new ModelWebsite();
$videoModel = new ModelVideo();

/*
 * If statement check whether there a source variable provided in GET (if it is, it means that user performed search)
 */
if (isset($_GET['source'])) {
    /* Switch statement checks what kind of source is provided in the get. Appropriate table with sources is displayed once the type is recognized */

    switch ($_GET['source']) {
        case "books":

            echo "<h2>Books</h2>";
            $booksTable = new Table();
            $booksTable->addTableHeader(array("ID", "Surname", "Initial", "Year", "Title", "Edition", "Place of publication", "Publisher", "Description", "Date added", "Option"), "table");
            foreach ($bModel->getBook()->searchTheBookTableFor($_GET['lookIn'], $_GET['lookFor']) as $v) {
                foreach ((array)$v as $aj) {
                    @$booksTable->addRowData($bModel->returnArrayOfBookElementsAsTable($aj));
                }
            }

            $booksTable->closeTable();
            break;


        case "journals":

            echo "<h2>Journals</h2>";
            $journalTable = new Table();
            $journalTable->addTableHeader(array("ID", "Surname", "Initial", "Year", "Title", "Journal Title", "Volume", "Part", "Pages", "Description", "Date added", "Options"));
            foreach ($jModel->getJournal()->searchTheJournalTableFor($_GET['lookIn'], $_GET['lookFor']) as $v1) {
                foreach ((array)$v1 as $aj1) {
                    @$journalTable->addRowData($jModel->returnArrayOfJournalElementsAsTable($aj1));
                    //var_dump($jModel->returnArrayOfJournalElementsAsTable($aj1));
                }
            }
            $journalTable->closeTable();
            break;


        case "newspaper":
            echo "<h2>Newspaper</h2>";
            $newspaperTable = new Table();
            $newspaperTable->addTableHeader(array("ID", "Surname", "Initial", "Year", "Title", "Newspaper Title", "Date of article", "Pages", "Description", "Date added", "Options"), "journals_table");
            foreach ($nModel->getNewspaper()->searchTheNewspaperTableFor($_GET['lookIn'], $_GET['lookFor']) as $v1) {
                foreach ((array)$v1 as $aj1) {
                    @$newspaperTable->addRowData($nModel->returnArrayOfNewspaperElementsAsTable($aj1));
                }
            }

            $newspaperTable->closeTable();
            break;


        case "websites":
            echo "<h2>Websites</h2>";
            $websitesTable = new Table();
            $websitesTable->addTableHeader(array("ID", "Surname / Website", "Initials", "Year", "Title", "Type", "URL", "Description", "Date accessed", "Date added", "Options"), "websites_table");
            foreach ($webModel->getWebsite()->searchTheWebsiteTableFor($_GET['lookIn'], $_GET['lookFor']) as $v1) {
                foreach ((array)$v1 as $aj1) {
                    @$websitesTable->addRowData($webModel->returnArrayOfWebsiteElementsAsTable($aj1));
                }

            }
            $websitesTable->closeTable();
            break;

        case "video":
            echo "<h2>Websites</h2>";
            $videoTable = new Table();
            $videoTable->addTableHeader(array("ID", "Uploader", "Year of release", "Title", "Type", "URL", "Description", "Date accessed", "Date added", "Options"), "websites_table");
            foreach ($videoModel->getVideo()->searchTheVideoTableFor($_GET['lookIn'], $_GET['lookFor']) as $v1) {
                foreach ((array)$v1 as $aj1) {
                    @$videoTable->addRowData($videoModel->returnArrayOfVideoElementsAsTable($aj1));
                }

            }
            $videoTable->closeTable();
            break;


        default:
            echo "None found";
            break;
    }


} else {
    /******************************** BOOKS table *******************************/
    echo "<h2>Books</h2>";
    $booksTable = new Table();
    $booksTable->addTableHeader(array("ID", "Surname", "Initial", "Year", "Title", "Edition", "Place of publication", "Publisher", "Description", "Date added", "Option"), "table");
    foreach ($bModel->getAllIds() as $aj => $aw) {
        $booksTable->addRowData(@$bModel->returnArrayOfBookElementsAsTable($aw));
    }
    $booksTable->closeTable();
    echo "<h3><a href='index.php?direction=viewElementAsXML&amp;source=book'>View as XML document</a> or <a href='index.php?direction=saveElementAsXML&amp;source=book'>SAVE AS XML</a></h3>";


    /******************************** JOURNALS table *******************************/
    echo "<h2>Journals</h2>";
    $journalTable = new Table();
    $journalTable->addTableHeader(array("ID", "Surname", "Initial", "Year", "Title", "Journal Title", "Volume", "Part", "Pages", "Description", "Date added", "Options"));
    foreach ($jModel->getAllIds() as $aj1 => $aw1) {
        $journalTable->addRowData($jModel->returnArrayOfJournalElementsAsTable($aw1));
    }
    $journalTable->closeTable();
    echo "<h3><a href='index.php?direction=viewElementAsXML&amp;source=journal''>View as XML document</a> or <a href='index.php?direction=saveElementAsXML&amp;source=journal'>SAVE AS XML</a></h3>";


    /******************************** NEWSPAPER table *******************************/
    echo "<h2>Newspaper</h2>";
    $newspaperTable = new Table();
    $newspaperTable->addTableHeader(array("ID", "Surname", "Initial", "Year", "Title", "Newspaper Title", "Date of article", "Pages", "Description", "Date added", "Options"), "journals_table");

    foreach ($nModel->getAllIds() as $aj1 => $aw1) {
        $newspaperTable->addRowData($nModel->returnArrayOfNewspaperElementsAsTable($aw1));
    }
    $newspaperTable->closeTable();

    echo "<h3><a href='index.php?direction=viewElementAsXML&amp;source=newspaper''>View as XML document</a> or <a href='index.php?direction=saveElementAsXML&amp;source=newspaper'>SAVE AS XML</a></h3>";


    /******************************** WEBSITES table *******************************/
    echo "<h2>Websites</h2>";
    $websitesTable = new Table();
    $websitesTable->addTableHeader(array("ID", "Surname / Website", "Initials", "Year", "Title", "Type", "URL", "Description", "Date accessed", "Date added", "Options"), "websites_table");
    foreach ($webModel->getAllIds() as $aj1 => $aw1) {
        $websitesTable->addRowData($webModel->returnArrayOfWebsiteElementsAsTable($aw1));
    }
    $websitesTable->closeTable();
    echo "<h3><a href='index.php?direction=viewElementAsXML&amp;source=website''>View as XML document</a> or <a href='index.php?direction=saveElementAsXML&amp;source=website'>SAVE AS XML</a></h3>";


    /******************************** VIDEO table *******************************/
    echo "<h2>YouTube Videos</h2>";
    $videoTable = new Table();
    $videoTable->addTableHeader(array("ID", "Uploader", "Year of release", "Title", "Type", "URL", "Description", "Date accessed", "Date added", "Options"), "video_table");
    foreach ($videoModel->getAllIds() as $aj1 => $aw1) {
        $videoTable->addRowData($videoModel->returnArrayOfVideoElementsAsTable($aw1));
    }
    $videoTable->closeTable();
    echo "<h3><a href='index.php?direction=viewElementAsXML&amp;source=video''>View as XML document</a> or <a href='index.php?direction=saveElementAsXML&amp;source=video'>SAVE AS XML</a></h3>";

}


Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");





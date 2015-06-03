<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 11:27
 * File name: index.php
 */

session_start();
require_once("RequireOnceFile.php");

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("Please confirm that a reference is correct and add it to a database");

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<p>
This is you reference:<br/>");

Page::addMainBodyToThePage("</p>");


switch ($_GET['type']) {
    /* In this switch statement script picks up what kind of source is forwarded in the type querystring. By implementing querystring, the amount of different views can be reduced. */
    case "book":
        echo $_POST['surname_of_author'] . ", " . $_POST['initial_of_author'] . "., " . $_POST['year_of_publication'] . ". <i>" . $_POST['title'] . "</i>. " . $_POST['edition'] . ". " . $_POST['place_of_publication'] . ": " . $_POST['publisher'] . ".";
        Page::addMainBodyToThePage("<p>
        Is it correct?<br/> If so, please <a href='index.php?direction=addBookRefSql&amp;surname_of_author=" . $_POST['surname_of_author'] .
        "&amp;initial_of_author=" . $_POST['initial_of_author'] .
        "&amp;year_of_publication=" . $_POST['year_of_publication'] .
        "&amp;title=" . $_POST['title'] .
        "&amp;edition=" . $_POST['edition'] .
        "&amp;place_of_publication=" . $_POST['place_of_publication'] .
        "&amp;publisher=" . $_POST['publisher'] .
        "&amp;txtarea=" . $_POST['txtarea'] .
        "&amp;sessionId=" . $_SESSION['id'] .
            /*It is important to specify type of the source*/
        "&amp;type=book" .
        "'>ADD</a> it to a database, or <a href='index.php?direction=addRef'>GO BACK</a> to add reference once again.</p>");
        Page::addMainBodyToThePage("</div>");
    break;

    case "newspaper":
        echo $_POST['surname_of_author'] . ", " . $_POST['initial_of_author'] . "., " . $_POST['year_of_publication'] . ". <i>" . $_POST['title'] . "</i>. " . $_POST['title_of_newspaper'] . ". " . $_POST['date_and_month'] . ": " . $_POST['page_numbers'] . ".";
        Page::addMainBodyToThePage("<p>
        Is it correct?<br/> If so, please <a href='index.php?direction=addBookRefSql&amp;surname_of_author=" . $_POST['surname_of_author'] .
            "&amp;initial_of_author=" . $_POST['initial_of_author'] .
            "&amp;year_of_publication=" . $_POST['year_of_publication'] .
            "&amp;title=" . $_POST['title'] .
            "&amp;title_of_newspaper=" . $_POST['title_of_newspaper'] .
            "&amp;date_and_month=" . $_POST['date_and_month'] .
            "&amp;page_numbers=" . $_POST['page_numbers'] .
            "&amp;txtarea=" . $_POST['txtarea'] .
            "&amp;sessionId=" . $_SESSION['id'] .
            /*It is important to specify type of the source*/
            "&amp;type=newspaper" .
            "'>ADD</a> it to a database, or <a href='index.php?direction=addRef'>GO BACK</a> to add reference once again.</p>");
        Page::addMainBodyToThePage("</div>");
    break;


    case "website":
        echo $_POST['surname_of_author'] . ", " . $_POST['initial_of_author'] . " " . $_POST['year_of_publication'] . ". <i>" . $_POST['title'] . "</i>. " . "[online]. " . " Avaiable from: " . $_POST['url_of_document'] . "[Accessed " . $_POST['date_accessed']."]";
        Page::addMainBodyToThePage("<p>
        Is it correct?<br/> If so, please <a href='index.php?direction=addBookRefSql&amp;surname_of_author=" . $_POST['surname_of_author'] .
            "&amp;initial_of_author=" . $_POST['initial_of_author'] .
            "&amp;year_of_publication=" . $_POST['year_of_publication'] .
            "&amp;title=" . $_POST['title'] .
            "&amp;url=" . $_POST['url_of_document'] .
            "&amp;date_accessed=" . $_POST['date_accessed'] .
            "&amp;txtarea=" . $_POST['txtarea'] .
            "&amp;sessionId=" . $_SESSION['id'] .
            /*It is important to specify type of the source*/
            "&amp;type=website" .
            "'>ADD</a> it to a database, or <a href='index.php?direction=addRef'>GO BACK</a> to add reference once again.</p>");
        Page::addMainBodyToThePage("</div>");
    break;

    case "journal":
        echo $_POST['surname_of_author'] . ", " . $_POST['initial_of_author'] ."., ". $_POST['year_of_publication'] .". ". $_POST['title'].". <i>". $_POST['title_of_journal']."</i>, ". $_POST['volume_number']."(". $_POST['volume_part_number']."), pp.". $_POST['page_numbers'];
        Page::addMainBodyToThePage("<p>
        Is it correct?<br/> If so, please <a href='index.php?direction=addBookRefSql&amp;surname_of_author=" . $_POST['surname_of_author'] .
            "&amp;initial_of_author=" . $_POST['initial_of_author'] .
            "&amp;year_of_publication=" . $_POST['year_of_publication'] .
            "&amp;title=" . $_POST['title'] .
            "&amp;title_of_journal=" . $_POST['title_of_journal'] .
            "&amp;volume_number=" . $_POST['volume_number'] .
            "&amp;volume_part_number=" . $_POST['volume_part_number'] .
            "&amp;page_numbers=" . $_POST['page_numbers'] .
            "&amp;txtarea=" . $_POST['txtarea'] .
            "&amp;sessionId=" . $_SESSION['id'] .
            /*It is important to specify type of the source*/
            "&amp;type=journal" .
            "'>ADD</a> it to a database, or <a href='index.php?direction=addRef'>GO BACK</a> to add reference once again.</p>");
        Page::addMainBodyToThePage("</div>");
    break;

    case "video":
        echo $_POST['surname_of_author'] . ", ". $_POST['year_of_publication'] .". <i>". $_POST['title'] ."</i>. Available at: " . $_POST['url_of_document'] . " Accessed: " . $_POST['date_accessed'];
        Page::addMainBodyToThePage("<p>
        Is it correct?<br/> If so, please <a href='index.php?direction=addBookRefSql&amp;surname_of_author=" . $_POST['surname_of_author'] .
            "&amp;year_of_publication=" . $_POST['year_of_publication'] .
            "&amp;title=" . $_POST['title'] .
            "&amp;url=" . $_POST['url_of_document'] .
            "&amp;date_accessed=" . $_POST['date_accessed'] .
            "&amp;txtarea=" . $_POST['txtarea'] .
            "&amp;sessionId=" . $_SESSION['id'] .
            /*It is important to specify type of the source*/
            "&amp;type=video" .
            "'>ADD</a> it to a database, or <a href='index.php?direction=addRef'>GO BACK</a> to add reference once again.</p>");
        Page::addMainBodyToThePage("</div>");
    break;

    default:
        // Default action
        break;
}

Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");
<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 13:40
 * File name: index.php
 */

session_start();
require_once("RequireOnceFile.php");
//
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("Choose what type of reference you would like to add.");

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");

if(isUserLoggedIn()){



    Page::addMainBodyToThePage('
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Book</a></li>
        <li><a href="#tabs-2">Newspaper</a></li>
        <li><a href="#tabs-3">Website</a></li>
        <li><a href="#tabs-4">Journal</a></li>
        <li><a href="#tabs-5">Video</a></li>
    </ul>

    ');

Page::addMainBodyToThePage('<div id="tabs-1">');
//Book tab
/* this is the form which will allow user to add book reference to the list */
/*Page::addMainBodyToThePage("<h2 title='Click here to add a book reference' id='add_book'>Book</h2>");*/
// The variable in the type has to be forwarded to the next file
Form::startForm("post", "index.php?direction=addSourceRef&amp;type=book", "add_ref_book","Book");
Form::addFormInput("text", "surname_of_author", "Surname","required");
Form::addFormInput("text", "initial_of_author", "Authors initial");
Form::addSelectInput("Year of publication", "year_of_publication", generateNumbersFromNumberAtoAcurrentYear(1900));
Form::addFormInput("text", "title", "Title");
Form::addSelectInput("Edition" . "<br/>", "edition", generateNumbersFromNumberAtoAnumberB(1, 10));
Form::addFormInput("text", "place_of_publication", "Place of publication");
Form::addFormInput("text", "publisher", "Publisher");
Form::addTextArea("Description: ", "");
Form::addResetButton();
Form::addSubmitButton("Add", "add_ref_button");
Page::addMainBodyToThePage("</div>");

// Newspaper tab
Page::addMainBodyToThePage('<div id="tabs-2">');
/* form below is responsible for the newspaper reference */
/*Page::addMainBodyToThePage("<h2 id='add_newspaper'>Newspaper</h2>");*/
// The variable in the type has to be forwarded to the next file
Form::startForm("post", "index.php?direction=addSourceRef&amp;type=newspaper", "add_ref_newspaper","Newspaper article");
Form::addFormInput("text", "surname_of_author", "Author's surname: ");
Form::addFormInput("text", "initial_of_author", "Author's initial: ");
Form::addSelectInput("Year of publication", "year_of_publication", generateNumbersFromNumberAtoAcurrentYear(1900));
Form::addFormInput("text", "title", "Title of article: ");
Form::addFormInput("text", "title_of_newspaper", "Title of newspaper: ");
Form::addFormInput("text", "date_and_month", "Date of article: ");
Form::addFormInput("text", "page_numbers", "Page numbers of article: ");
Form::addTextArea("Description", "");
Form::addResetButton();
Form::addSubmitButton("Add", "add_ref_button");
Page::addMainBodyToThePage("</div>");


// Website tab
Page::addMainBodyToThePage('<div id="tabs-3">');
/* form below is responsible for the website reference */
/*Page::addMainBodyToThePage("<h2 id='add_website'>Website</h2>");*/
Form::startForm("post", "index.php?direction=addSourceRef&amp;type=website", "add_ref_website", "Website");
Form::addFormInput("text", "surname_of_author", "Author's surname: ");
Form::addFormInput("text", "initial_of_author", "Author's initial: ");
Form::addSelectInput("Year of publication", "year_of_publication", generateNumbersFromNumberAtoAcurrentYear(1900));
Form::addFormInput("text", "title", "Document title: ");
Form::addURL("url_of_document", "Url of document: ");
Form::addFormInput("text", "date_accessed", "Date accessed: ");
Form::addTextArea("Description", "");
Form::addResetButton();
Form::addSubmitButton("Add", "add_ref_button");
Page::addMainBodyToThePage("</div>");

// Journal tab
Page::addMainBodyToThePage('<div id="tabs-4">');
/*Page::addMainBodyToThePage("<h2 id='add_journal'>Journal</h2>");*/
Form::startForm("post", "index.php?direction=addSourceRef&amp;type=journal", "add_ref_journal","Journal");
Form::addFormInput("text", "surname_of_author", "Author's surname: ");
Form::addFormInput("text", "initial_of_author", "Author's initial: ");
Form::addSelectInput("Year of publication", "year_of_publication", generateNumbersFromNumberAtoAcurrentYear(1900));
Form::addFormInput("text", "title", "Title of article: ");
Form::addFormInput("text", "title_of_journal", "Title of journal: ");
Form::addNumberInput("volume_number", "Type in volume number: ", 1, 1000);
Form::addNumberInput("volume_part_number", "Specify part number: ", 1, 1000);
Form::addNumberInput("page_numbers", "Page numbers: ", 1, 1000);
Form::addTextArea("Description: ", "");
Form::addResetButton();
Form::addSubmitButton("Add", "add_ref_button");
Page::addMainBodyToThePage("</div>");

// Video tab
Page::addMainBodyToThePage('<div id="tabs-5">');
Form::startForm("post", "index.php?direction=addSourceRef&amp;type=video", "add_ref_video","Video");
Form::addFormInput("text", "surname_of_author", "Name of person posting video: ");
Form::addSelectInput("Year video posted", "year_of_publication", generateNumbersFromNumberAtoAcurrentYear(1900));
Form::addFormInput("text", "title", "Title of video: ");
Form::addURL("url_of_document", "Url of document: ");
Form::addFormInput("text", "date_accessed", "Date accessed: ");
Form::addTextArea("Description: ", "");
Form::addResetButton();
Form::addSubmitButton("Add", "add_ref_button");
Page::addMainBodyToThePage("</div>");


Page::addMainBodyToThePage("</div>");



} else {
    echo "Hey. It seems that you forgot to log in. In order to add any reference you will have to log in. Thanks :)";
}


Page::addMainBodyToThePage("</div>");

Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");
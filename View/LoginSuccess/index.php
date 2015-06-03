<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 12:39
 * File name: index.php
 */
@session_start();
include_once "Model/ModelUser.php";
require_once("RequireOnceFile.php");

$id = $_SESSION['id'];

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage();

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
if (isUserLoggedIn()) {


    $nUser = new ModelUser();

    Page::addMainBodyToThePage("
<p>You have successfully logged in.</p>
<p>Now you can add and browse all references</p>
");
    echo "<p>Hi " . $nUser->showUserFirstName($id) . ". It is nice to see you come back :) &nbsp;</p>";
} else {
    echo "You have to log in in order to see that page.";
}
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

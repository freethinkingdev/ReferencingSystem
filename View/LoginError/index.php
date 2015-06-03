<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:29
 * File name: index.php
 */

session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("This is the help page. Make use of it... :D");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");
echo "<p>There was an error....please, try once again.</p>";
echo "<p><img id='errorImg' alt='Error image' src='Images/errorl.jpg' /></p>";
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

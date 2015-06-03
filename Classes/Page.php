<?php
/**
 * User: Marcin
 * Date: 18/10/2012
 * Time: 00:06
 * File name: Page.php
 */
class Page
{
 private $header;
 private $mainContent;
 private $footer;

 /*
  * Function, which creates css linkage between html file and css file. Default value is css/css.css
  */
 static public function addHtmlMetadataOfHtml($cssFile = "css/css.css",$title = "AddRefToWeb")
 {
  echo  Css::addExternalCssToTheFile($cssFile) . "<title>".$title."</title></head>";

 }
/*
 * Important function, which adds all meta to the file in html5 format. It takes optional argument of h1 text.
 */
 static public function addHeaderToThePage($contentToAddToTheHeader = "*** Welcome to AddRefToWeb website ***")
 {
  echo "<body><div id='header'><h1 title='Header information'>" . $contentToAddToTheHeader . "</h1><hr></div>";
 }

 static public function addMainBodyToThePage($contentToAdd)
 {
  echo $contentToAdd;
 }
/*
 * Adding footer to the page.
 */
 static public function addFooterToThePage($addFooterContent, $idOfFooterDivTag = "footer")
 {
  echo "<div id='" . $idOfFooterDivTag . "'><p>" . $addFooterContent . "</p></div></body></html>";
 }
/*
 * This function adds menu to the page as the name suggests. It takes an associative array as argument, and creates an ul
 * and li elements from the keys and values.
 */
 static function  addNavigationToThePage($assocArrayOfLinkAndLinkTitle)
 {
  echo"<div id='menu'>";
  echo "<ul>";
  foreach ($assocArrayOfLinkAndLinkTitle as $key => $arg) {
   echo "<li><a title='".$key."' href='" . $arg . "' >$key</a></li>";
   //echo "<p><a href='".$arg."'>".$key."</a></p>";
  }
  echo "</ul>";
  echo"</div>";

 }
/*
 * Simply, clearing any floating.
 */
 static function addClearBothDiv()
 {
  echo "<div id='clearing_div'></div>";
 }

 static function addContentTableHeader($arg){
  echo "<p class='content_header'>{$arg} <span>(click here to toggle the view)</span></p>";
 }
}

<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 13:35
 * File name: commonMenuV.php
 */

include_once "RequireOnceFile.php";
if (isUserLoggedIn()) {
 Page::addNavigationToThePage(array("*  Home"=>"index.php","*  Add reference"=>"index.php?direction=addRef","*  Browse references"=>"index.php?direction=browseReferences","*  Browse own list"=>"index.php?direction=browsePrivateList","*  Logout" => "index.php?direction=logout","*  Help"=>"index.php?direction=helpMe"));
} else {
 Page::addNavigationToThePage(array("*  Home" => "index.php", "*  Login" => "index.php?direction=loginPage","*  Help"=>"index.php?direction=helpMe"));
}
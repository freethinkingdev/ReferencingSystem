<?php
/**
 * User: Marcin
 * Date: 02/12/2012
 * Time: 21:24
 * File name: index.com.php
 */

session_start();


require_once("RequireOnceFile.php");
include_once "Classes/PrivateListClass.php";
include_once "Classes/Table.class.php";
include_once "Model/ModelUser.php";


Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("This is the place, where you can browse your private reference list");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");

if (isUserLoggedIn()) {
    $id = $_SESSION['id'];
    $newUser = new ModelUser();
    $dbName = "AddRefDB".$newUser->showUserFirstName($id) . $id;
    $privateConnection = new PrivateListClass($dbName);

    if (isset($_GET['ownlist']) and $_GET['ownlist'] == "yes") {
        $privateConnection->createPrivateDatabase($dbName);
        echo "<p>You list has been created!</p>";
    } else {
        if ($privateConnection->checkIfDBExists($dbName)) {
            /*This is where the code goes if the DB exists */
            echo "<br/>Your private list exists.";


            $bModel = new ModelBook();



        } else {
            echo "<p>Hey, it seem you do not have your private list of references. Would you like to create one?</p>";
            echo "<p><a href='index.php?direction=createPrivateList'>YES</a></p>";

        }
    }



} else {
    echo "You have to login in order to see the page";
}

Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

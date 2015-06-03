<?php
/**
 * User: Marcin
 * Date: 12/11/2012
 * Time: 18:54
 * File name: index.php
 */

session_start();
require_once("RequireOnceFile.php");



Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage();

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>
<p><img alt='reference_picture' title='AddRefToWeb' src='Images/MainReference.jpg'/> </p>
<p>AddRefToWeb is a service, which allows to add variety of references to a database for later use. Once you login, you can upload your references in an easy way, using simple html forms.</p>
<p>According to Wikiepdia reference is: 'an author-title-date information in bibliographies and footnotes, specifying complete works of other people. Copying of material by another author without proper citation or without required permissions is plagiarism.'</p>
<p>In order to keep all your references, AddRefToWeb service allows to input all the reference material you have into a database.</p>
</div>");


Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");


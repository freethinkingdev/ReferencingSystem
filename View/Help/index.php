<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 12:44
 * File name: index.php
 */
session_start();
require_once("RequireOnceFile.php");

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("This is the help page. Make use of it... :D");

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("
<h2 id='help_top'>HELP page</h2>
<ul>
    <li><a href='#addreftoweb'>1. AddRefToWeb</a></li>
    <li><a href='#add_reference'>2. Adding reference</a></li>
    <li><a href='#browse_reference'>3. Browsing reference</a></li>
    <li><a href='#view_as_xml'>4. Viewing as XML</a></li>
    <li><a href='#save_as_xml'>5. Saving as XML</a></li>
    <li><a href='#plain_text_reference'>6. Plain text references</a></li>
</ul>


<div id='addreftoweb'><p>
<h3>1. AddRefToWeb</h3><br/>AddRefToWeb is an online system which allows you to store yor list of references online.
The biggest advantage of the system could be that it is online. It therefore allow you to access your list of
references from any place around the globe (if you will have research work in Africa etc. ).
Service is based on PHP and JavaScript languages. Please, make sure that you have JavaScript switched on in your browser.
</p><a href='#help_top'>BACK TO TOP</a></div>

<div id='add_reference'><p>
<h3>2. Adding reference</h3><br/> You can add your reference in a very easy way. From the menu on the left, click add reference element.
This would bring you to a set of tabs where you can add reference sources. Pick the tab of the source you would like to add, and fill in form.
Once add is being clicked, confirmation page will load where you will have chance to confirm your chosen reference.
Click add in order to save the reference to a database.
<img alt='Add reference tabs' src='Images/addRef.png'/><br/>
<img alt='Add reference form' src='Images/addRefForm.png'/>
</p>

<a href='#help_top'>BACK TO TOP</a></div>

<div id='browse_reference'><p>
<h3>3. Browsing reference</h3><br/>In order to browse references, click browse reference from the main menu. A list of refeferences will show up.
From the main window you will have chance to view the list as harvard list or xml. You will have also opportunity to search for item in database.
In order to search references, specify what you are looking for and where together with a keywords.
</p><a href='#help_top'>BACK TO TOP</a></div>


<div id='view_as_xml'><p>
<h3>4. Viewing as XML</h3><br/>When you browse all references, under each table you should notice view as XML document and SAVE AS XML.
In order to view element as XML click view as xml.<br/>
<img alt='View as xml' src='Images/viewAsXML.png'/>
</p><a href='#help_top'>BACK TO TOP</a></div>

<div id='save_as_xml'><p>
<h3>5. Saving as XML</h3><br/>When you browse all references, under each table you should notice view as XML document and SAVE AS XML.
In order to save element as XML click save as xml.<br/>
<img alt='Save as xml' src='Images/viewAsXML.png'/>
</p><a href='#help_top'>BACK TO TOP</a></div>


<div id='plain_text_reference'><p>
<h3>6. Plain text references</h3><br/>When browsing all references, on top of the page you will notice view all references as harvard list. Click that link in order to view sources as harvard list.<br/>
<img alt='View as harvard list' src='Images/viewAsHarvardList.png'/>
</p><a href='#help_top'>BACK TO TOP</a></div>





");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");

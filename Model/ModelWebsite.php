<?php
/**
 * User: Marcin
 * Date: 25/11/2012
 * Time: 13:17
 * File name: ModelWebsite.php
 */
include_once "Classes/WebsiteDAO.php";

class ModelWebsite
{
    private $website;
    private $allIds;
    private $title;

    function __construct()
    {
        $this->website = new WebsiteDAO();
        //$this->title = $this->website->getAllWebsiteDetails()->getTitle();
        $this->allIds = $this->website->getAllTheIdsOfWebsite();
    }

    function __destruct()
    {
        unset($this->website);
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getAllIds()
    {
        return $this->allIds;
    }

    public function returnArrayOfWebsiteElementsAsTable($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getId();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getSurname();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getInitials();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getYear();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getTitle();
        $arrayOfElements[] = "online";
        $arrayOfElements[] = "<a href='".$this->website->getAllWebsiteDetailsById($id)->getUrl()."' target='_blank'>".$this->website->getAllWebsiteDetailsById($id)->getUrl()."</a>";
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getDescription();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getDateLastAccessed();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getDateAdded();
        $arrayOfElements[] = "<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?itemToDelete=" . $this->website->getAllWebsiteDetailsById($id)->getId() . "'>X</a> |<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?direction=copyElement&amp;source=website&amp;id=" . $this->website->getAllWebsiteDetailsById($id)->getId() . "'>C</a> ";
        return $arrayOfElements;
    }

    public function returnArrayOfWebsiteElementsAsHarvardList($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getSurname() . ", ";
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getInitials() . "., ";
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getYear() . ". <i>";
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getTitle() . "</i>. ";
        $arrayOfElements[] = "[online].";
        $arrayOfElements[] = " Avaiable from: ";
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getUrl();
        $arrayOfElements[] = " Accessed: ";
        $arrayOfElements[] = $this->website->getAllWebsiteDetailsById($id)->getDateLastAccessed();

        return $arrayOfElements;
    }

    public function addWebsiteToDatabase($surname, $initial, $year, $title, $dateAndMonth,$url,$type, $description, $session)
    {
        $this->getWebsite()->addAwebsiteReferenceToAdatabase($surname, $initial, $year, $title, $dateAndMonth,$url,$type, $description, $session);
    }

    public function viewWebsiteDetailsAsXml()
    {

        $doc = new DOMDocument("1.0");
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        $references = $doc->createElement("referenceslist");
        $doc->appendChild($references);

        $ref = $doc->createElement("reference");
        $references->appendChild($ref);

        foreach ($this->getAllIds() as $val) {
            $surname = $doc->createElement("surname", $this->getWebsite()->getAllWebsiteDetailsById($val)->getSurname());
            $ref->appendChild($surname);

            $initial = $doc->createElement("initial", $this->getWebsite()->getAllWebsiteDetailsById($val)->getInitials());
            $ref->appendChild($initial);

            $year = $doc->createElement("year", $this->getWebsite()->getAllWebsiteDetailsById($val)->getYear());
            $ref->appendChild($year);

            $title = $doc->createElement("title", $this->getWebsite()->getAllWebsiteDetailsById($val)->getTitle());
            $ref->appendChild($title);

            $type = $doc->createElement("type", $this->getWebsite()->getAllWebsiteDetailsById($val)->getType());
            $ref->appendChild($type);

            $url = $doc->createElement("url", $this->getWebsite()->getAllWebsiteDetailsById($val)->getUrl());
            $ref->appendChild($url);

            $dateAcc = $doc->createElement("date_accessed", $this->getWebsite()->getAllWebsiteDetailsById($val)->getDateLastAccessed());
            $ref->appendChild($dateAcc);


            $ref = $doc->createElement("reference");
            $references->appendChild($ref);
        }
        $xmlContent = $doc->saveXML();
        return $xmlContent;
    }

    public function echoWebsiteAsHarvardReferenceById ($id) {
        echo
            $this->website->getAllWebsiteDetailsById($id)->getSurname() . ", ".
            $this->website->getAllWebsiteDetailsById($id)->getInitials() . "., ".
            $this->website->getAllWebsiteDetailsById($id)->getYear() . ". <i>".
            $this->website->getAllWebsiteDetailsById($id)->getTitle() . "</i>. ".
            $arrayOfElements[] = "[online].".
            $arrayOfElements[] = " Avaiable from: ".
            $this->website->getAllWebsiteDetailsById($id)->getUrl().
            $arrayOfElements[] = " Accessed: ".
            $this->website->getAllWebsiteDetailsById($id)->getDateLastAccessed();

    }
}

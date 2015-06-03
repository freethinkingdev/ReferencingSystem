<?php
/**
 * User: Marcin
 * Date: 20/11/2012
 * Time: 08:39
 * File name: ModelNewspaper.php
 */
include_once "Classes/NewspaperDAO.php";
class ModelNewspaper
{
    private $newspaper;
    private $allIds;
    private $title;

    function __construct()
    {
        $this->newspaper = new NewspaperDAO();
        //$this->title = $this->newspaper->getAllNewspaperDetails()->getTitle();
        $this->allIds = $this->newspaper->getAllTheIdsOfNewspaper();
    }

    function __destruct()
    {
        unset($this->newspaper);
    }

    public function getNewspaper()
    {
        return $this->newspaper;
    }

    public function getAllIds()
    {
        return $this->allIds;
    }

    public function returnArrayOfNewspaperElementsAsTable($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getId();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getSurname();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getInitials();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getYear();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getTitle();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getTitleOfNewspaper();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getDateAndMonth();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getPageNumbers();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getDescription();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getDateAdded();
        $arrayOfElements[] = "<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?itemToDelete=" . $this->newspaper->getAllNewspaperDetailsById($id)->getId() . "'>X</a> |<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?direction=copyElement&amp;source=newspaper&amp;id=" . $this->newspaper->getAllNewspaperDetailsById($id)->getId() . "'>C</a> ";
        return $arrayOfElements;
    }

    public function returnArrayOfNewspaperElementsAsHarvardList($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getSurname() . ", ";
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getInitials() . "., ";
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getYear() . " ";
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getTitle() . ". <i>";
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getTitleOfNewspaper() . "</i>, ";
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getDateAndMonth() . ", p.";
        $arrayOfElements[] = $this->newspaper->getAllNewspaperDetailsById($id)->getPageNumbers() . ". ";

        return $arrayOfElements;
    }


    public function addNewspaperToDatabase($surname, $initial, $year, $title, $titleOfNewspaper, $dateAndMonth, $pageNumber, $description, $session)
    {
        $this->getNewspaper()->addAnewspaperReferenceToAdatabase($surname, $initial, $year, $title, $titleOfNewspaper, $dateAndMonth, $pageNumber, $description, $session);
    }

    public function viewNewspaperDetailsAsXml()
    {

        $doc = new DOMDocument("1.0");
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        $references = $doc->createElement("referenceslist");
        $doc->appendChild($references);

        $ref = $doc->createElement("reference");
        $references->appendChild($ref);

        foreach ($this->getAllIds() as $val) {
            $surname = $doc->createElement("surname", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getSurname());
            $ref->appendChild($surname);

            $initial = $doc->createElement("initial", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getInitials());
            $ref->appendChild($initial);

            $year = $doc->createElement("year", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getYear());
            $ref->appendChild($year);

            $title = $doc->createElement("title", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getTitle());
            $ref->appendChild($title);

            $edition = $doc->createElement("newspaper_title", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getTitleOfNewspaper());
            $ref->appendChild($edition);

            $placeOfPub = $doc->createElement("date", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getDateAndMonth());
            $ref->appendChild($placeOfPub);

            $publisher = $doc->createElement("page_number", $this->getNewspaper()->getAllNewspaperDetailsById($val)->getPageNumbers());
            $ref->appendChild($publisher);

            $ref = $doc->createElement("reference");
            $references->appendChild($ref);
        }
        $xmlContent = $doc->saveXML();
        return $xmlContent;
    }

    public function echoNewspaperAsHarvardReferenceById ($id) {
            echo
            $this->newspaper->getAllNewspaperDetailsById($id)->getSurname() . ", " .
            $this->newspaper->getAllNewspaperDetailsById($id)->getInitials() . "., ".
            $this->newspaper->getAllNewspaperDetailsById($id)->getYear() . " ".
            $this->newspaper->getAllNewspaperDetailsById($id)->getTitle() . ". <i>".
            $this->newspaper->getAllNewspaperDetailsById($id)->getTitleOfNewspaper() . "</i>, ".
            $this->newspaper->getAllNewspaperDetailsById($id)->getDateAndMonth() . ", p.".
            $this->newspaper->getAllNewspaperDetailsById($id)->getPageNumbers() . ". ";

    }
}

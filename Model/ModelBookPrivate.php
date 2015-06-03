<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 14:16
 * File name: ModelBook.php
 */
include_once "Classes/BookDAO.php";

class ModelBook
{
    private $book;
    private $allIds;
    private $title;

    function __construct()
    {
        $this->book = new BookDAO();
        $this->title = $this->book->getAllBookDetails()->getTitle();
        $this->allIds = $this->book->getAllTheIdsOfBooks();
    }

    function __destruct()
    {
        unset($this->book);
    }

    public function getBook()
    {
        return $this->book;
    }

    public function getAllIds()
    {
        return $this->allIds;
    }

    public function returnArrayOfBookElementsAsTable($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getId();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getSurname();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getInitials();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getYear();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getTitle();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getEdition();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getPlaceOfPublication();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getPublisher();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getDescription();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getDateAdded();
        $arrayOfElements[] = "<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?itemToDelete=" . $this->book->getAllBookDetailsById($id)->getId() . "'>X</a> |<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?direction=copyElement&amp;source=book&amp;id=" . $this->book->getAllBookDetailsById($id)->getId() . "'>C</a> ";
        return $arrayOfElements;
    }

    public function returnArrayOfBookElementsAsHarvardList($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getSurname() . ", ";
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getInitials() . "., ";
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getYear() . "<i>. ";
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getTitle() . "</i>. ";
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getEdition() . " edition. ";
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getPlaceOfPublication() . ": ";
        $arrayOfElements[] = $this->book->getAllBookDetailsById($id)->getPublisher() . ".";

        return $arrayOfElements;
    }

    public function addBookToDatabase($surname, $initial, $year, $title, $edition, $placeOfPublication, $publisher, $description, $session)
    {
        $this->getBook()->addAbookReferenceToAdatabase($surname, $initial, $year, $title, $edition, $placeOfPublication, $publisher, $description, $session);
    }

    public function viewBookDetailsAsXml () {

        $doc = new DOMDocument("1.0");
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        $references = $doc->createElement("referenceslist");
        $doc->appendChild($references);

        $ref = $doc->createElement("reference");
        $references->appendChild($ref);

        foreach ($this->getAllIds() as $val) {

            $surname = $doc->createElement("surname", $this->getBook()->getAllBookDetailsById($val)->getSurname());
            $ref->appendChild($surname);

             $initial = $doc->createElement("initial", $this->getBook()->getAllBookDetailsById($val)->getInitials());
             $ref->appendChild($initial);

             $year = $doc->createElement("year", $this->getBook()->getAllBookDetailsById($val)->getYear());
             $ref->appendChild($year);

             $title = $doc->createElement("title", $this->getBook()->getAllBookDetailsById($val)->getTitle());
             $ref->appendChild($title);

             $edition = $doc->createElement("edition", $this->getBook()->getAllBookDetailsById($val)->getEdition());
             $ref->appendChild($edition);

             $placeOfPub = $doc->createElement("publication_place", $this->getBook()->getAllBookDetailsById($val)->getPlaceOfPublication());
             $ref->appendChild($placeOfPub);

             $publisher = $doc->createElement("publisher", $this->getBook()->getAllBookDetailsById($val)->getPublisher());
             $ref->appendChild($publisher);

             $ref = $doc->createElement("reference");
             $references->appendChild($ref);

        }
        $xmlContent = $doc->saveXML();
        return $xmlContent;
     }

    public function echoBookAsHarvardReferenceById ($id) {
        echo
            $this->book->getAllBookDetailsById($id)->getSurname() . ", " .
            $this->book->getAllBookDetailsById($id)->getInitials() . "., " .
            $this->book->getAllBookDetailsById($id)->getYear() . " <i>" .
            $this->book->getAllBookDetailsById($id)->getTitle() . "</i>. " .
            $this->book->getAllBookDetailsById($id)->getEdition() . ". " .
            $this->book->getAllBookDetailsById($id)->getPlaceOfPublication() . ": " .
            $this->book->getAllBookDetailsById($id)->getPublisher()."."
        ;

     }


}

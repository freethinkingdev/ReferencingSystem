<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 21:24
 * File name: ModelJournal.php
 */
include_once "Classes/JournalDAO.php";

class ModelJournal
{
    private $journal;
    private $allIds;
    private $title;

    function __construct()
    {
        $this->journal = new JournalDAO();
        //$this->title = $this->journal->getAllJournalDetails()->getTitle();
        $this->allIds = $this->journal->getAllTheIdsOfJournals();
    }

    function __destruct()
    {
        unset($this->journal);
    }

    public function getJournal()
    {
        return $this->journal;
    }

    public function getAllIds()
    {
        return $this->allIds;
    }

    public function returnArrayOfJournalElementsAsTable($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getId();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getSurname();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getInitials();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getYear();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getTitle();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getTitleofJournal();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getVolumeNumber();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getPartNumber();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getPageNumber();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getDescription();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getDateAdded();
        $arrayOfElements[] = "<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?itemToDelete=" . $this->journal->getAllJournalsDetailsById($id)->getId() . "'>X</a> |<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?direction=copyElement&amp;source=journal&amp;id=" . $this->journal->getAllJournalsDetailsById($id)->getId() . "'>C</a> ";
        return $arrayOfElements;
    }

    public function returnArrayOfJournalElementsAsHarvardList($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getSurname() . ", ";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getInitials() . "., ";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getYear() . ". ";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getTitle() . ". <i>";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getTitleofJournal() . "</i>, ";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getVolumeNumber() . "(";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getPartNumber() . "), pp. ";
        $arrayOfElements[] = $this->journal->getAllJournalsDetailsById($id)->getPageNumber() . ".";

        return $arrayOfElements;
    }


    public function addJournalToDatabase($surname, $initial, $year, $title, $titleOfJournal, $journalVolume, $journalPart, $pageNumbers,$description, $session)
    {
        $this->getJournal()->addJournalReferenceToAdatabase($surname, $initial, $year, $title, $titleOfJournal, $journalVolume, $journalPart, $pageNumbers,$description, $session);
    }


    public function viewJournalDetailsAsXml()
    {

        $doc = new DOMDocument("1.0");
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        $references = $doc->createElement("referenceslist");
        $doc->appendChild($references);

        $ref = $doc->createElement("reference");
        $references->appendChild($ref);

        foreach ($this->getAllIds() as $val) {

            $surname = $doc->createElement("surname", $this->getJournal()->getAllJournalsDetailsById($val)->getSurname());
            $ref->appendChild($surname);

            $initial = $doc->createElement("initial", $this->getJournal()->getAllJournalsDetailsById($val)->getInitials());
            $ref->appendChild($initial);

            $year = $doc->createElement("year", $this->getJournal()->getAllJournalsDetailsById($val)->getYear());
            $ref->appendChild($year);

            $title = $doc->createElement("title", $this->getJournal()->getAllJournalsDetailsById($val)->getTitle());
            $ref->appendChild($title);

            $edition = $doc->createElement("journal_title", $this->getJournal()->getAllJournalsDetailsById($val)->getTitleofJournal());
            $ref->appendChild($edition);

            $placeOfPub = $doc->createElement("volume_number", $this->getJournal()->getAllJournalsDetailsById($val)->getVolumeNumber());
            $ref->appendChild($placeOfPub);

            $publisher = $doc->createElement("part_number", $this->getJournal()->getAllJournalsDetailsById($val)->getPartNumber());
            $ref->appendChild($publisher);

            $publisher = $doc->createElement("page_number", $this->getJournal()->getAllJournalsDetailsById($val)->getPageNumber());
            $ref->appendChild($publisher);

            $ref = $doc->createElement("reference");
            $references->appendChild($ref);
        }
        $xmlContent = $doc->saveXML();
        return $xmlContent;
    }

    public function echoJournalAsHarvardReferenceById ($id) {
        echo
            $this->journal->getAllJournalsDetailsById($id)->getSurname() . ", ".
            $this->journal->getAllJournalsDetailsById($id)->getInitials() . "., ".
            $this->journal->getAllJournalsDetailsById($id)->getYear() . " ".
            $this->journal->getAllJournalsDetailsById($id)->getTitle() . ". <i>".
            $this->journal->getAllJournalsDetailsById($id)->getTitleofJournal() . "</i>, ".
            $this->journal->getAllJournalsDetailsById($id)->getVolumeNumber() . "(".
            $this->journal->getAllJournalsDetailsById($id)->getPartNumber() . "), pp. ".
            $this->journal->getAllJournalsDetailsById($id)->getPageNumber() . ".";

    }


}

<?php
/**
 * User: Marcin
 * Date: 02/12/2012
 * Time: 16:55
 * File name: ModelVideo.php
 */

include_once "Classes/VideoDAO.php";

class ModelVideo
{
    private $video;
    private $allIds;

    function __construct()
    {
        $this->video = new VideoDAO();
        $this->allIds = $this->video->getAllTheIdsOfVideos();
    }

    function __destruct()
    {

    }

    public function getVideo()
    {
        return $this->video;
    }

    public function getAllIds()
    {
        return $this->allIds;
    }

    // This method is mainly utilized in browse all references page, where each source is calling it.
    public function returnArrayOfVideoElementsAsTable($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getId();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getSurname();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getYear();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getTitle();
        $arrayOfElements[] = "video";
        $arrayOfElements[] = "<a href='" . $this->video->getAllVideoDetailsById($id)->getUrl() . "' target='_blank'>" . $this->video->getAllVideoDetailsById($id)->getUrl() . "</a>";
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getDescription();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getDateLastAccessed();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getDateAdded();
        $arrayOfElements[] = "<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?itemToDelete=" . $this->video->getAllVideoDetailsById($id)->getId() . "'>X</a> |<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?direction=copyElement&amp;source=video&amp;id=" . $this->video->getAllVideoDetailsById($id)->getId() . "'>C</a> ";
        return $arrayOfElements;
    }


    public function returnArrayOfVideoElementsAsHarvardList($id)
    {
        $arrayOfElements = array();
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getSurname() . ", ";
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getYear() . ". <i>";
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getTitle() . "</i>. ";
        $arrayOfElements[] = " Avaiable at: ";
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getUrl();
        $arrayOfElements[] = " Accessed: ";
        $arrayOfElements[] = $this->video->getAllVideoDetailsById($id)->getDateLastAccessed();

        return $arrayOfElements;
    }

    public function addVideoToDatabase($surname, $year, $title, $url, $dateAccessed, $description, $session)
    {
        $this->getVideo()->addAvideoReferenceToAdatabase($surname, $year, $title, $url, $dateAccessed, $description, $session);
    }

    public function viewVideoDetailsAsXml()
    {

        $doc = new DOMDocument("1.0");
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        $references = $doc->createElement("referenceslist");
        $doc->appendChild($references);

        $ref = $doc->createElement("reference");
        $references->appendChild($ref);

        foreach ($this->getAllIds() as $val) {
            $surname = $doc->createElement("surname", $this->getVideo()->getAllVideoDetailsById($val)->getSurname());
            $ref->appendChild($surname);

            $initial = $doc->createElement("initial", $this->getVideo()->getAllVideoDetailsById($val)->getInitials());
            $ref->appendChild($initial);

            $year = $doc->createElement("year", $this->getVideo()->getAllVideoDetailsById($val)->getYear());
            $ref->appendChild($year);

            $title = $doc->createElement("title", $this->getVideo()->getAllVideoDetailsById($val)->getTitle());
            $ref->appendChild($title);

            $type = $doc->createElement("type", $this->getVideo()->getAllVideoDetailsById($val)->getType());
            $ref->appendChild($type);

            $url = $doc->createElement("url", $this->getVideo()->getAllVideoDetailsById($val)->getUrl());
            $ref->appendChild($url);

            $dateAcc = $doc->createElement("date_accessed", $this->getVideo()->getAllVideoDetailsById($val)->getDateLastAccessed());
            $ref->appendChild($dateAcc);


            $ref = $doc->createElement("reference");
            $references->appendChild($ref);
        }
        $xmlContent = $doc->saveXML();
        return $xmlContent;
    }

    public function echoVideoAsHarvardReferenceById($id)
    {
        echo
            $this->video->getAllVideoDetailsById($id)->getSurname() . ", " .
            $this->video->getAllVideoDetailsById($id)->getYear() . ". <i>" .
            $this->video->getAllVideoDetailsById($id)->getTitle() . "</i>. " .
            $arrayOfElements[] = " Available at: " .
            $this->video->getAllVideoDetailsById($id)->getUrl() .
            $arrayOfElements[] = " Accessed: " .
            $this->video->getAllVideoDetailsById($id)->getDateLastAccessed();

    }
}

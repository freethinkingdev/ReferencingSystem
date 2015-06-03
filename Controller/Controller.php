<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:49
 * File name: Controller.php
 */

include_once "Model/ModelMainStarting.php";
include_once "Model/ModelBook.php";
include_once "Model/ModelJournal.php";
include_once "Model/ModelNewspaper.php";
include_once "Model/ModelWebsite.php";
include_once "Model/ModelVideo.php";

class Controller
{
    private $model;
    private $bookModel;
    private $journalModel;
    private $newspaperModel;
    private $website;
    private $video;

    function __construct()
    {
        $this->model = new ModelMainStarting();
        $this->bookModel = new ModelBook();
        $this->journalModel = new ModelJournal();
        $this->newspaperModel = new ModelNewspaper();
        $this->website = new ModelWebsite();
        $this->video = new ModelVideo();
    }

    function __destruct()
    {

    }

    public function defaultView()
    {
        include_once "./View/Home/index.php";
    }

    public function loginPage()
    {
        include_once "./View/Login/index.php";
    }

    /*Function which checks, whether user does exists and the provided password matches provided username. If it does, appropriate view is loaded, otherwise
    vies with try again is loaded. It is important to remember that the pass has to be treated with md5 function, which encode it */
    public function logMeIn()
    {
        if (isset($_POST['user_login']) and !empty($_POST['user_login']) and isset($_POST['user_password']) and !empty($_POST['user_password'])) {
            $login = $_POST['user_login'];
            $pass = md5($_POST['user_password']);
//   $this->model->returnUserLogin($login,$pass);

            if ($this->model->returnUserLogin($login, $pass)) {
                session_start();
                $_SESSION['id'] = $this->model->getId();
                include_once "View/LoginSuccess/index.php";
            } else {
                include_once "View/LoginError/index.php";
            }

        } else {
            include_once "View/LoginError/index.php";
        }
    }

    /*Functions below show appropriate views in response to user interaction*/

    public function helpMe()
    {
        include_once "./View/Help/index.php";
    }

    public function logout()
    {
        include_once "./View/Shared/logout.php";
    }

    public function addRef()
    {
        include_once "View/AddReference/index.php";
    }

    public function browseReferences()
    {
        include_once "View/BrowseAllReferences/index.php";
    }

    public function itemToDelete($idOfItemToDelete)
    {
        $this->bookModel->getBook()->deleteTheItemWithThatId($idOfItemToDelete);
        include_once "View/BrowseAllReferences/index.php";

    }


    public function searchInDB($searchIn, $lookFor)
    {
//        echo "search in db CONTROLLER<br/>";

        $this->journalModel->getJournal()->searchTheJournalTableFor($searchIn, $lookFor);
        $this->bookModel->getBook()->searchTheBookTableFor($searchIn, $lookFor);
        $this->newspaperModel->getNewspaper()->searchTheNewspaperTableFor($searchIn, $lookFor);
        include_once "View/BrowseAllReferences/index.php";

    }

    public function addSourceRef()
    {
        switch ($_GET['type']) {
            case "book":
                $_GET['type'] = "book";
                include_once "View/AddReference/AddReferenceConfirmation/index.php";
                break;
            case "newspaper":
                $_GET['type'] = "newspaper";
                include_once "View/AddReference/AddReferenceConfirmation/index.php";
                break;
            case "journal":
                $_GET['type'] = "journal";
                include_once "View/AddReference/AddReferenceConfirmation/index.php";
                break;
            case "website":
                $_GET['type'] = "website";
                include_once "View/AddReference/AddReferenceConfirmation/index.php";
                break;
            case "video":
                $_GET['type'] = "video";
                include_once "View/AddReference/AddReferenceConfirmation/index.php";
                break;

            default:
                // Default action
                break;
        }
    }

    public function addBookRefSql()
    {
        /*Switch statement checks what kind of source is being added to the database*/
        switch ($_GET['type']) {
            case "book":
                $this->bookModel->addBookToDatabase($_GET['surname_of_author'], $_GET['initial_of_author'], $_GET['year_of_publication'], $_GET['title'], $_GET['edition'], $_GET['place_of_publication'], $_GET['publisher'], $_GET['txtarea'], $_GET['sessionId']);
                include_once "View/BrowseAllReferences/index.php";
                break;
            case "newspaper":
                $this->newspaperModel->addNewspaperToDatabase($_GET['surname_of_author'], $_GET['initial_of_author'], $_GET['year_of_publication'], $_GET['title'], $_GET['title_of_newspaper'], $_GET['date_and_month'], $_GET['page_numbers'], $_GET['txtarea'], $_GET['sessionId']);
                include_once "View/BrowseAllReferences/index.php";
                break;
            case "website":
                $this->website->addWebsiteToDatabase($_GET['surname_of_author'], $_GET['initial_of_author'], $_GET['year_of_publication'], $_GET['title'], $_GET['date_accessed'], $_GET['url'], "online", $_GET['txtarea'], $_GET['sessionId']);
                include_once "View/BrowseAllReferences/index.php";
                break;
            case "journal":
                $this->journalModel->addJournalToDatabase($_GET['surname_of_author'], $_GET['initial_of_author'], $_GET['year_of_publication'], $_GET['title'], $_GET['title_of_journal'], $_GET['volume_number'], $_GET['volume_part_number'], $_GET['page_numbers'], $_GET['txtarea'], $_GET['sessionId']);
                include_once "View/BrowseAllReferences/index.php";
                break;
            case "video":
                $this->video->addVideoToDatabase($_GET['surname_of_author'], $_GET['year_of_publication'], $_GET['title'], $_GET['url'], $_GET['date_accessed'], $_GET['txtarea'], $_GET['sessionId']);
                include_once "View/BrowseAllReferences/index.php";
                break;

            default:
                // Default action
                break;
        }

    }

    public function copyElement()
    {
        include_once "View/CopyElement/index.php";
    }

    public function viewElementsAsHarvardList()
    {
        include_once "View/BrowseAllReferences/ElementsAsHarvardList/index.php";
    }

    public function viewElementAsXML()
    {
        include_once "View/BrowseAllReferences/ElementAsXML/index.php";
    }

    public function saveElementAsXML()
    {
        include_once "View/BrowseAllReferences/SaveElementAsXML/index.php";
    }

    public function saveListAsPlainText () {
        include_once "View/BrowseAllReferences/SaveListAsHarverd/index.php";
     }

    public function browsePrivateList()
    {
        include_once "View/BrowseOwnReferenceList/index.php";
    }

    public function createPrivateList () {
        $_GET['ownlist'] = "yes";
        include_once "View/BrowseOwnReferenceList/index.php";
     }
}

<?php
/**
 * User: Marcin
 * Date: 12/11/2012
 * Time: 20:04
 * File name: BookDAO.php
 */
include_once "Classes/BookDBTable.php";
include_once "Classes/Connect.php";

class BookDAO extends Connect
{

    private $lastId;

    function __construct()
    {
        parent::__construct();

    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getAllBookDetails()
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_book` on `referenced_material`.`id`=`referenced_material_book`.`id`";
        $res = $this->connection->query($sql);
        if ($res) {
//        echo "Rows of data: " . $res->num_rows . "<br/>";
            $bookData = $res->fetch_object("BookDBTable");

        } else {
            $bookData = new BookDBTable();
        }
        return $bookData;
    }

    public function getAllBookDetailsById($id)
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_book` on `referenced_material`.`id`=`referenced_material_book`.`id`
        where `referenced_material`.`id` = '" . $id . "' ";
        $res = $this->connection->query($sql);
        if ($res) {
            $bookData = $res->fetch_object("BookDBTable");
        } else {
            $bookData = new BookDBTable();
        }

        return $bookData;
    }

    public function getAllTheIdsOfBooks()
    {
        $idsArray = array();
        $sql = "select `referenced_material`.`id`from `referenced_material` inner join `referenced_material_book` on `referenced_material`.`id`=`referenced_material_book`.`id` where `referenced_material_book`.`type` = 'book'";
        $res = $this->connection->query($sql);
        while ($row = $res->fetch_row()) {
            $idsArray[] = $row[0];
        }
        return $idsArray;

    }

    public function deleteTheItemWithThatId($id)
    {
        $sql = "DELETE from `referenced_material` where `referenced_material`.`id` = '" . $id . "' ";
        $res = $this->connection->query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /*This function is responsible for looking elements in the book table only. At the end it returns and array of book data as DTO
    and the ids of found rows*/
    public function searchTheBookTableFor($where, $statementToLook)
    {
        $idsArray = array();
        $sql = "select * from `referenced_material` inner join `referenced_material_book` on `referenced_material`.`id` = `referenced_material_book`.`id` where `referenced_material`.`" . $where . "` like '%" . $statementToLook . "%'";
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_row()) {
                $idsArray[] = $row[0];
            }
            /*echo "found some ";
            echo $numOfRows = $res->num_rows;*/
            $bookData = $res->fetch_object("BookDBTable");
        } else {
//            echo "Sorry, no results. Try to type another set of characters.";
//            echo '<script type="text/javascript">alert("No results found.");</script>';
            $bookData = new BookDBTable();
        }
        return array($bookData, $idsArray);
    }

// This function return the last number of id used in referenced_material table.
    private   function returnLastNumberOfRow()
    {
        $getTheLastIdFromTheReferencedMaterial = "select `id` from `referenced_material` where `ID` = (SELECT MAX(`ID`)  FROM `referenced_material`)";
        $res = $this->connection->query($getTheLastIdFromTheReferencedMaterial);
        $rowNum = $res->num_rows;
        $j = 0;
        while ($j < $rowNum) {
            $res->data_seek($j);
            $row = $res->fetch_row();
            $j++;
        }
        $lastID = $row[0] + 1;
        return $lastID;
    }

// Public function which adds the book element to the database. In arguments gets all the data to be inserted
    public function addAbookReferenceToAdatabase($authorSurname, $authorInitial, $year, $title, $edition, $placeOfPub, $publisher, $description, $session)
    {
//        echo "Surname " . $authorSurname . "<br/>";
//        echo "Initial " . $authorInitial. "<br/>";
//        echo "Year " . $year. "<br/>";
//        echo "Tytul " . $title. "<br/>";
//        echo "Edition " . $edition. "<br/>";
//        echo "Place of publication " . $placeOfPub. "<br/>";
//        echo "Publisher " . $publisher. "<br/>";
//        echo "Description " . $description. "<br/>";
//        echo "Sesja " . $session. "<br/>";
//        echo "Last id " . $this->returnLastNumberOfRow();
        $sql1 = "INSERT INTO `referenced_material` VALUES (null,'" . $authorSurname . "','" . $authorInitial . "', '" . $year . "', '" . $title . "','" . $description . "', CURDATE(), '" . $session . "', 'public' )";
        $sql2 = "INSERT INTO `referenced_material_book` VALUES (" . $this->returnLastNumberOfRow() . ",'book'," . $edition . ",'" . $placeOfPub . "','" . $publisher . "')";
        $this->connection->query($sql1);
        $this->connection->query($sql2);
    }
}

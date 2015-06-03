<?php
/**
 * User: Marcin
 * Date: 18/11/2012
 * Time: 21:19
 * File name: JournalDAO.php
 */

include_once "Classes/JournalDBTable.php";
include_once "Classes/Connect.php";

class JournalDAO extends Connect
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

    public function getAllJournalDetails()
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_journals` on `referenced_material`.`id`=`referenced_material_journals`.`id`";
        $res = $this->connection->query($sql);
        if ($res) {
//        echo "Rows of data: " . $res->num_rows . "<br/>";
            $journalData = $res->fetch_object("JournalDBTable");

        } else {
            $journalData = new JournalDBTable();
        }
        return $journalData;
    }

    public function getAllJournalsDetailsById($id)
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_journals` on `referenced_material`.`id`=`referenced_material_journals`.`id`
        where `referenced_material`.`id` = '" . $id . "' ";
        $res = $this->connection->query($sql);
        if ($res) {
            $journalData = $res->fetch_object("JournalDBTable");
        } else {
            $journalData = new JournalDBTable();
        }

        return $journalData;
    }

    public function getAllTheIdsOfJournals()
    {
        $idsArray = array();
        $sql = "select `referenced_material`.`id`from `referenced_material` inner join `referenced_material_journals` on `referenced_material`.`id`=`referenced_material_journals`.`id` where `referenced_material_journals`.`type` = 'journal'";
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
    public function searchTheJournalTableFor($where, $statementToLook)
    {
        $idsArray = array();
        $sql = "select * from `referenced_material` inner join `referenced_material_journals` on `referenced_material`.`id` = `referenced_material_journals`.`id` where `referenced_material`.`" . $where . "` like '%" . $statementToLook . "%'";
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_row()) {
                $idsArray[] = $row[0];
            }
            /*echo "found some ";
            echo $numOfRows = $res->num_rows;*/
            $webData = $res->fetch_object("JournalDBTable");
        } else {
//            echo "Sorry, no results. Try to type another set of characters.";
//            echo '<script type="text/javascript">alert("No results found.");</script>';
            $webData = new JournalDBTable();
        }
        return array($webData, $idsArray);
    }

// This function return the last number of id used in referenced_material table.
    private function returnLastNumberOfRow()
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
    public function addJournalReferenceToAdatabase($surname, $initial, $year, $title, $titleOfJournal, $journalVolume, $journalPart, $pageNumbers,$description, $session)
    {
        $sql1 = "INSERT INTO `referenced_material` VALUES (null,'" . $surname . "','" . $initial . "', '" . $year . "', '" . $title . "','" . $description . "', CURDATE(), '" . $session . "', 'public' )";
        $sql2 = "INSERT INTO `referenced_material_journals` VALUES (" . $this->returnLastNumberOfRow() . ",'journal','" . $titleOfJournal . "','" . $journalVolume . "','" . $journalPart . "','" . $pageNumbers . "')";
//        echo $sql1 . "<br/>";
//        echo $sql2 . "<br/>";

        $this->connection->query($sql1);
        $this->connection->query($sql2);
    }
}

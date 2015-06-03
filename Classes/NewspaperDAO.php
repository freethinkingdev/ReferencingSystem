<?php
/**
 * User: Marcin
 * Date: 20/11/2012
 * Time: 07:50
 * File name: NewspaperDAO.php
 */
include_once "Classes/NewspaperDBTable.php";
include_once "Classes/Connect.php";
class NewspaperDAO extends Connect
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getAllNewspaperDetails()
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_newspaper` on `referenced_material`.`id`=`referenced_material_newspaper`.`id`";
        $res = $this->connection->query($sql);
        if ($res) {
//        echo "Rows of data: " . $res->num_rows . "<br/>";
            $newspaperData = $res->fetch_object("NewspaperDBTable");

        } else {
            $newspaperData = new NewspaperDBTable();
        }
        return $newspaperData;
    }

    public function getAllNewspaperDetailsById($id)
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_newspaper` on `referenced_material`.`id`=`referenced_material_newspaper`.`id`
        where `referenced_material`.`id` = '" . $id . "' ";
        $res = $this->connection->query($sql);
        if ($res) {
            $newspaperData = $res->fetch_object("NewspaperDBTable");
        } else {
            $newspaperData = new NewspaperDBTable();
        }


        return $newspaperData;
    }

    public function getAllTheIdsOfNewspaper()
    {
        $idsArray = array();
        $sql = "select `referenced_material`.`id`from `referenced_material` inner join `referenced_material_newspaper` on `referenced_material`.`id`=`referenced_material_newspaper`.`id` where `referenced_material_newspaper`.`type` = 'newspaper'";
        $res = $this->connection->query($sql);
        while ($row = $res->fetch_row()) {
            $idsArray[] = $row[0];
        }
        return $idsArray;

    }

    /*Delete the row with that id*/
    public function deleteTheItemWithThatId($id)
    {
        parent::deleteTheItemWithThatId($id);
    }

    /*Function used in searching elements in the table*/
    public function searchTheNewspaperTableFor($where, $statementToLook)
    {
        $idsArray = array();
        $sql = "select * from `referenced_material` inner join `referenced_material_newspaper` on `referenced_material`.`id` = `referenced_material_newspaper`.`id` where `referenced_material`.`" . $where . "` like '%" . $statementToLook . "%'";
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_row()) {
                $idsArray[] = $row[0];
            }
            /*echo "found some ";
            echo $numOfRows = $res->num_rows;*/
            $journalData = $res->fetch_object("NewspaperDBTable");
        } else {
//            echo "Sorry, no results. Try to type another set of characters.";
//            echo '<script type="text/javascript">alert("No results found.");</script>';
            $journalData = new NewspaperDBTable();
        }
        return array($journalData, $idsArray);
    }

    /*In order to add some info in second array, sql has to know what is the last available id so it could add 1 to that value so the new data could be then inserted */
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

    /*Public function which adds the book element to the database. In arguments gets all the data to be inserted*/
    public function addAnewspaperReferenceToAdatabase($surname, $initial, $year, $title, $titleOfNewspaper, $dateAndMonth, $pageNumber, $description, $session)
    {
//        echo "Surname " . $surname . "<br/>";
//        echo "Initial " . $initial. "<br/>";
//        echo "Year " . $year. "<br/>";
//        echo "Title " . $title. "<br/>";
//        echo "Newspaper title " . $titleOfNewspaper. "<br/>";
//        echo "Date and month " . $dateAndMonth. "<br/>";
//        echo "Page number " . $pageNumber. "<br/>";
//        echo "Description " . $description. "<br/>";
//        echo "Sesja " . $session. "<br/>";
//        echo "Last id " . $this->returnLastNumberOfRow();
        $sql1 = "INSERT INTO `referenced_material` VALUES (null,'" . $surname . "','" . $initial . "', '" . $year . "', '" . $title . "','" . $description . "', CURDATE(), '" . $session . "', 'public' )";
        $sql2 = "INSERT INTO `referenced_material_newspaper` VALUES ({$this->returnLastNumberOfRow()},'newspaper','{$titleOfNewspaper}','{$dateAndMonth}',$pageNumber)";
//        echo $sql1 ."<br/>";
//        echo $sql2;
        $this->connection->query($sql1);
        $this->connection->query($sql2);
    }

}

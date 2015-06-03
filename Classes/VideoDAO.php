<?php
/**
 * User: Marcin
 * Date: 02/12/2012
 * Time: 16:47
 * File name: VideoDAO.php
 */

include_once "Classes/Connect.php";
include_once "Classes/VideoDBTable.php";

class VideoDAO extends Connect
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }


    public function getAllVideoDetails()
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_video` on `referenced_material`.`id`=`referenced_material_video`.`id`";
        $res = $this->connection->query($sql);
        if ($res) {
//        echo "Rows of data: " . $res->num_rows . "<br/>";
            $videoData = $res->fetch_object("VideoDBTable");

        } else {
            $videoData = new VideoDBTable();
        }
        return $videoData;
    }

    public function getAllVideoDetailsById($id)
    {
        $sql = "select * from `referenced_material` inner join `referenced_material_video` on `referenced_material`.`id`=`referenced_material_video`.`id`
        where `referenced_material`.`id` = '" . $id . "' ";
        $res = $this->connection->query($sql);
        if ($res) {
            $videoData = $res->fetch_object("VideoDBTable");
        } else {
            $videoData = new VideoDBTable();
        }

        return $videoData;
    }

    public function getAllTheIdsOfVideos()
    {
        $idsArray = array();
        $sql = "select `referenced_material`.`id`from `referenced_material` inner join `referenced_material_video` on `referenced_material`.`id`=`referenced_material_video`.`id` where `referenced_material_video`.`type` = 'video'";
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
    public function searchTheVideoTableFor($where, $statementToLook)
    {
        $idsArray = array();
        $sql = "select * from `referenced_material` inner join `referenced_material_video` on `referenced_material`.`id` = `referenced_material_video`.`id` where `referenced_material`.`" . $where . "` like '%" . $statementToLook . "%'";
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_row()) {
                $idsArray[] = $row[0];
            }
            /*echo "found some ";
            echo $numOfRows = $res->num_rows;*/
            $videoData = $res->fetch_object("VideoDBTable");
        } else {
//            echo "Sorry, no results. Try to type another set of characters.";
//            echo '<script type="text/javascript">alert("No results found.");</script>';
            $videoData = new BookDBTable();
        }
        return array($videoData, $idsArray);
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
    public function addAVideoReferenceToAdatabase($authorSurname, $year, $title, $url, $dateAccessed, $description, $session)
    {

        $sql1 = "INSERT INTO `referenced_material` VALUES (null,'" . $authorSurname . "','','" . $year . "', '" . $title . "','" . $description . "', CURDATE(), '" . $session . "', 'public' )";
        $sql2 = "INSERT INTO `referenced_material_video` VALUES (" . $this->returnLastNumberOfRow() . ",'video'," . "'$url'" . ",'" . $dateAccessed . "')";

        //echo $sql1 . "<br/>";
        //echo $sql2;
        $this->connection->query($sql1);
        $this->connection->query($sql2);
    }


}

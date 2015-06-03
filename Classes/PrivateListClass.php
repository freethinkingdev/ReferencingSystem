<?php
/**
 * User: Marcin
 * Date: 02/12/2012
 * Time: 21:42
 * File name: PrivateListClass.phphp
 */
include_once "Classes/Connect.php";

class PrivateListClass extends Connect
{


    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }


    // Method check whether such DB exists and returns values of true or false.
    public function checkIfDBExists($dbName)
    {
        $query = "SHOW DATABASES LIKE '" . $dbName . "'";
        $res = $this->connection->query($query);

        if ($res->num_rows === 1) {
            return true;
        } else {
            return false;

        }
    }
    //This method creates database and then creates tables inside DB which mirror tables in main db
    public function createPrivateDatabase($dbName)
    {
        $sql = "CREATE DATABASE " . $dbName;
        $this->connection->query($sql);
        $useDBsql = "use " . $dbName;
        $this->connection->query($useDBsql);
        $createTable1 = "
                  CREATE TABLE `referenced_material` (
              `id` smallint(3) NOT NULL AUTO_INCREMENT,
              `surname` varchar(15) NOT NULL DEFAULT '',
              `initials` char(1) DEFAULT '',
              `year` int(4) NOT NULL,
              `title` varchar(200) NOT NULL DEFAULT '',
              `description` varchar(300) NOT NULL DEFAULT 'description',
              `date_added` date NOT NULL,
              `who_added` int(10) unsigned NOT NULL,
              `user_access` varchar(7) NOT NULL DEFAULT 'public',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable1);


        $createTable2 = "
                  CREATE TABLE `referenced_material_book` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(7) NOT NULL,
  `edition` smallint(2) NOT NULL,
  `placeOfPublication` varchar(15) NOT NULL DEFAULT '',
  `publisher` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `referenced_material_book_ibfk_1` FOREIGN KEY (`id`) REFERENCES `referenced_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable2);

        $createTable3 = "
                CREATE TABLE `referenced_material_journals` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(9) NOT NULL DEFAULT '',
  `title_of_journal` varchar(20) NOT NULL DEFAULT '',
  `volume_number` varchar(8) NOT NULL DEFAULT '',
  `part_number` int(5) unsigned NOT NULL,
  `page_number` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `referenced_material_journals_ibfk_1` FOREIGN KEY (`id`) REFERENCES `referenced_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable3);


        $createTable4 = "
               CREATE TABLE `referenced_material_multimedia` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(9) DEFAULT NULL,
  `title_of_newspaper` varchar(10) NOT NULL DEFAULT '',
  `date_and_month` varchar(8) DEFAULT NULL,
  `page_numbers` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `referenced_material_multimedia_ibfk_1` FOREIGN KEY (`id`) REFERENCES `referenced_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable4);


        $createTable5 = "
               CREATE TABLE `referenced_material_newspaper` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(9) DEFAULT NULL,
  `title_of_newspaper` varchar(20) NOT NULL DEFAULT '',
  `date_and_month` date NOT NULL,
  `page_numbers` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `referenced_material_newspaper_ibfk_1` FOREIGN KEY (`id`) REFERENCES `referenced_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable5);


        $createTable6 = "
           CREATE TABLE `referenced_material_video` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(11) DEFAULT NULL,
  `url` varchar(50) NOT NULL DEFAULT '',
  `date_last_accessed` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `referenced_material_video_ibfk_1` FOREIGN KEY (`id`) REFERENCES `referenced_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable6);

        $createTable7 = "
          CREATE TABLE `referenced_material_web` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(9) DEFAULT NULL,
  `url` varchar(50) NOT NULL DEFAULT '',
  `date_last_accessed` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `referenced_material_web_ibfk_1` FOREIGN KEY (`id`) REFERENCES `referenced_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;
      ";

        $this->connection->query($createTable7);


    }

    private   function returnLastNumberOfRow()
    {
        $useDB = "use " . $dbName;
        $getTheLastIdFromTheReferencedMaterial = "select `id` from `referenced_material` where `ID` = (SELECT MAX(`ID`)  FROM `referenced_material`)";
        $this->connection->query($useDB);
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

    public function copyBookReference ($dbName,$authorSurname,$authorInitial,$year,$title,$description,$session,$edition,$placeOfPub,$publisher) {
        $useDB = "use " . $dbName;
        $sql1 = "INSERT INTO `referenced_material` VALUES (null,'" . $authorSurname . "','" . $authorInitial . "', '" . $year . "', '" . $title . "','" . $description . "', CURDATE(), '" . $session . "', 'public' )";
        $sql2 = "INSERT INTO `referenced_material_book` VALUES (" . $this->returnLastNumberOfRow() . ",'book'," . $edition . ",'" . $placeOfPub . "','" . $publisher . "')";
        $this->connection->query($useDB);
        $this->connection->query($sql1);
        $this->connection->query($sql2);
     }



}

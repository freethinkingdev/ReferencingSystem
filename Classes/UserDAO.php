<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 10:22
 * File name: UserDAO.php
 */
include_once "UserDBTable.php";
include_once "Classes/Connect.php";
class UserDAO extends Connect
{


    function __construct()
    {
       parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getUserData($username, $pass)
    {
        $query = "select * from members where `username` = '" . $username . "' and `password` = '" . $pass . "' ";
        $res = $this->connection->query($query);
        if ($res->num_rows === 1) {
            $userData = $res->fetch_object("UserDBTable");
//   echo "USER DOES EXISTS<br/>";
        } else {
            $userData = new UserDBTable();

        }
        return $userData;
    }

    public function getUserDataById($id)
    {

        $query = "select * from members where `members`.`id` = '".$id."' ";
        $res = $this->connection->query($query);
        if ($res) {
            $userData = $res->fetch_object("UserDBTable");
        } else {
            $userData = new UserDBTable();

        }
        return $userData;
    }
}

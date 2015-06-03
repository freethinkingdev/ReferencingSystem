<?php
/**
 * User: Marcin
 * Date: 01/12/2012
 * Time: 21:51
 * File name: ModelUser.php
 */
include_once "Classes/UserDAO.php";


class ModelUser
{
    private $user;

    function __construct()
    {
        $this->user = new UserDAO();

    }

    function __destruct()
    {

    }

    public function showUserFirstName ($id) {
      return $this->user->getUserDataById($id)->getFirstName();
     }
}

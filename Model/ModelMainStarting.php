<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:51
 * File name: ModelMainStarting.phpStartin.php
 */
include_once "Classes/UserDAO.php";

class ModelMainStarting
{

 private $user;
 private $id;

 function __construct()
 {
 $this->user = new UserDAO();
 }

 function __destruct()
 {

 }


 public function returnUserLogin ($username,$pass) {

  if ($username == $this->user->getUserData($username,$pass)->getUsername() and $pass == $this->user->getUserData($username,$pass)->getPassword()) {
   $this->id = $this->user->getUserData($username,$pass)->getId();
  return true;
  } else {
  return false;
  }
  }

 public function getId()
 {
  return $this->id;
 }
}

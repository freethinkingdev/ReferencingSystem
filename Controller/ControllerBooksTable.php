<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 14:01
 * File name: ControllerBooksTable.php
 */
include_once "Model/ModelBook.php";

class ControllerBooksTable
{
 private $model;

 function __construct()
 {
  $this->model = new ModelBook();
 }

 function __destruct()
 {
  unset($this->model);
 }

 public function getBookTitle () {
   $this->model->returnBookTitle();
  }

}

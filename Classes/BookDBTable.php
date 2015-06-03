<?php
/**
 * User: Marcin
 * Date: 11/11/2012
 * Time: 18:56
 * File name: BookDBTable.php
 */

//This class is responsible for representation database table. Each variable in the class is the column name
//in database table
class BookDBTable
{
 private $id;
 private $surname;
 private $initials;
 private $year;
 private $title;
 private $description;
 private $date_added;
 private $who_added;
 private $user_access;
 private $foreignKey;
 private $type;
 private $edition;
 private $placeOfPublication;
 private $publisher;

 public function setDateAdded($dateAdded)
 {
  $this->date_added = $dateAdded;

 }

 public function getDateAdded()
 {
  return $this->date_added;
 }

 public function setDescription($description)
 {
  $this->description = $description;
  return $this->description;
 }

 public function getDescription()
 {
  return $this->description;
 }

 public function setEdition($edition)
 {
  $this->edition = $edition;
  return $this->edition;
 }

 public function getEdition()
 {
  return $this->edition;
 }

 public function setForeignKey($foreignKey)
 {
  $this->foreignKey = $foreignKey;
  return $this->foreignKey;
 }

 public function getForeignKey()
 {
  return $this->foreignKey;
 }

 public function setId($id)
 {
  $this->id = $id;
//  return $this->id;
 }

 public function getId()
 {
  return $this->id;
 }

 public function setInitials($initials)
 {
  $this->initials = $initials;
  return $this->initials;
 }

 public function getInitials()
 {
  return $this->initials;
 }

 public function setPlaceOfPublication($placeOfPublication)
 {
  $this->placeOfPublication = $placeOfPublication;
  return $this->placeOfPublication;
 }

 public function getPlaceOfPublication()
 {
  return $this->placeOfPublication;
 }

 public function setPublisher($publisher)
 {
  $this->publisher = $publisher;
  return $this->publisher;
 }

 public function getPublisher()
 {
  return $this->publisher;
 }

 public function setSurname($surname)
 {
  $this->surname = $surname;
  return $this->surname;
 }

 public function getSurname()
 {
  return $this->surname;
 }

 public function setTitle($title)
 {
  $this->title = $title;
//  return $this->title;
 }

 public function getTitle()
 {
  return $this->title;
 }

 public function setType($type)
 {
  $this->type = $type;
  return $this->type;
 }

 public function getType()
 {
  return $this->type;
 }

 public function setUserAccess($userAccess)
 {
  $this->user_access = $userAccess;
  return $this->user_access;
 }

 public function getUserAccess()
 {
  return $this->user_access;
 }

 public function setWhoAdded($whoAdded)
 {
  $this->who_added = $whoAdded;
  return $this->who_added;
 }

 public function getWhoAdded()
 {
  return $this->who_added;
 }

 public function setYear($year)
 {
  $this->year = $year;
  return $this->year;
 }

 public function getYear()
 {
  return $this->year;
 }


}

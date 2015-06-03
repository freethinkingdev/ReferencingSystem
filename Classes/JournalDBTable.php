<?php
/**
 * User: Marcin
 * Date: 11/11/2012
 * Time: 22:39
 * File name: JournalDBTable.php
 */
class JournalDBTable
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
 private $title_of_journal;
 private $volume_number;
 private $part_number;
 private $page_number;

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
 }

 public function getDescription()
 {
  return $this->description;
 }

 public function setForeignKey($foreignKey)
 {
  $this->foreignKey = $foreignKey;
 }

 public function getForeignKey()
 {
  return $this->foreignKey;
 }

 public function setId($id)
 {
  $this->id = $id;
 }

 public function getId()
 {
  return $this->id;
 }

 public function setInitials($initials)
 {
  $this->initials = $initials;
 }

 public function getInitials()
 {
  return $this->initials;
 }

 public function setTitleofJournal($journalTitle)
 {
  $this->title_of_journal = $journalTitle;
 }

 public function getTitleofJournal()
 {
  return $this->title_of_journal;
 }

 public function setPageNumber($pageNumber)
 {
  $this->page_number = $pageNumber;
 }

 public function getPageNumber()
 {
  return $this->page_number;
 }

 public function setPartNumber($partNumber)
 {
  $this->part_number = $partNumber;
 }

 public function getPartNumber()
 {
  return $this->part_number;
 }

 public function setSurname($surname)
 {
  $this->surname = $surname;
 }

 public function getSurname()
 {
  return $this->surname;
 }

 public function setTitle($title)
 {
  $this->title = $title;
 }

 public function getTitle()
 {
  return $this->title;
 }

 public function setType($type)
 {
  $this->type = $type;
 }

 public function getType()
 {
  return $this->type;
 }

 public function setUserAccess($userAccess)
 {
  $this->user_access = $userAccess;
 }

 public function getUserAccess()
 {
  return $this->user_access;
 }

 public function setVolumeNumber($volumeNumber)
 {
  $this->volume_number = $volumeNumber;
 }

 public function getVolumeNumber()
 {
  return $this->volume_number;
 }

 public function setWhoAdded($whoAdded)
 {
  $this->who_added = $whoAdded;
 }

 public function getWhoAdded()
 {
  return $this->who_added;
 }

 public function setYear($year)
 {
  $this->year = $year;
 }

 public function getYear()
 {
  return $this->year;
 }
}

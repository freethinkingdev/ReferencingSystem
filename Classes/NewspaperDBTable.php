<?php
/**
 * User: Marcin
 * Date: 11/11/2012
 * Time: 22:43
 * File name: NewspaperDBTable.php
 */
class NewspaperDBTable
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
    private $title_of_newspaper;
    private $date_and_month;
    private $page_numbers;

    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }

    public function setDateAndMonth($date_and_month)
    {
        $this->date_and_month = $date_and_month;
    }

    public function getDateAndMonth()
    {
        return $this->date_and_month;
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

    public function setPageNumbers($page_numbers)
    {
        $this->page_numbers = $page_numbers;
    }

    public function getPageNumbers()
    {
        return $this->page_numbers;
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

    public function setTitleOfNewspaper($title_of_newspaper)
    {
        $this->title_of_newspaper = $title_of_newspaper;
    }

    public function getTitleOfNewspaper()
    {
        return $this->title_of_newspaper;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUserAccess($user_access)
    {
        $this->user_access = $user_access;
    }

    public function getUserAccess()
    {
        return $this->user_access;
    }

    public function setWhoAdded($who_added)
    {
        $this->who_added = $who_added;
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

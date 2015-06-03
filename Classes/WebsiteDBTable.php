<?php
/**
 * User: Marcin
 * Date: 11/11/2012
 * Time: 22:44
 * File name: WebsiteDBTable.php
 */
class WebsiteDBTable
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
 private $url;
 private $date_last_accessed;

    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }

    public function setDateLastAccessed($date_last_accessed)
    {
        $this->date_last_accessed = $date_last_accessed;
    }

    public function getDateLastAccessed()
    {
        return $this->date_last_accessed;
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

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
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

<?php
/**
 * User: Marcin
 * Date: 01/12/2012
 * Time: 23:09
 * File name: Connect.php
 */
class Connect
{
    protected $connection;

    function __construct()
    {
        if ($this->connection = @mysqli_connect("localhost", "ha178pxv_refsysa", "ASDF43fp34", "ha178pxv_ReferencingSystem")) {
        } else {
            echo "DB error";
        }
    }

    function __destruct()
    {
        mysqli_close($this->connection);
    }
}

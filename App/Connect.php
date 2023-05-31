<?php

class Connect
{
    // private $host = 'localhost';
    private $host = 'localhost:3307';
    private $user = 'root';
    private $pw = '';
    private $db = 'apollo';
    function getConnection()
    {
        $con = new mysqli($this->host, $this->user, $this->pw, $this->db);
        if (!$con) {
            die('Error occured!' . mysqli_connect_error());
        }
        return $con;
    }
}

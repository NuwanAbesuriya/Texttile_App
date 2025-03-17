<?php

class DB
{
    private $conn;
    private $hostname = "localhost";
    private $dbusername = "root";
    private $dbpaassword = "";
    private $db = "bosaratextile";

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->hostname,
            $this->dbusername,
            $this->dbpaassword,
            $this->db
        ) or die("Connection Error");
    }
    public function getConnection()
    {
        return $this->conn;
    }
}

$db_obj = new DB();
$conn = $db_obj->getConnection();

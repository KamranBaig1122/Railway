<?php

class Db
{
    private $host, $username, $password, $dbname, $conn;
    public function __construct($host = "localhost", $username = "root", $password = "", $dbname = "railway")
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }
    private function connect()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname) or die("Connection failed: " . $this->conn->connect_error);
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}

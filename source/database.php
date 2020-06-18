<?php
class database {
    private $host="localhost";
    private $port=3307;
    private $user="root";
    private $password="060497";
    private $dbname="school_project";
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->host,$this->user,$this->password,$this->dbname,$this->port)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    }

    function __destruct()
    {
        $this->conn->close();
    }

    function checkConnection(){
        if(is_resource($this->conn)) return true;
        else return false;
    }

    function prepare($query){
        return $this->conn->prepare($query);
    }
}








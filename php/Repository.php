<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/consts/url.php");


abstract class Repository{
    

    protected $table;

    public function __construct($table) 
    {
        $this->table = $table;
    }

    protected function connect(){
        $conn = new mysqli(DATABASE_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: ".$conn->connect_error);
        }

        return $conn;
    }

    public function selectAll() {
        $conn = $this->connect();
    
        $sql = "SELECT * FROM $this->table";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array();
        }
    }
}
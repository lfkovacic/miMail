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
        $conn = new mysqli(DATABASE_HOST, DB_USERNAME, DB_PASSWORD);

        if ($conn->connect_error) {
            die("Connection failed: ".$conn->connect_error);
        } else echo "Connected successfully";
    }
}
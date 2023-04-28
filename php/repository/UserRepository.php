<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/Repository.php");

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct("USER"); //Naziv tablice        
    }

    public function getUser($username)
    {
        $sql = "SELECT u.* FROM USER u WHERE u.username LIKE '".$username."'";
        $conn = parent::connect();
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

    public function registerUser($username, $pwd_hash){
        $sql =  "INSERT INTO user (USERNAME, PWD_HASH) ".
                "VALUES ('".$username."', '".$pwd_hash."')";
        $conn = parent::connect();
        $result = $conn->query($sql);
        
        return $result;
    }
}

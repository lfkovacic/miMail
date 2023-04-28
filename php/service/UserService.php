<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/repository/UserRepository.php");

class UserService {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function authenticateUser($username, $password) {
        $user = $this->userRepository->getUser($username);
        if ($user[0]["USERNAME"] == $username && $user[0]["PWD_HASH"] == $password){
            return true;
        } else return false;
    }
}
<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/repository/UserRepository.php");

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function authenticateUser($username, $password)
    {
        $user = $this->userRepository->getUser($username);
        if ($user[0]["USERNAME"] == $username && $user[0]["PWD_HASH"] == $password) {
            return true;
        } else return false;
    }

    public function registerUser($username, $pwd_hash)
    {
        $user = $this->userRepository->getUser($username);
        if ($user[0]["USERNAME"] == $username)
            return "Greška kod registracije: korisničko ime " . $username . " već postoji!";
        else
            $sql_response = $this->userRepository->registerUser($username, $pwd_hash);
        if ($sql_response == 1)
            return "Korisnik uspješno registriran.";
        else
            return "Greška kod registracije korisnika!";
    }
}

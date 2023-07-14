<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/repository/UserRepository.php");
include_once($rootDirectory . '/php/jwt/Jwt.php');
class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function authenticateUser($username, $passworArr)
    {

        //Implementirati kao JSON?
        $user = $this->userRepository->getUser($username);
        if ($user[0]["USERNAME"] == $username){
            $authenticated = false;
            foreach($passworArr as $hash){
                if ($user[0]["PWD_HASH"] == $hash){
                    $authenticated = true;
                    break;
                }
            }
        }
        if ($authenticated){
            $tokenString = MyJwt::getToken($username);
            return array('status'=>'success', 'msg'=>'Uspješna prijava', 'stsCode'=>'LOGIN_SUCCESS', 'token'=>$tokenString);
        } else return array('status'=>'error', 'msg'=>'Greška kod prijave', 'stsCode'=>'LOGIN_ERROR', 'token'=>null); //False
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

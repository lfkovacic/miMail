<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/jwt/Jwt.php");

class AuthentificationService{
    public function isTokenValid($token){
        return MyJwt::isTokenValid($token);
    }
}
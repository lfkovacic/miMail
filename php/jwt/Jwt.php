<?php

use Firebase\JWT\JWT;

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/consts/url.php");
include_once($rootDirectory . "/vendor/firebase/php-jwt/src/JWT.php");

class MyJwt
{
    private $payload;

    public function __construct($username)
    {
        $this->payload = array(
            "iss" => "miMail",
            "username" => $username,
            "iat" => time(),
            "exp" => time() + 3600
        );
    }

    public function getToken()
    {
        $jwt = JWT::encode($this->payload, SECRET_KEY, 'HS256');
        return $jwt;
    }
}

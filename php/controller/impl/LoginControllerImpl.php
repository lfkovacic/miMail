<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/controller/LoginController.php");
include_once($rootDirectory."/php/Controller.php");
$controller_uri = '/api/login';
$LoginController = new Controller (
    array(
        new EchoUser('GET', $controller_uri.'/echouser'),
        new AuthenticateUser('POST', $controller_uri.'/authenticateUser'),
        new RegisterUser('POST', $controller_uri.'/registerUser')
  ), $controller_uri
);
$LoginController->run();
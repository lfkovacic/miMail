<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/controller/LoginController.php");
include_once($rootDirectory."/php/Controller.php");
$controller_uri = '/api/login';
$LoginController = new Controller (
    array(
        new EchoUser('GET', $controller_uri.'/echouser')
    ), $controller_uri
);
$LoginController->run();
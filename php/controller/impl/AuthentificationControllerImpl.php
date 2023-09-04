<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/controller/AuthentificationController.php");
include_once($rootDirectory . "/php/Controller.php");
$controller_uri = '/api/authentification';
$AuthentificationController = new Controller(
    array(
        new ValidateToken('POST', $controller_uri . '/validateToken', false),
        new ClientIp('GET', $controller_uri . '/getClientIp', false),
        new GetUserId('POST', $controller_uri.'/getUserId', true)
    ),
    $controller_uri
);
$AuthentificationController->run();

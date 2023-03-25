<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/controller/EchoEchoController.php");
include_once($rootDirectory."/php/Controller.php");
$controller_uri = '/api/echoecho';
$EchoEchoController = new Controller(
    array(
        new EchoEcho('GET', $controller_uri.'/echoecho')
    ), $controller_uri
);
$EchoEchoController->run();


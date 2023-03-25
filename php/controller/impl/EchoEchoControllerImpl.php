<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/controller/EchoEchoController.php");
$EchoEchoEndpoint = new EchoEcho('GET', '/api/EchoEcho/echoecho');
$EchoEchoEndpoint->run();


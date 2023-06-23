<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory."/php/controller/MailController.php");
include_once($rootDirectory."/php/Controller.php");

$controller_uri = '/api/mail';
$MailController = new Controller (
    array(
        new SendMail('POST', $controller_uri.'/sendMail', true),
        new ReceiveMail('POST', $controller_uri.'/receiveMail', true)
    ), $controller_uri
);

$MailController->run();

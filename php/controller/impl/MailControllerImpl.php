<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/controller/MailController.php");
include_once($rootDirectory . "/php/Controller.php");

$controller_uri = '/api/mail';
$MailController = new Controller(
    array(
        new SendMail('POST', $controller_uri . '/sendMail', true),
        new ReceiveMail('POST', $controller_uri . '/receiveMail', false),
        new GetAllMail('GET', $controller_uri.'/getAllMail', true),
        new GetMailByMailId('GET', $controller_uri.'/getMail', true),
        new DeleteMail('POST', $controller_uri.'/deleteMail', true)
    ),
    $controller_uri
);

$MailController->run();

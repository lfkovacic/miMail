<?php

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory.'/php/Endpoint.php');
include_once($rootDirectory.'/php/service/UserService.php');
include_once($rootDirectory.'/php/service/MailService.php');
include_once($rootDirectory.'/php/mailServer/Mail.php');

class SendMail extends Endpoint {
    protected function parseRequest(&$dto){
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->sender = $data['sender'];
        $dto->recipient = $data['recipient'];
        $dto->subject = $data['subject'];
        $dto->body = $data['body'];
        $dto->headers = $data['headers'];

        print_r($dto);
    }

    protected function execute($dto){
        $mail = new Mail($dto);
        $mail->send();
    }

}

class ReceiveMail extends Endpoint{
    protected function parseRequest(&$dto){
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->sender = $data['sender'];
        $dto->recipient = $data['recipient'];
        $dto->subject = $data['subject'];
        $dto->body = $data['body'];
        $dto->headers = $data['headers'];

        print_r($dto);

    }
    protected function execute($dto) {
        $mailService = new MailService();
        header('Content-Type: application/json');
        preg_match("/([\x00-\x7f`]+)@(.+)/", $dto->recipient, $matches);
        $username = $matches[1];
        $sql_response = $mailService->insertMail($username, $dto->sender, $dto->subject, $dto->body);
        echo $sql_response;
    }
}
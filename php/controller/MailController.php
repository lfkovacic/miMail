<?php

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/Endpoint.php');
include_once($rootDirectory . '/php/service/UserService.php');
include_once($rootDirectory . '/php/service/MailService.php');
include_once($rootDirectory . '/php/mailServer/Mail.php');

class SendMail extends Endpoint
{
    protected function parseRequest(&$dto)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->sender = $data['sender'];
        $dto->recipient = $data['recipient'];
        $dto->subject = $data['subject'];
        $dto->body = $data['body'];
        $dto->headers = $data['headers'];
    }

    protected function execute($dto)
    {
        $mail = new Mail($dto);
        $mail->send();
    }
}

class ReceiveMail extends Endpoint
{
    protected function parseRequest(&$dto)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->sender = $data['sender'];
        $dto->recipient = $data['recipient'];
        $dto->subject = $data['subject'];
        $dto->body = $data['body'];
        $dto->headers = $data['headers'];
    }
    protected function execute($dto)
    {
        $mailService = new MailService();
        header('Content-Type: application/json');
        preg_match("/([\x00-\x7f`]+)@(.+)/", $dto->recipient, $matches);
        $username = $matches[1];
        $sql_response = $mailService->insertMail($username, $dto->sender, $dto->subject, $dto->body);
        echo $sql_response;
    }
}
class GetAllMail extends Endpoint
{
    protected function parseRequest(&$dto)
    {
        $dto->username = $_GET['username'];
    }
    protected function execute($dto)
    {
        $mailService = new MailService();
        $sql_response = $mailService->getAllMail($dto->username);
        $response_raw = array();
        foreach ($sql_response as $mail) {
            $mail_id = $mail['MAIL_ID'];
            $from = $mail['M_FROM'];
            $subject = $mail['M_SUBJECT'];
            $mail_arr = array("id" => $mail_id, "from" => $from, "subject" => $subject);
            array_push($response_raw, $mail_arr);
        }
        echo json_encode($response_raw);
    }
}

class GetMailByMailId extends Endpoint{
    protected function parseRequest(&$dto){
        $dto->id = $_GET['id'];
    }
    protected function execute($dto){
        $mailService = new MailService();
        $sql_response = $mailService->getMail($dto->id);
        $from = $sql_response[0]['M_FROM'];
        $subject = $sql_response[0]['M_SUBJECT'];
        $content = $sql_response[0]['M_CONTENT'];
        $response_raw = array("from"=> $from, "subject" => $subject, "content" => $content);
        echo json_encode($response_raw);
    }
}

<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/Endpoint.php');
include_once($rootDirectory . '/php/service/AuthentificationService.php');

class ValidateToken extends Endpoint {
    protected function parseRequest(&$dto)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->token = $data['token'];
    }
    protected function execute($dto){
        $authentificationService = new AuthentificationService();
        $response = $authentificationService->isTokenValid($dto->token);
        echo $response;
    }
}
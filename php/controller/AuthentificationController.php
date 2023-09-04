<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/Endpoint.php');
include_once($rootDirectory . '/php/service/AuthentificationService.php');
include_once($rootDirectory.'/php/service/UserService.php');
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

class ClientIp extends Endpoint {
    protected function parseRequest(&$dto){

    }
    protected function execute($dto){
        echo $_SERVER['REMOTE_ADDR'];
    }
}

class GetUserId extends Endpoint {
    protected function parseRequest(&$dto){
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->username = $data['username'];
    }

    protected function execute($dto){
        $userService = new UserService();
        $response = $userService->getUserId($dto->username);
        echo json_encode(array("uid"=>$response));
    }
}
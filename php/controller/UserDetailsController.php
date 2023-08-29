<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/Endpoint.php');
include_once($rootDirectory . '/php/service/UserDetailsService.php');

class GetUserDetailsByUserId extends Endpoint
{

    protected function parseRequest(&$dto)
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        $dto -> UID = $data ["uid"];
    }

    protected function execute($dto)
    {
        $userDetailService = new UserDetailsService();
        header("Content-Type: application/json");
        $res = $userDetailService -> getUserDetailsByUserId($dto -> UID);
        echo json_encode($res);
    }
}
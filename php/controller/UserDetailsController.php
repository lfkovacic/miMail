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

class InsertUserDetails extends Endpoint {
    protected function parseRequest(&$dto) {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        $dto -> user_id = $data["user_id"];
        $dto -> drzava = $data["drzava"];
        $dto -> adresa = $data["adresa"];
        $dto -> kucni_broj = $data["kucni_broj"];
        $dto -> grad = $data["grad"];
        $dto -> postanski_broj = $data["postanski_broj"];
        $dto -> broj_telefona = $data["broj_telefona"];
        $dto -> email_adresa = $data["email_adresa"];
        $dto -> oib = $data["oib"];  
        
    }

    protected function execute($dto)
    {
        $userDetailService = new UserDetailsService();
        header("Content-Type: application/json");
        print_r($dto);
        $res = $userDetailService -> insertUserDetails(
            $dto -> user_id, 
            $dto -> drzava, 
            $dto -> adresa, 
            $dto -> kucni_broj,
            $dto -> grad ,
            $dto -> postanski_broj,
            $dto -> broj_telefona,
            $dto -> email_adresa,
            $dto -> oib
         );

        echo json_encode($res);
    }

}
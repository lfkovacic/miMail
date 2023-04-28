<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory.'/php/Endpoint.php');
include_once($rootDirectory.'/php/service/UserService.php');



class EchoUser extends Endpoint {
    protected function parseRequest(&$dto){
        $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($queryString, $params);

        if(!empty($params['username']&&!empty($params['password']))){
            $dto->username = $params['username'];
            $dto->password = $params['password'];
        }
    }

	protected function execute($dto) {
        header('Content-Type: application/json');
        $data = array('username' => $dto->username, 'password' => $dto->password);
        echo json_encode($data);
	}
}

class RegisterUser extends Endpoint {
    protected function parseRequest(&$dto) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $dto->username = $data['username'];
        $dto->password = $data['password'];
    }

    protected function execute($dto){
        $userService = new UserService();
        header('Content-Type: application/json');
        $data = array('username' => $dto->username, 'password' => $dto->password);
        $sql_response = $userService->registerUser($dto->username, $dto->password);
        echo $sql_response;
        
    }
}

class AuthenticateUser extends Endpoint {
    
    protected function parseRequest(&$dto) {
        // Get JSON object from request body
        $json = file_get_contents('php://input');

        // Decode JSON object into associative array
        $data = json_decode($json, true);
        

        // Assign properties to DTO object
        $dto->username = $data['username'];
        $dto->password = $data['password'];
    }

    protected function execute($dto) {
        $userService = new UserService();
        header('Content-Type: application/json');
        echo json_encode($userService->authenticateUser($dto->username, $dto->password));
    }
}

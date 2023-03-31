<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory.'/php/Endpoint.php');

class EchoUser extends Endpoint {
    protected function parseRequest(&$dto){
        $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($queryString, $params);

        if(!empty($params['username']&&!empty($params['password']))){
            $dto->username = $params['username'];
            $dto->password = $params['password'];
        }
    }

	/**
	 * @param mixed $dto
	 * @return mixed
	 */
	protected function execute($dto) {
        header('Content-Type: application/json');
        $data = array('username' => $dto->username, 'password' => $dto->password);
        echo json_encode($data);
	}
}
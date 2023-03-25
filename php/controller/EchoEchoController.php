<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory.'/php/Endpoint.php');

class EchoEcho extends Endpoint
{
    protected function parseRequest(&$dto)
    {
        $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($queryString, $params);

        if (!empty($params['string'])) {
            $dto->string = $params['string'];
        }
    }

    protected function execute($dto)
    {
        header('Content-Type: application/json');
        $data = array('message' => $dto->string);
        echo json_encode($data);
    }
}

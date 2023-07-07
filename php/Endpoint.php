<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/service/AuthentificationService.php');

abstract class Endpoint
{
    protected $method;
    protected $uri;
    protected $dto;
    protected $isAuth = false;

    public function __construct($method, $uri, $isAuth)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->isAuth = $isAuth;
    }

    abstract protected function execute($dto);

    public function run()
    {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = $_SERVER['REQUEST_URI'];
        $request_regex = "/([^?]*)\?(.*)/";
        preg_match($request_regex, $request_uri, $matches);
        if (!empty($matches)) $uri_match = $matches[1];
        else $uri_match = ""; //Mrzim php...
        if (!($this->uri == $request_uri || $this->uri == $uri_match) || $this->method != $request_method) return false;
        else {
            $auth_header = $this->isAuth ? getallheaders()['Authorization'] : '';
            $token = '';
            if (preg_match("/Bearer (.*)/", $auth_header, $matches)) {
                $token = $matches[1];
            }
            $authentificationService = new AuthentificationService();
            if ($this->isAuth && !$authentificationService->isTokenValid($token)) {
                throw new Exception("401: Unauthorized", 401);
            }

            $dto = new stdClass();
            $this->parseRequest($dto);
            $this->execute($dto);
            return true;
        }
    }

    abstract protected function parseRequest(&$dto);
}

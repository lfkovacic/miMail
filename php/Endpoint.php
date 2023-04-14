<?php

abstract class Endpoint
{
    protected $method;
    protected $uri;
    protected $dto;

    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }

    abstract protected function execute($dto);

    public function run()
    {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = $_SERVER['REQUEST_URI'];

        if ($request_method == $this->method && strpos($request_uri, $this->uri) === 0) {
            $dto = new stdClass();
            $this->parseRequest($dto);
            $this->execute($dto);
            return true;
        } else {
            return false;
        }
    }

    abstract protected function parseRequest(&$dto);
}

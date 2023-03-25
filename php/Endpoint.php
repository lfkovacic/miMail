<?php

abstract class Endpoint
{
    protected $method;
    protected $uri;

    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }

    abstract protected function execute();

    public function run()
    {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = $_SERVER['REQUEST_URI'];

        if ($request_method == $this->method && $request_uri == $this->uri) {
            return $this->execute();
        }
    }
}

<?php
class Controller
{
    protected $endpoints;
    protected $controller_uri_segment;

    public function __construct($endpoints, $controller_uri_segment)
    {
        $this->endpoints = new ArrayObject($endpoints);
        $this->controller_uri_segment = $controller_uri_segment;
    }

    public function run()
    {
        try {
            $matched = false;
            foreach ($this->endpoints as $endpoint) {
                $matched = $endpoint->run() || $matched;
            }
            if (!$matched) $this->error();
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo $e->getMessage();
        }
    }

    public function error()
    {
        header('Location: /error.php');
        exit();
    }
}

<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory.'/php/Endpoint.php');
class EchoEcho extends Endpoint {
    protected function execute() {
        header('Content-Type: application/json');
        $data = array('message' => 'echoecho');
        echo json_encode($data);
    }
}
?>

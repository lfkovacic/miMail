<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/Endpoint.php');
include_once($rootDirectory . '/php/controller/UserDetailsController.php');
$controller_uri = '/api/UserDetails';

$UserDetailsController = new Controller(
    array(
        new GetUserDetailsByUserId ('POST', $controller_uri.'/getUserDetails', true)

    ),
    $controller_uri
);

$UserDetailsController -> run();

?>
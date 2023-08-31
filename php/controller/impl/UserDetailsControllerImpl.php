<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . '/php/controller/UserDetailsController.php');
include_once($rootDirectory . "/php/Controller.php");
$controller_uri = '/api/UserDetails';

$UserDetailsController = new Controller(
    array(
        new GetUserDetailsByUserId ('POST', $controller_uri.'/getUserDetails', true),
        new InsertUserDetails ('POST', $controller_uri.'/insertUserDetails', true)
    ),
    $controller_uri
);

$UserDetailsController -> run();

?>
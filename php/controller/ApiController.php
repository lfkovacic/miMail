<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/api/users') {
    // Get list of users from your service or model layer
    $response = "echoecho";
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/api/test') {
    $response = json_encode(array('key'=>"value"));
    echo $response;

}
if (!isset($_SERVER['REQUEST_URI']) || !isset($_SERVER['REQUEST_METHOD'])) {
    http_response_code(404);
    echo "404 Not Found";
    exit;
}
?>

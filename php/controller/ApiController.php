if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/api/echoecho') {
    $response = 'Hello world!';
    header('Content-Type: application/json');
    echo json_encode($response)
}
if (!isset($_SERVER['REQUEST_URI'] || !isset($_SERVER['REQUEST_METHOD'])) {
    http_response_code(404);
    echo "404 Not Found";
    exit;
}
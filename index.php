<?php

// Function to create and return API response
function createApiResponse($statusCode, $data, $exceptionMessage = null) {
    http_response_code($statusCode);
    header('Content-Type: application/json');

    $response = array(
        "data" => $data
    );

    if ($exceptionMessage !== null) {
        $response['error'] = $exceptionMessage;
    }

    echo json_encode($response);
    die(); // Terminate script execution
}

// Get the controller name from the request
$controllerName = ucfirst($_GET['controller']) . 'Controller';

// Check if the controller file exists
$controllerFilePath = __DIR__ . '/controllers/' . $controllerName . '.php';

if (!file_exists($controllerFilePath)) {
    http_response_code(501);
    echo json_encode(array("message" => "Controller not implemented."));
    exit();
}

// Require the controller file
require_once $controllerFilePath;

// Check if the request method is supported by the controller
// $validMethods = get_class_methods($controllerName);


// if (!in_array($method, $validMethods)) {
//     http_response_code(405);
//     echo json_encode(array("message" => "Method not allowed."));
//     exit();
// }

// Instantiate the controller
$controller = new $controllerName();
$controller->init();

?>

<?php

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
$validMethods = get_class_methods($controllerName);
$method = $_SERVER['REQUEST_METHOD'];

if (!in_array($method, $validMethods)) {
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
    exit();
}

// Instantiate the controller
$controller = new $controllerName();

// Execute the controller method
$controller->$method();

?>

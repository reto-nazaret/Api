<?php

require_once '../services/AlumnosService.php';

class AlumnosController {
    private $alumnosService;

    public function __construct() {
        $this->alumnosService = new AlumnosService();
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    
                    $response = $this->alumnosService->getById($id);

                    // Return the response
                    echo json_encode($response);

                } else {
                    $response = $this->alumnosService->getAll();

                    // Return the response
                    echo json_encode($response);
                }
                break;
            case 'POST':
                require_once '../requests/AlumnoCreateRequest.php';
                // Logic to handle POST
                break;
            case 'PUT':
                require_once '../requests/AlumnoUpdateRequest.php';
                // Logic to handle PUT
                break;
            case 'DELETE':
                // Logic to handle DELETE
                break;
            default:
                http_response_code(405);
                echo json_encode(array("message" => "Method not allowed."));
                exit();
        }
    }

}

?>

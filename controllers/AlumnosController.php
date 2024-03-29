<?php

require_once  'services\alumnosService.php';

class AlumnosController
{
    private $alumnosService;

    public function __construct()
    {
        $this->alumnosService = new AlumnosService();
    }

    public function init()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                if (isset($_GET['id']) && (filter_var($_GET['id'], FILTER_VALIDATE_INT) === false || $_GET['id'] <= 0)) {
                    $id = $_GET['id'];
                    $data = $this->alumnosService->getById($id);

                    // verificar si el $data esta bien, para crear el response
                    // return the json response and die
                    // echo json_encode($response);

                } else {
                    $response = $this->alumnosService->getAll();

                    // return the json response and die
                    echo json_encode($response);
                }
                break;
            case 'POST':
                require_once 'requests\alumnoVerifyCreateRequest.php';
                $requestData = json_decode(file_get_contents('php://input'), true);
                $verifRequest = new AlumnoVerifyCreateRequest($requestData);
// verif request si no esta  bien -> error
                $data = $this->alumnosService->create($requestData);
                echo json_encode($data);
                // verificar si el $data esta bien, para crear el response
                break;
            case 'PUT':
                require_once 'requests\alumnoVerifyUpdateRequest.php';
                $requestData = json_decode(file_get_contents('php://input'), true);
                $request = new AlumnoVerifyUpdateRequest($requestData);

                $data = $this->alumnosService->update($request);
                // verificar si el $data esta bien, para crear el response

                break;
            case 'DELETE':
                // verificar si el is existe, y tiene un valor intero positivo
                if (isset($_GET['id']) && (filter_var($_GET['id'], FILTER_VALIDATE_INT) === false || $_GET['id'] <= 0)) {
                    $id = $_GET['id'];
                    $data = $this->alumnosService->delete($id);

                    // create the response
                }

                break;
            default:
                http_response_code(405);
                echo json_encode(array("message" => "Method not allowed."));
                exit();
        }
    }
}

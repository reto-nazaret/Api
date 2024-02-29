<?php

class AlumnoVerifyCreateRequest
{
    private $requestData;

    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    public function validate()
    {
        // Basic validation logic for create request
        if (
            !isset($this->requestData['nombre']) ||
            !isset($this->requestData['apellidos']) ||
            !isset($this->requestData['dni']) ||
            !isset($this->requestData['poblacion']) ||
            !isset($this->requestData['email']) ||
            !isset($this->requestData['id_ciclo'])
        ) {
            return false;
        }

        return true;
    }
}

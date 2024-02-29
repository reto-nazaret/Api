<?php

class AlumnoUpdateRequest
{
    private $requestData;

    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    public function validate()
    {
        // Basic validation logic for update request
        if (
            !isset($this->requestData['id']) ||
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

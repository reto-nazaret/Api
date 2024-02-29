<?php

require_once 'config\database.php';
// require_once '../entities/Alumno.php';

class AlumnosService
{
    private $conn;
    public $table = 'alumnos';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($data)
    {
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $dni = $data['dni'];
        $poblacion = $data['poblacion'];
        $email = $data['email'];
        $id_ciclo = $data['id_ciclo'];

        // Use single quotes to define the SQL query string
        $query = "INSERT INTO $this->table (nombre, apellidos, dni, poblacion, email, id_ciclo) 
                  VALUES (:nombre, :apellidos, :dni, :poblacion, :email, :id_ciclo)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters to avoid SQL injection
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':poblacion', $poblacion);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_ciclo', $id_ciclo);

        if ($stmt->execute()) {
            return 1; // Successful creation
        } else {
            return -1; // Error
        }
    }


    public function update($data)
    {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, apellido = :apellido, ciclo = :ciclo WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':apellido', $data['apellido']);
        $stmt->bindParam(':ciclo', $data['ciclo']);
        $stmt->bindParam(':id', $data['id']);
        if ($stmt->execute()) {
            return 1; // Successful update
        } else {
            return -1; // Error
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return 1; // Successful deletion
        } else {
            return -1; // Error
        }
    }
}

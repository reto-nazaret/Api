<?php

require_once '../config/database.php';
// require_once '../entities/Alumno.php';

class AlumnosService {
    private $conn;
    public $table = 'alumnos';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (nombre, apellido, ciclo) VALUES (:nombre, :apellido, :ciclo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':apellido', $data['apellido']);
        $stmt->bindParam(':ciclo', $data['ciclo']);
        if ($stmt->execute()) {
            return 1; // Successful creation
        } else {
            return -1; // Error
        }
    }

    public function update($data) {
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

    public function delete($id) {
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

?>

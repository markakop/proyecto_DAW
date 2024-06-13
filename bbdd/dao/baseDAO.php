<?php

class BaseDAO {
    
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    protected function obtenerResultados($sql) {
        $result = $this->conn->query($sql);
        $data = array();

        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        } else {
            die("Error en la consulta: " . $this->conn->error);
        }

        return $data;
    }

    protected function ejecutarConsulta($sql) {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>

<?php
class Consultas {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "entranet";
    private $conn;

    // Constructor para conectar a la base de datos
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Método para obtener todos los eventos
    public function obtenerEventos() {
        $sql = "SELECT * FROM eventos";
        return $this->realizarConsulta($sql);
    }

    public function obtenerEventosId($id) {
        $sql = "SELECT * FROM eventos as e join direcciones as d on e.direccion_id=d.id_direccion JOIN provincia as p on d.id_provincia=p.id_provincia WHERE e.id_evento=$id;";
        return $this->realizarConsulta($sql);
    }

    // Método para obtener todas las direcciones
    public function obtenerDirecciones() {
        $sql = "SELECT * FROM Direcciones";
        return $this->realizarConsulta($sql);
    }

    // Método para realizar una consulta y devolver los resultados
    private function realizarConsulta($sql) {
        $result = $this->conn->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Método para cerrar la conexión a la base de datos
    public function cerrarConexion() {
        $this->conn->close();
    }
}

?>
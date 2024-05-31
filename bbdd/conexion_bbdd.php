<?php
class Consultas {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "root";
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

    public function login($username, $password) {
        $pass = md5($password);
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$username' AND pass='$pass'";

        $result = $this->obtenerResultados($sql);
        return !empty($result);
    }

    public function insertarUsuario() {
        $password = "123456789";
        $pass = md5($password);
        $sql = "INSERT INTO usuarios VALUES (null,'david_8romero@hotmail.com', 'david8romero', '$pass')";

        if ($this->ejecutarConsulta($sql)) {
            return "Realizado";
        } else {
            return "Rechazado: " . $this->conn->error;
        }
    }

    public function modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra) {
        $sql = "UPDATE eventos SET nombre='$nombre', precio=$precio, fecha='$fecha', activo='$activo', url_compra='$url_compra' WHERE id_evento=$id";

        if ($this->ejecutarConsulta($sql)) {
            return "Realizado";
        } else {
            return "Rechazado: " . $this->conn->error;
        }
    }

    public function borrarEvento($id) {
        $sql = "DELETE FROM eventos WHERE id_evento = $id";

        if ($this->ejecutarConsulta($sql)) {
            return "Realizado";
        } else {
            return "Rechazado: " . $this->conn->error;
        }
    }

    // Método para obtener todos los eventos para el HOME
    public function obtenerEventos() {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, e.activo, e.url_compra, i.nombre nombre_img, i.extension, es.ds_estilo estilo, i.url url_imagen
                FROM eventos e 
                JOIN imagenes i ON e.imagen_buscador=i.id_imagen 
                JOIN estilos es ON e.id_estilo=es.id_estilo;";
        return $this->obtenerResultados($sql);
    }

    // Método para obtener todos los eventos para el HOME con filtro
    public function obtenerEventosFiltro($nombre = "", $fecha = "", $estilo = "", $tipo = "") {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, e.activo, e.url_compra, i.nombre nombre_img, i.extension, es.ds_estilo estilo, i.url url_imagen
                FROM eventos e 
                JOIN imagenes i ON e.imagen_buscador=i.id_imagen 
                JOIN estilos es ON e.id_estilo=es.id_estilo 
                JOIN tipo_evento t ON t.id_tipo_evento=e.id_tipo_evento 
                WHERE 1=1 ";
        if ($nombre != "")
            $sql .= " AND e.nombre LIKE '%$nombre%' ";
        if ($fecha != "") {
            switch ($fecha) {
                case "dia":
                    $sql .= " AND DATE(e.fecha) = CURDATE() ";
                    break;
                case "semana":
                    $sql .= " AND WEEK(e.fecha) = WEEK(CURDATE()) ";
                    break;
                case "mes":
                    $sql .= " AND MONTH(e.fecha) = MONTH(CURDATE()) ";
                    break;
                case "trimestre":
                    $sql .= " AND QUARTER(e.fecha) = QUARTER(CURDATE()) ";
                    break;
            }
        }
        if ($estilo != "")
            $sql .= " AND es.ds_estilo='$estilo' ";
        if ($tipo != "")
            $sql .= " AND t.tipo_evento='$tipo'";
        return $this->obtenerResultados($sql);
    }

    public function obtenerEventoId($id) {
        $sql = "SELECT e.nombre nombre, e.fecha fecha, e.descripcion descripcion, e.url_compra url_compra, 
                    d.calle calle, p.provincia provincia, 
                    ib.nombre nombre_img_e, ib.url url_buscador, 
                    ic.nombre nombre_img_c, ic.url url_cartel 
                FROM eventos e 
                JOIN direcciones d ON e.direccion_id=d.id_direccion
                JOIN localidad l USING(id_localidad)
                JOIN provincia p USING(id_provincia)
                JOIN imagenes ib ON ib.id_imagen=e.imagen_buscador
                JOIN imagenes ic ON ic.id_imagen=e.imagen_cartel 
                WHERE e.id_evento=$id;";
        return $this->obtenerResultados($sql)[0];
    }

    public function obtenerEstilo($evento_nombre) {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, i.nombre nombre_img, i.extension extension, i.datos datos, es.ds_estilo estilo 
                FROM eventos e 
                JOIN imagenes i ON e.imagen_evento=i.id_imagen 
                JOIN estilos es ON e.id_estilo=es.id_estilo 
                WHERE es.ds_estilo='$evento_nombre'";
        return $this->obtenerResultados($sql);
    }

    public function obtenerDirecciones() {
        $sql = "SELECT * FROM Direcciones";
        return $this->obtenerResultados($sql);
    }

    // Método para realizar una consulta y devolver los resultados
    private function obtenerResultados($sql) {
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

    // Método para ejecutar consultas que no devuelven resultados
    private function ejecutarConsulta($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Método para cerrar la conexión a la base de datos
    public function cerrarConexion()
    {
        $this->conn->close();
    }
}

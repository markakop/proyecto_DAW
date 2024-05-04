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

    // Función para insertar eventos
    public function insertarEvento($datosEvento) {
        $nombre = $datosEvento['nombre'];
        $precio = $datosEvento['precio'];
        $fecha = $datosEvento['fecha'];
        $localizacion = $datosEvento['localizacion'];
        $url = $datosEvento['url'];
        $imagen_url = $datosEvento['imagen_url'];
    
        $sql = "INSERT INTO eventos (nombre, precio, fecha, localizacion, url, imagen_url) 
                VALUES ('$nombre', '$precio', '$fecha', '$localizacion', '$url', '$imagen_url')";
        
        if ($this->conn->query($sql) === TRUE) {
            return true; // Insertado correctamente
        } else {
            return false; // Error al insertar
        }
    }





    // Método para obtener todos los eventos para el HOME
    public function obtenerEventos() {
        $sql = "SELECT e.id_evento id, e.nombre nombre,
                       e.fecha fecha, e.precio precio, i.nombre nombre_img,
                       i.extension extension, i.datos datos,
                       es.ds_estilo estilo
                FROM eventos e 
                    JOIN imagenes i on i.id_imagen=e.imagen_buscador
                    JOIN estilos es on es.id_estilo=e.id_estilo";
        return $this->realizarConsulta($sql);
    }

    // Método para obtener todos los eventos para el HOME
    public function obtenerEventosFiltro($nombre, $fecha, $estilo) {
        $sql = "SELECT e.id_evento id, e.nombre nombre,
                       e.fecha fecha, e.precio precio, i.nombre nombre_img,
                       i.extension extension, i.datos datos,
                       es.ds_estilo estilo
                FROM eventos e 
                    JOIN imagenes i on i.id_imagen=e.imagen_buscador
                    JOIN estilos es on es.id_estilo=e.id_estilo
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
        return $this->realizarConsulta($sql);
    }

    public function obtenerEventoId($id) {
        $sql = "SELECT e.nombre nombre, e.fecha fecha, e.descripcion descripcion, e.url_compra url_compra,
                    d.calle calle, p.codigo_postal codigo_postal, p.provincia provincia,
                    ie.nombre nombre_img_e, ie.extension extension_e, ie.datos imagen_evento,
                    ic.nombre nombre_img_c, ic.extension extension_c, ic.datos imagen_cartel
                FROM eventos e 
                    JOIN direcciones d on e.direccion_id=d.id_direccion 
                    JOIN provincia p on d.id_provincia=p.id_provincia 
                    JOIN imagenes ie on ie.id_imagen=e.imagen_evento
                    JOIN imagenes ic on ic.id_imagen=e.imagen_cartel
                WHERE e.id_evento=$id;";
        return $this->realizarConsulta($sql)[0];
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
<?php
class Consultas
{
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "root";
    private $dbname = "entranet";
    private $conn;

    // Constructor para conectar a la base de datos
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }


    public function modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra)
    {
        $sql = "UPDATE eventos SET nombre='$nombre', precio=$precio, fecha='$fecha', activo='$activo', url_compra='$url_compra' WHERE id_evento=$id";

        if ($this->realizarConsulta($sql)) {
            return "Realizado";
        } else {
            return "Rechazado";
        }
    }

    public function borrarEvento($id){
        $sql = "DELETE FROM eventos WHERE id_evento = $id";

        if ($this->realizarConsulta($sql)) {
            return "Realizado";
        } else {
            return "Rechazado";
        }
    }

    // Método para obtener todos los eventos para el HOME
    public function obtenerEventos()
    {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, i.nombre nombre_img, i.extension extension, i.datos datos, es.ds_estilo estilo, e.activo, e.url_compra
        FROM eventos e JOIN imagenes i on e.imagen_buscador=i.id_imagen JOIN estilos es on e.id_estilo=es.id_estilo;";
        return $this->realizarConsulta($sql);
    }

    // Método para obtener todos los eventos para el HOME
    public function obtenerEventosFiltro($nombre = "", $fecha = "", $estilo = "", $tipo = "") {
        $sql = "SELECT e.id_evento id, e.nombre nombre,
                       e.fecha fecha, e.precio precio, i.nombre nombre_img,
                       i.extension extension, i.datos datos,
                       es.ds_estilo estilo, t.tipo_evento tipo_evento 
                FROM eventos e 
                    JOIN imagenes i on e.imagen_buscador=i.id_imagen
                    JOIN estilos es on e.id_estilo=es.id_estilo
                    JOIN tipo_evento t on t.id_tipo_evento=e.id_tipo_evento 
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
            $sql .= " AND  t.tipo_evento='$tipo'";
        return $this->realizarConsulta($sql);
    }

    public function obtenerEventoId($id)
    {
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

    public function obtenerEstilo($evento_nombre)
    {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, i.nombre nombre_img, i.extension extension, i.datos datos, es.ds_estilo estilo 
        FROM eventos e JOIN imagenes i on e.imagen_evento=i.id_imagen JOIN estilos es on e.id_estilo=es.id_estilo
        WHERE es.ds_estilo='$evento_nombre'";
        return $this->realizarConsulta($sql);
    }

    // Método para obtener todas las direcciones
    public function obtenerDirecciones()
    {
        $sql = "SELECT * FROM Direcciones";
        return $this->realizarConsulta($sql);
    }

    // Método para realizar una consulta y devolver los resultados
    private function realizarConsulta($sql)
    {
        $result = $this->conn->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Método para cerrar la conexión a la base de datos
    public function cerrarConexion()
    {
        $this->conn->close();
    }
}

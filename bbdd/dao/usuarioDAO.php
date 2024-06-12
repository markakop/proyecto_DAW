<?php
class EventoDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertarEvento($evento) {
        $sql = "INSERT INTO eventos (nombre, direccion_id, precio, fecha, descripcion, imagen_buscador, imagen_cartel, url_compra, id_estilo, id_tipo_evento, activo)
                VALUES ('$evento->nombre',$evento->direccion_id,$evento->precio,'$evento->fecha','$evento->descripcion',$evento->imagen_buscador,$evento->imagen_cartel,'$evento->url_compra',$evento->id_estilo,$evento->id_tipo_evento,'$evento->activo')";
        return $this->ejecutarConsulta($sql);
    }

    public function modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra) {
        $sql = "UPDATE eventos SET nombre='$nombre', precio=$precio, fecha='$fecha', activo='$activo', url_compra='$url_compra' WHERE id_evento=$id";
        return $this->ejecutarConsulta($sql);
    }

    public function borrarEvento($id) {
        $sql = "DELETE FROM eventos WHERE id_evento = $id";
        return $this->ejecutarConsulta($sql);
    }

    public function obtenerEventos() {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, e.activo, e.url_compra, i.nombre nombre_img, es.ds_estilo estilo, i.url
                FROM eventos e 
                JOIN imagenes i ON e.imagen_buscador=i.id_imagen 
                JOIN estilos es ON e.id_estilo=es.id_estilo
                WHERE e.activo='S'";
        return $this->obtenerResultados($sql);
    }

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

    private function ejecutarConsulta($sql) {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>

<?php

include_once 'BaseDAO.php';

class EventosDAO extends BaseDAO {

    public function insertarEvento($evento) {
        $sql = "INSERT INTO eventos (nombre, direccion_id, precio, fecha, descripcion, imagen_buscador, imagen_cartel, url_compra, id_estilo, id_tipo_evento, activo)
                VALUES ('$evento->nombre',$evento->direccion_id,$evento->precio,'$evento->fecha',
                    '$evento->descripcion',$evento->imagen_buscador,$evento->imagen_cartel,'$evento->url_compra',
                    $evento->id_estilo,$evento->id_tipo_evento,'$evento->activo')";
        $this->ejecutarConsulta($sql);
    }

    public function modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra) {
        $sql = "UPDATE eventos SET nombre='$nombre', precio=$precio, fecha='$fecha', activo='$activo', url_compra='$url_compra' WHERE id_evento=$id";
        return $this->ejecutarConsulta($sql);
    }

    public function borrarEvento($id) {
        $sql = "DELETE FROM eventos WHERE id_evento = $id";

        if ($this->ejecutarConsulta($sql)) {
            return "Realizado";
        } else {
            return "Rechazado: " . $this->conn->error;
        }
    }

    public function obtenerEventos() {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, e.activo, e.url_compra, i.nombre nombre_img, es.ds_estilo estilo, i.url, p.provincia
                FROM eventos e 
                JOIN imagenes i ON e.imagen_buscador=i.id_imagen
                JOIN estilos es ON e.id_estilo=es.id_estilo
                JOIN direcciones d ON e.direccion_id=d.id_direccion
                JOIN localidades l USING(id_localidad)
                JOIN provincias p USING(id_provincia)
                WHERE e.activo='S' ";
        return $this->obtenerResultados($sql);
    }

    public function obtenerEventosAdmin() {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, e.activo, e.url_compra, es.ds_estilo estilo, ib.url as buscador, ic.url as cartel
                FROM eventos e 
                JOIN imagenes ib ON e.imagen_buscador=ib.id_imagen
                JOIN imagenes ic ON e.imagen_cartel=ic.id_imagen 
                JOIN estilos es ON e.id_estilo=es.id_estilo";
        return $this->obtenerResultados($sql);
    }

    // Método para obtener todos los eventos para el HOME con filtro
    public function obtenerEventosFiltro($nombre = "", $fecha = "", $estilo = "", $tipo = "", $provincia = "") {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, e.activo, e.url_compra, i.nombre nombre_img, es.ds_estilo estilo, i.url
                FROM eventos e 
                JOIN imagenes i ON e.imagen_buscador=i.id_imagen 
                JOIN estilos es USING(id_estilo)
                JOIN tipo_evento t USING(id_tipo_evento)
                JOIN direcciones d ON d.id_direccion=e.direccion_id
                JOIN localidades l USING (id_localidad)
                JOIN provincias p USING (id_provincia)
                WHERE e.activo='S' ";
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
            $sql .= " AND es.id_estilo='$estilo' ";
        if ($tipo != "")
            $sql .= " AND t.tipo_evento='$tipo'";
        if ($provincia != "")
            $sql .= " AND p.provincia='$provincia' ";
        return $this->obtenerResultados($sql);
    }

    public function obtenerEventoId($id) {
        $sql = "SELECT e.nombre nombre, e.fecha fecha, e.descripcion descripcion, e.url_compra url_compra, 
                    d.calle calle, p.provincia provincia, 
                    ib.nombre nombre_img_e, ib.url url_buscador, 
                    ic.nombre nombre_img_c, ic.url url_cartel 
                FROM eventos e 
                JOIN direcciones d ON e.direccion_id=d.id_direccion
                JOIN localidades l USING(id_localidad)
                JOIN provincias p USING(id_provincia)
                JOIN imagenes ib ON ib.id_imagen=e.imagen_buscador
                JOIN imagenes ic ON ic.id_imagen=e.imagen_cartel 
                WHERE e.id_evento=$id;";
        return $this->obtenerResultados($sql)[0];
    }
}
?>

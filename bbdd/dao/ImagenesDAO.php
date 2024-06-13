<?php

include_once 'BaseDAO.php';

class ImagenesDAO extends BaseDAO {
    
    public function modificarImagen($id, $img_evento, $img_cartel) {
        $sql = "SELECT e.imagen_buscador, e.imagen_cartel FROM eventos e 
                JOIN imagenes ib ON ib.id_imagen=e.imagen_buscador
                JOIN imagenes ic ON ic.id_imagen=e.imagen_cartel
                where e.id_evento=$id";
        $resultado = $this->obtenerResultados($sql)[0];
        $id_buscador = $resultado["imagen_buscador"];
        $id_cartel = $resultado["imagen_cartel"];
        $sql2 = "UPDATE imagenes SET url='$img_evento' WHERE id_imagen=$id_buscador";
        $sql3 = "UPDATE imagenes SET url='$img_cartel' WHERE id_imagen=$id_cartel";
        $result = $this->ejecutarConsulta($sql2);
        $result2 = $this->ejecutarConsulta($sql3);
        if ($result && $result2) {
            return "Realizado";
        } else {
            return "Rechazado: " . $this->conn->error;
        }
    }

    public function insertarImagen($nombre, $url) {
        $sql = "INSERT INTO imagenes(nombre,url)
                VALUES ('$nombre','$url')";
        $this->ejecutarConsulta($sql);
        return $this->conn->insert_id;
    }
}


?>
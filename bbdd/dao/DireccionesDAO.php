<?php

include_once 'BaseDAO.php';

class DireccionesDAO extends BaseDAO {
    
    public function obtenerDirecciones() {
        $sql = "SELECT * FROM direcciones";
        return $this->obtenerResultados($sql);
    }

    public function comprobarDireccion($calle, $id_localidad) {
        //Primero se comprueba si existe una direccion con esa calle y en esa localidad
        $sql = "SELECT * FROM direcciones 
                WHERE calle = '$calle'
                  AND id_localidad=$id_localidad";
        $result = $this->obtenerResultados($sql);
        //Si existe: se coge ese id, en caso contrario, se añade y se coge el id nuevo   
        if (count($result) == 0) {
            $insert = "INSERT INTO direcciones(calle,id_localidad) VALUES('$calle',$id_localidad)";
            $this->obtenerResultados($insert);
            return $this->conn->insert_id;
        }
        return $result[0]['id_direccion'];
    }
}

?>
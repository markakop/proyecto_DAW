<?php

include_once 'BaseDAO.php';

class LocalidadesDAO extends BaseDAO {
    
    public function obtenerLocalidadesProvincia($idProvincia) {
        $sql = "SELECT * FROM localidades WHERE id_provincia=$idProvincia;";
        return $this->obtenerResultados($sql);
    }

    public function comprobarLocalidad($localidad, $id_provincia) {
        //Paso el nombre de la localidad para que la primera letra sea en mayuscula y el resto en minuscula
        $localidad = ucfirst(strtolower($localidad));
        //Primero se comprueba si existe una localidad con ese nombre y en esa provincia
        $sql = "SELECT * FROM localidades 
                WHERE nombre = '$localidad'
                  AND id_provincia=$id_provincia";
        $result = $this->obtenerResultados($sql);
        //Si existe: se coge ese id, en caso contrario, se añade y se coge el id nuevo   
        if (count($result) == 0) {
            $insert = "INSERT INTO localidades(nombre,id_provincia) VALUES('$localidad',$id_provincia)";
            $this->obtenerResultados($insert);
            return $this->conn->insert_id;
        }
        return $result[0]['id_direccion'];
    }
}

?>
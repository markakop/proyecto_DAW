<?php

include_once 'BaseDAO.php';

class ProvinciasDAO extends BaseDAO {
    
    public function obtenerProvincias() {
        $sql = "SELECT * FROM provincias;";
        return $this->obtenerResultados($sql);
    }
}

?>
<?php

include_once 'BaseDAO.php';

class EstilosDAO extends BaseDAO {
    
    public function obtenerEstilos() {
        $sql = "SELECT * FROM estilos;";
        return $this->obtenerResultados($sql);
    }

    public function obtenerIdEstiloEveto($nombre) {
        $sql = "SELECT id_estilo FROM estilos WHERE ds_estilo='$nombre';";
        return $this->obtenerResultados($sql)[0]['id_estilo'];
    }
}

?>
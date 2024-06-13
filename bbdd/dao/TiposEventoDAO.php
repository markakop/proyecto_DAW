<?php

include_once 'BaseDAO.php';

class TipoEventoDAO extends BaseDAO {
    
    public function obtenerTiposEvento() {
        $sql = "SELECT * FROM tipo_evento;";
        return $this->obtenerResultados($sql);
    }
}

?>
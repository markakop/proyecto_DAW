<?php

include_once 'BaseDAO.php';

class UsuariosDAO extends BaseDAO {
    
    public function login($username, $password) {
        $pass = md5($password);
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$username' AND pass='$pass'";
        return $this->obtenerResultados($sql);
    }

    public function insertarUsuario($email, $username, $password) {
        $pass = md5($password);
        $sql = "INSERT INTO usuarios (email, nombre_usuario, pass) VALUES ('$email', '$username', '$pass')";
        return $this->ejecutarConsulta($sql);
    }
}
?>

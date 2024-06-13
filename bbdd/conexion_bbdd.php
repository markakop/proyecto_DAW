<?php

include_once 'dao/EventosDAO.php';
include_once 'dao/UsuariosDAO.php';
include_once 'dao/ImagenesDAO.php';
include_once 'dao/ProvinciasDAO.php';
include_once 'dao/LocalidadesDAO.php';
include_once 'dao/DireccionesDAO.php';
include_once 'dao/EstilosDAO.php';
include_once 'dao/TiposEventoDAO.php';

class Consultas {

    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "root";
    private $dbname = "entranet";
    private $conn;

    //ClasesDAO
    private $eventoDAO;
    private $usuarioDAO;
    private $imagenDAO;
    private $provinciaDAO;
    private $localidadDAO;
    private $direccionDAO;
    private $estiloDAO;
    private $tipoDAO;

    // Constructor para conectar a la base de datos
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }

        $this->usuarioDAO = new UsuariosDAO($this->conn);
        $this->eventoDAO = new EventosDAO($this->conn);
        $this->imagenDAO = new ImagenesDAO($this->conn);
        $this->provinciaDAO = new ProvinciasDAO($this->conn);
        $this->localidadDAO = new LocalidadesDAO($this->conn);
        $this->direccionDAO = new DireccionesDAO($this->conn);
        $this->estiloDAO = new EstilosDAO($this->conn);
        $this->tipoDAO = new TipoEventoDAO($this->conn);
    }

    

    //Usuarios
    public function login($username, $password) {
        $result = $this->usuarioDAO->login($username, $password);
        return !empty($result);
    }

    public function insertarUsuario($email, $username, $password) {
        return $this->usuarioDAO->insertarUsuario($email, $username, $password);
    }

    //Eventos
    public function modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra) {
        return $this->eventoDAO->modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra);
    }

    public function borrarEvento($id) {
        return $this->eventoDAO->borrarEvento($id);
    }

    public function insertarEvento($evento) {
        $this->eventoDAO->insertarEvento($evento);
    }

    public function obtenerEventos() {
        return $this->eventoDAO->obtenerEventos();
    }

    public function obtenerEventosAdmin() {
        return $this->eventoDAO->obtenerEventosAdmin();
    }

    public function obtenerEventosFiltro($nombre = "", $fecha = "", $estilo = "", $tipo = "", $provincia = "") {
        return $this->eventoDAO->obtenerEventosFiltro($nombre,$fecha,$estilo,$tipo,$provincia);
    }

    public function obtenerEventoId($id) {
        return $this->eventoDAO->obtenerEventoId($id);
    }

    //Imagenes
    public function modificarImagen($id, $img_evento, $img_cartel) {
        return $this->imagenDAO->modificarImagen($id, $img_evento, $img_cartel);
    }

    public function insertarImagen($nombre, $url) {
        return $this->imagenDAO->insertarImagen($nombre,$url);
    }

    //Provincias
    public function obtenerProvincias() {
        return $this->provinciaDAO->obtenerProvincias();
    }

    //Localidades
    public function obtenerLocalidadesProvincia($idProvincia) {
        return $this->localidadDAO->obtenerLocalidadesProvincia($idProvincia);
    }

    public function comprobarLocalidad($localidad, $id_provincia) {
        return $this->localidadDAO->comprobarLocalidad($localidad, $id_provincia);
    }

    //Direcciones
    public function obtenerDirecciones() {
        return $this->direccionDAO->obtenerDirecciones();
    }

    public function comprobarDireccion($calle, $id_localidad) {
        return  $this->direccionDAO->comprobarDireccion($calle, $id_localidad);
    }

    //Estilos
    public function obtenerEstilos() {
        return $this->estiloDAO->obtenerEstilos();
    }

    public function obtenerIdEstiloEveto($nombre) {
        return $this->estiloDAO->obtenerIdEstiloEveto($nombre);
    }

    //Tipos de eventos
    public function obtenerTiposEvento() {
        return $this->tipoDAO->obtenerTiposEvento();
    }


    // Método para realizar una consulta y devolver los resultados
    /*private function obtenerResultados($sql)
    {
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

    // Método para ejecutar consultas que no devuelven resultados
    private function ejecutarConsulta($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Método para cerrar la conexión a la base de datos
    public function cerrarConexion() {
        $this->conn->close();
    }


    public function obtenerEstiloEvento($evento_nombre)
    {
        $sql = "SELECT e.id_evento id, e.nombre nombre, e.fecha fecha, e.precio precio, i.nombre nombre_img, es.ds_estilo estilo, i.url
                FROM eventos e 
                JOIN imagenes i ON e.imagen_buscador=i.id_imagen 
                JOIN estilos es ON e.id_estilo=es.id_estilo 
                WHERE es.ds_estilo='$evento_nombre'";
        return $this->obtenerResultados($sql);
    }*/
}

<?php

class Evento {

    private $nombre;
    private $direccion_id;
    private $precio;
    private $fecha;
    private $descripcion;
    private $imagen_buscador;
    private $imagen_cartel;
    private $url_compra;
    private $id_estilo;
    private $id_tipo_evento;
    private $activo;

    public function __construct($nombre, $direccion_id, $precio, $fecha, $descripcion, $imagen_buscador, $imagen_cartel, $url_compra, $id_estilo, $id_tipo_evento, $activo) {
        $this->nombre = $nombre;
        $this->direccion_id = $direccion_id;
        $this->precio = $precio;
        $this->fecha = new DateTime($fecha);
        $this->descripcion = $descripcion;
        $this->imagen_buscador = $imagen_buscador;
        $this->imagen_cartel = $imagen_cartel;
        $this->url_compra = $url_compra;
        $this->id_estilo = $id_estilo;
        $this->id_tipo_evento = $id_tipo_evento;
        $this->activo = $activo;
    }

    // Métodos getter
    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccionId() {
        return $this->direccion_id;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getImagenBuscador() {
        return $this->imagen_buscador;
    }

    public function getImagenCartel() {
        return $this->imagen_cartel;
    }

    public function getUrlCompra() {
        return $this->url_compra;
    }

    public function getIdEstilo() {
        return $this->id_estilo;
    }

    public function getIdTipoEvento() {
        return $this->id_tipo_evento;
    }

    public function isActivo() {
        return $this->activo === 'S';
    }

    // Métodos setter
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDireccionId($direccion_id) {
        $this->direccion_id = $direccion_id;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setFecha($fecha) {
        $this->fecha = new DateTime($fecha);
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setImagenBuscador($imagen_buscador) {
        $this->imagen_buscador = $imagen_buscador;
    }

    public function setImagenCartel($imagen_cartel) {
        $this->imagen_cartel = $imagen_cartel;
    }

    public function setUrlCompra($url_compra) {
        $this->url_compra = $url_compra;
    }

    public function setIdEstilo($id_estilo) {
        $this->id_estilo = $id_estilo;
    }

    public function setIdTipoEvento($id_tipo_evento) {
        $this->id_tipo_evento = $id_tipo_evento;
    }

    public function setActivo($activo) {
        if ($activo)
            $this->activo = "S";
        else 
            $this->activo = "N";
    }

    // Otros métodos relevantes
    public function isUpcoming() {
        $now = new DateTime();
        return $this->fecha > $now;
    }
}

?>

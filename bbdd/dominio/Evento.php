<?php

class Evento {

    public $nombre;
    public $direccion_id;
    public $precio;
    public $fecha;
    public $descripcion;
    public $imagen_buscador;
    public $imagen_cartel;
    public $url_compra;
    public $id_estilo;
    public $id_tipo_evento;
    public $activo;

    public function __construct($nombre, $direccion_id, $precio, $fecha, $descripcion, $imagen_buscador, $imagen_cartel, $url_compra, $id_estilo, $id_tipo_evento, $activo) {
        $this->nombre = $nombre;
        $this->direccion_id = $direccion_id;
        $this->precio = $precio;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->imagen_buscador = $imagen_buscador;
        $this->imagen_cartel = $imagen_cartel;
        $this->url_compra = $url_compra;
        $this->id_estilo = $id_estilo;
        $this->id_tipo_evento = $id_tipo_evento;
        $this->activo = $activo;
    }

}

?>

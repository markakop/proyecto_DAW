<?php
include 'conexion_bbdd.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consultas = new Consultas();
    
    
    $datosEvento = array(
        'nombre' => $_POST['event-name'],
        'direccion' => $_POST['event-name'],
        'precio' => $_POST['event-price'],
        'fecha' => $_POST['event-date'],
        'descripcion' => $_POST['event-name'],
        'imagen_evento' => $_POST['event-name'],
        'imagen_buscador' => $_POST['event-name'],
        'imagen_cartel' => $_POST['event-name'],
        'url_compra' => $_POST['event-name'],
        'estilo' => $_POST['event-name'],
    );

   
    if ($consultas->insertarEvento($datosEvento)) {
        echo "Evento insertado correctamente";
    } else {
        echo "Error al insertar el evento";
    }
    
    $consultas->cerrarConexion();
}
?>

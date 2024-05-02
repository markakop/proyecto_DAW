<?php
include 'conexion_bbdd.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consultas = new Consultas();
    
    
    $datosEvento = array(
        'nombre' => $_POST['event-name'],
        'precio' => $_POST['event-price'],
        'fecha' => $_POST['event-date'],
        'localizacion' => $_POST['event-location'],
        'url' => $_POST['event-url'],
        'imagen_url' => $_POST['event-image-url']
    );

   
    if ($consultas->insertarEvento($datosEvento)) {
        echo "Evento insertado correctamente";
    } else {
        echo "Error al insertar el evento";
    }
    
    $consultas->cerrarConexion();
}
?>

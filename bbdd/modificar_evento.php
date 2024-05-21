<?php
include '../bbdd/conexion_bbdd.php';
$eventos = new Consultas();
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nombre = $data['nombre'];
$precio = $data['precio'];
$fecha = $data['fecha'];
$activo = $data['activo'];
$url_compra = $data['url_compra'];


$result = $eventos->modificarEvento($id, $nombre, $precio, $fecha, $activo, $url_compra);

echo json_encode(['success' => $result]);
?>
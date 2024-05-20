<?php
include '../bbdd/conexion_bbdd.php';
$eventos = new Consultas();

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];

$result = $eventos->borrarEvento($id);

echo json_encode(['success' => $result]);
?>
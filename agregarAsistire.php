<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
	include 'bd/BD.php';
    $mysqli = acceder();

	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);       

	$idActividad= $dataObject-> idActividad;
	$idUsuario = $dataObject-> idUsuario;
	
	$idAsistire= '';

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$stmt = $mysqli->prepare("INSERT INTO asistire VALUES (?, ?, ?)");
$stmt->bind_param('iii', $idAsistire, $idActividad, $idUsuario);
$stmt->execute();

if ($stmt->affected_rows > 0) {
	echo json_encode(array('Guardado'=>true, 'Mensaje' => 'El asistire se guardo con exito.'));
} else {
	echo json_encode(array('Guardado'=>false, 'Mensaje' => 'El asistire no se pudo guardar.')); 
}
$stmt->close();

$mysqli->close();
	
?>
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
	include 'bd/BD.php';
    $mysqli = acceder();

	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);       

	$idU = $dataObject-> userID;
	$telefono =	$dataObject-> telefono;
	$diasdisponibles =	$dataObject-> dias;
	$tipoapoyo = $dataObject-> tipo;
	$motivacion = $dataObject-> descripcion;

	$idVol= '';	
	$imagen='';

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$stmt = $mysqli->prepare("INSERT INTO voluntarios VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('iisssss', $idVol, $idU, $telefono, $diasdisponibles, $tipoapoyo, $motivacion, $imagen);
$stmt->execute();

if ($stmt->affected_rows > 0) {
	echo json_encode(array('Guardado'=>true, 'Mensaje' => 'Voluntario registrado con exito.'));
} else {
	echo json_encode(array('Guardado'=>false, 'Mensaje' => 'No se pudo registrar al voluntario.')); 
}
$stmt->close();

$mysqli->close();
	
?>
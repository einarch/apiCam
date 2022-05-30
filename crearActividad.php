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
	$actividad = $dataObject-> nombre;
	$fechahora = $dataObject-> fechaHora;
	$ubicacion = $dataObject-> ubicacion;
	$descripcion = $dataObject-> descripcion;
	$imagen=$dataObject-> imagen;

	$idAct= ''; 
	$contadorAsistire=0;
	$existe="false";

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$stmt = $mysqli->prepare("INSERT INTO actividades VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('iisssssis', $idAct, $idU, $actividad, $fechahora, $ubicacion, $descripcion, $imagen, $contadorAsistire, $existe);
$stmt->execute();

if ($stmt->affected_rows > 0) {
	echo json_encode(array('Guardado'=>true, 'Mensaje' => 'Actividad guardada con exito.'));
} else {
	echo json_encode(array('Guardado'=>false, 'Mensaje' => 'No se pudo guardar la actividad.')); 
}
$stmt->close();

$mysqli->close();
	
?>
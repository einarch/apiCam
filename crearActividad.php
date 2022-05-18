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
	$descripcion =	$dataObject-> descripcion;
	
	$idAct= '';	

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$stmt = $mysqli->prepare("INSERT INTO actividades VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('iiss', $idAct, $idU, $actividad, $fechahora, $ubicacion, $descripcion);
$stmt->execute();

if ($stmt->affected_rows > 0) {
	echo json_encode(array('Guardado'=>true, 'Mensaje' => 'La publicacion se guardo con exito.'));
} else {
	echo json_encode(array('Guardado'=>false, 'Mensaje' => 'La publicacion no se pudo guardar.')); 
}
$stmt->close();

$mysqli->close();
	
?>
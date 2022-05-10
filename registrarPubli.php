<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
	include 'bd/BD.php';
    $mysqli = acceder();

	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);       

	    
	$idU = $dataObject-> idUs;
	$descripcion =	$dataObject-> descripcion;
	
	
	$fechahora= $dataObject-> fecha;
	$idPub= '';	

	

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$stmt = $mysqli->prepare("INSERT INTO publicaciones (IDPUB, IDUSUARIO, FECHAHORAP, DESCRIPCIONP) VALUES (?, ?, ?, ?)");
$stmt->bind_param('iiss', $idPub, $idU, $fechahora, $descripcion);
$stmt->execute();
$resultado = $stmt->get_result();

if ($stmt->affected_rows > 0) {
	echo json_encode(array('guardado'=>true, 'mensaje' => 'La publicacion se guardo con exito.'));
} else {
	echo json_encode(array('guardado'=>false, 'mensaje' => 'La publicacion no se pudo guardar.')); 
}
$stmt->close();

$mysqli->close();
	
?>
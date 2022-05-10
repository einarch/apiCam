<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
	include 'bd/BD.php';
    $conn = acceder();

	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);       

	    
	$idU = $dataObject-> idUs;
	$descripcion =	$dataObject-> descripcion;
	
	
	$fechahora= $dataObject-> fecha;
	$idPub= 0;	

	

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO publicaciones (IDPUB, IDUSUARIO, FECHAHORAP, DESCRIPCIONP) VALUES ('$idPub', '$idU', '$fechahora', '$descripcion')";

if ($conn->query($sql) === TRUE) {
	echo json_encode(array('guardado'=>true, 'mensaje' => 'La publicacion se guardo con exito.'));
} else {
	echo json_encode(array('conectado'=>false, 'error' => "Error: " . $sql . "<br>" . $conn->error, 'mensaje' => 'La publicacion no se pudo guardar.')); 
}

$conn->close();
	
?>
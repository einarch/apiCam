<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
    include 'bd/BD.php';
    $mysqli = acceder();
    //sleep(1);	
	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);        

	    
	$idPublicacion= $dataObject-> idPublicacion;
    $meGusta =	$dataObject-> mGusta;
	

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
      }

    $stmt = $mysqli->prepare("UPDATE publicaciones SET CONTADORLIKE=? WHERE IDPUB=?");
  
    $stmt->bind_param ('ii', $idPublicacion, $meGusta);
    $stmt->execute();
                  
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('Guardado'=>true, 'Mensaje' => 'Se actualizo los me gusta con exito.'));
    } else {
        echo json_encode(array('Guardado'=>false, 'Mensaje' => 'No se pudo actualizar los me gusta.')); 
    }
    $stmt->close();
    
  $mysqli->close();
  ?>
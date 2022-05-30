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

	    
	$idActividad= $dataObject-> idActividad;
    $asistire =	$dataObject-> asistire;
    $existe = $dataObject-> existe;
	

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
      }

    $stmt = $mysqli->prepare("UPDATE actividades SET CONTADORASISTIRE=?, EXISTE=? WHERE IDACT=?");
  
    $stmt->bind_param ('isi', $asistire, $existe, $idActividad);
    $stmt->execute();
                  
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('Guardado'=>true, 'Mensaje' => 'Se actualizo los asistire con exito.'));
    } else {
        echo json_encode(array('Guardado'=>false, 'Mensaje' => 'No se pudo actualizar los asistire.')); 
    }
    $stmt->close();
    
  $mysqli->close();
  ?>
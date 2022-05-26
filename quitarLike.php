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

	    
	$idPublicacion = $dataObject-> idPublicacion;
	$idUsuario = $dataObject-> idUsuario;
	

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
      }

    $stmt = $mysqli->prepare("DELETE FROM likes WHERE IDPUB=? AND IDUSUARIO=?");
  
    $stmt->bind_param ('ii',$idPublicacion, $idUsuario);
    $stmt->execute();
                  
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('Eliminado'=>true, 'Mensaje' => 'Se elimino el me gusta con exito.'));
    } else {
        echo json_encode(array('Guardado'=>false, 'Mensaje' => 'No se pudo eliminar el me gusta.')); 
    }
    $stmt->close();
    
  $mysqli->close();
  ?>
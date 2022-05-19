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

	    
	$pas =	$dataObject-> clave;
	$idUsuario= $dataObject-> idUsuario;
	$clave = password_hash($pas, PASSWORD_DEFAULT);
	

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
      }

    $stmt = $mysqli->prepare("UPDATE usuarios SET PASSWORD=? WHERE IDUSUARIO=?");
  
    $stmt->bind_param ('si',$clave, $idUsuario);
    $stmt->execute();
                  
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('Guardado'=>true, 'Mensaje' => 'Se actualizo la contraseña con exito.'));
    } else {
        echo json_encode(array('Guardado'=>false, 'Mensaje' => 'No se pudo actualizar la contraseña.')); 
    }
    $stmt->close();
    
  $mysqli->close();
  ?>
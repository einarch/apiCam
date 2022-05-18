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

	    
	$usuario = $dataObject-> usuario;
	$pas =	$dataObject-> clave;
	$nombre= $dataObject-> nombre;
	$apellidos= $dataObject-> apellido;
	$idUsuario= '';
    $idRol= $dataObject-> idRol;
    $fecha= $dataObject-> fechaNacimiento;
    $edad= $dataObject-> edad;
    $ciudad= $dataObject-> ciudad;
	$clave = password_hash($pas, PASSWORD_DEFAULT);
	


    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
      }

    $stmt = $mysqli->prepare("INSERT INTO usuarios (IDUSUARIO, IDROL, NOMBRE, APELLIDO, FECHANAC, EDAD, CIUDAD, EMAIL, PASSWORD) VALUES (?,?,?,?,?,?,?,?,?)");
  
    $stmt->bind_param ('iisssisss',$idUsuario,$idRol,$nombre,$apellidos,$fecha,$edad,$ciudad,$usuario,$clave);
    $stmt->execute();
                  
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('Guardado'=>true, 'Mensaje' => 'El usuario se registro con exito.'));
    } else {
        echo json_encode(array('Guardado'=>false, 'Mensaje' => 'El usuario no se pudo registrar.')); 
    }
    $stmt->close();
    
  $mysqli->close();
  ?>
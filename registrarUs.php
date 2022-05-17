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
    $mysqli->set_charset('utf8');
	    
	$usuario = $dataObject-> usuario;
	$pas =	$dataObject-> clave;
	$nombre= $dataObject-> nombre;
	$apellidos= $dataObject-> apellidos;
	$idUsuario= $dataObject-> idUsuario;
    $idRol= $dataObject-> idRol;
    $fecha= $dataObject-> fechaNacimiento;
    $edad= $dataObject-> edad;
    $ciudad= $dataObject-> ciudad;
	$clave = password_hash($pas, PASSWORD_DEFAULT);
	

	echo $pas;
	echo "<br/>";
	echo $clave;
	echo "<hr/>";


    if ($buscar = $mysqli->prepare("SELECT 
    usuarios.IDUSUARIO, usuarios.IDROL, usuarios.NOMBRE, usuarios.APELLIDO, usuarios.FECHANAC, usuarios.EDAD, usuarios.CIUDAD, usuarios.EMAIL, usuarios.PASSWORD, roles.ROL 
    FROM usuarios 
    INNER JOIN roles ON usuarios.IDROL = roles.IDROL
    WHERE EMAIL = ?")) {
          $buscar->bind_param('s', $usuario);
          $buscar->execute();
          $resultado = $buscar->get_result();
          if ($resultado->num_rows == 1) {
              $datos = $resultado->fetch_assoc();
                  echo json_encode(array('Guardado'=>false, 'Mensaje' => 'Ya existe una cuenta registrada con el EMAIL introducido.', 'CONECTADO'=>false, 'IDUSUARIO'=>$datos['IDUSUARIO'], 'IDROL'=>$datos['IDROL'], 'ROL'=>$datos['ROL'], 'EMAIL'=>$datos['EMAIL'], 'NOMBRE'=>$datos['NOMBRE'], 'APELLIDOS'=>$datos['APELLIDO'], 'FECHA NACIMIENTO'=>$datos['FECHANAC'], 'EDAD'=>$datos['EDAD'], 'CIUDAD'=>$datos['CIUDAD'] ) );
                }
  
                 else {
  
                  $stmt = $mysqli->prepare("INSERT INTO usuarios (IDUSUARIO, IDROL, NOMBRE, APELLIDO, FECHANAC, EDAD, CIUDAD, EMAIL, PASSWORD) VALUES (?,?,?,?,?,?,?,?,?)");
  
                  $stmt->bind_param ('iisssisss',$idUsuario,$idRol,$nombre,$apellidos,$fecha,$edad,$ciudad,$usuario,$clave);
                  $stmt->execute();
                  
                  if ($stmt->affected_rows > 0) {
                      session_start();
                      echo json_encode(array('Guardado'=>true, 'Mensaje' => 'El usuario se registro con exito.'));
                  } else {
                      echo json_encode(array('Guardado'=>false, 'Mensaje' => 'El usuario no se pudo registrar.')); 
                  }
                  $stmt->close();
                      }
          
          $buscar->close();
        }
        else{
          echo json_encode(array('Conectado'=>false, 'error' => 'No se pudo conectar a BD'));
        }
   // }
  $mysqli->close();
  ?>
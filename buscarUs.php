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
    session_start();    
    $mysqli->set_charset('utf8');
	    
	$usuario = $dataObject-> usuario;
    
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
                  echo json_encode(array('Existe'=>true, 'Mensaje' => 'Ya existe una cuenta registrada con el EMAIL introducido.', 'CONECTADO'=>false, 'IDUSUARIO'=>$datos['IDUSUARIO'], 'IDROL'=>$datos['IDROL'], 'ROL'=>$datos['ROL'], 'EMAIL'=>$datos['EMAIL'], 'NOMBRE'=>$datos['NOMBRE'], 'APELLIDOS'=>$datos['APELLIDO'], 'FECHANACIMIENTO'=>$datos['FECHANAC'], 'EDAD'=>$datos['EDAD'], 'CIUDAD'=>$datos['CIUDAD'] ) );
                }
                 else {
                      echo json_encode(array('Existe'=>false, 'Mensaje' => 'Los datos introducidos no pertenecen a una cuenta.')); 
                  }
                      
          $buscar->close();
        }
        else{
          echo json_encode(array('Conectado'=>false, 'Mensaje' => 'No se pudo conectar a BD'));
        }
   // }
  $mysqli->close();
  ?>
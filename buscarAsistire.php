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
	    
	$usuario = $dataObject-> idUsuario;
    $actividad= $dataObject-> idActividad;
    

    if ($buscar = $mysqli->prepare("SELECT asistire.IDASISTIRE, asistire.IDACT, asistire.IDUSUARIO 
    FROM asistire 
    WHERE IDUSUARIO = ? AND IDACT = ?")) {
          $buscar->bind_param('ii', $usuario, $actividad);
          $buscar->execute();
          $resultado = $buscar->get_result();
          if ($resultado->num_rows == 1) {
              $datos = $resultado->fetch_assoc();
                  echo json_encode(array('Existe'=>true, 'Mensaje' => 'El usuario asistira a la actividad.', 'IDASISTIRE'=>$datos['IDASISTIRE'], 'IDACT'=>$datos['IDACT'], 'IDUSUARIO'=>$datos['IDUSUARIO'] ) );
                }
                 else {
                      echo json_encode(array('Existe'=>false, 'Mensaje' => 'El usuario no asistira a la actividad.')); 
                  }
                      
          $buscar->close();
        }
        else{
          echo json_encode(array('Conectado'=>false, 'Mensaje' => 'No se pudo conectar a BD'));
        }
   // }
  $mysqli->close();
  ?>
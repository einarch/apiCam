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
	    
	$usuario = $dataObject-> idUsuario;
    $publicacion=$dataObject-> idPublicacion;
    

    if ($buscar = $mysqli->prepare("SELECT likes.IDLIKE, likes.IDPUB, likes.IDUSUARIO 
    FROM likes 
    WHERE IDUSUARIO = ? AND IDPUB = ?")) {
          $buscar->bind_param('ii', $usuario, $publicacion);
          $buscar->execute();
          $resultado = $buscar->get_result();
          if ($resultado->num_rows == 1) {
              $datos = $resultado->fetch_assoc();
                  echo json_encode(array('Existe'=>true, 'Mensaje' => 'Hay un like del usuario en la publicacion.', 'IDLIKE'=>$datos['IDLIKE'], 'IDPUB'=>$datos['IDPUB'], 'IDUSUARIO'=>$datos['IDUSUARIO'] ) );
                }
                 else {
                      echo json_encode(array('Existe'=>false, 'Mensaje' => 'No hay un like del usuario en la publicacion.')); 
                  }
                      
          $buscar->close();
        }
        else{
          echo json_encode(array('Conectado'=>false, 'Mensaje' => 'No se pudo conectar a BD'));
        }
   // }
  $mysqli->close();
  ?>
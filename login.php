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
	$pas =	$dataObject-> clave;
    
  if ($nueva_consulta = $mysqli->prepare("SELECT 
  usuarios.NOMBRE, usuarios.PASSWORD, usuarios.APELLIDO, usuarios.EMAIL, usuarios.IDROL, usuarios.IDUSUARIO, roles.ROL 
  FROM usuarios 
  INNER JOIN roles ON usuarios.IDROL = roles.IDROL
  WHERE EMAIL = ?")) {
        $nueva_consulta->bind_param('s', $usuario);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_assoc();
             $encriptado_db = $datos['PASSWORD'];
            if (password_verify($pas, $encriptado_db))
            {
                $_SESSION['EMAIL'] = $datos['EMAIL'];
                echo json_encode(array('conectado'=>true,'EMAIL'=>$datos['EMAIL'], 'NOMBRE'=>$datos['NOMBRE'],  'APELLIDO'=>$datos['APELLIDO'], 'IDUSUARIO'=>$datos['IDUSUARIO'], 'IDROL'=>$datos['IDROL'], 'ROL'=>$datos['ROL']  ) );
              }

               else {

                 echo json_encode(array('conectado'=>false, 'Existe'=>true, 'error' => 'La clave es incorrecta, vuelva a intentarlo.'));
                    }
        }
        else {
              echo json_encode(array('conectado'=>false, 'Existe'=>false, 'error' => 'El usuario no existe.'));
        }
        $nueva_consulta->close();
      }
      else{
        echo json_encode(array('conectado'=>false, 'error' => 'No se pudo conectar a BD'));
      }
 // }
$mysqli->close();
?>
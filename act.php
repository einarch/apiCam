<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="SELECT * FROM actividades WHERE id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT actividades.IDACT, usuarios.NOMBRE, usuarios.APELLIDO, actividades.ACTIVIDAD, actividades.FECHAHORAA, actividades.UBICACIONA, actividades.DESCRIPCIONA, actividades.IMAGENA, actividades.CONTADORASISTIRE 
        FROM usuarios 
        INNER JOIN actividades ON usuarios.IDUSUARIO = actividades.IDUSUARIO ORDER BY IDACT DESC;";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");

?>
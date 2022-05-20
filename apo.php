<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="SELECT * FROM voluntarios WHERE id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT usuarios.NOMBRE, usuarios.APELLIDO, usuarios.CIUDAD, voluntarios.TELEFONOV, voluntarios.DIASDISPONIBLES, voluntarios.TIPOAPOYO, voluntarios.DESCRIPCIONV, voluntarios.IMAGENV
        FROM usuarios 
        INNER JOIN voluntarios ON usuarios.IDUSUARIO = voluntarios.IDUSUARIO ORDER BY IDVOL DESC;";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}



header("HTTP/1.1 400 Bad Request");


?>
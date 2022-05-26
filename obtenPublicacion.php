<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: access");


if($_SERVER['REQUEST_METHOD']=='GET'){

    $query="SELECT publicaciones.IDPUB, usuarios.NOMBRE, usuarios.APELLIDO, publicaciones.FECHAHORAP, publicaciones.DESCRIPCIONP, publicaciones.IMAGENP, publicaciones.CONTADORLIKE 
    FROM usuarios 
    INNER JOIN publicaciones ON usuarios.IDUSUARIO = publicaciones.IDUSUARIO WHERE IDPUB=".$_GET['IDPUB'];
    $resultado=metodoGet($query);
    echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));

    header("HTTP/1.1 200 OK");
    exit();
}


header("HTTP/1.1 400 Bad Request");


?>
<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="SELECT * FROM publicaciones WHERE id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT usuarios.NOMBRE, usuarios.APELLIDO, publicaciones.FECHAHORAP, publicaciones.DESCRIPCIONP, publicaciones.IMAGENP 
        FROM usuarios 
        INNER JOIN publicaciones ON usuarios.IDUSUARIO = publicaciones.IDUSUARIO ORDER BY IDPUB DESC;";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");

?>
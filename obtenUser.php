<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: access");


if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['IDUSUARIO'])){
        $query="SELECT * FROM usuarios WHERE IDUSUARIO=".$_GET['IDUSUARIO'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM usuarios";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}


header("HTTP/1.1 400 Bad Request");


?>
<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="SELECT * FROM publicaciones WHERE id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT usuarios.NOMBRE, usuarios.APELLIDO, publicaciones.FECHAHORAP, publicaciones.DESCRIPCIONP 
        FROM usuarios 
        INNER JOIN publicaciones ON usuarios.IDUSUARIO = publicaciones.IDUSUARIO ORDER BY IDPUB DESC;";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $decripcionp=$_POST['DESCRIPCIONP'];
    //$lanzamiento=$_POST['lanzamiento'];
    //$desarrollador=$_POST['desarrollador'];
    $query="INSERT INTO publicaciones(DESCRIPCIONP) values ('$descripcionp')";
    $queryAutoIncrement="SELECT MAX(IDPUB) AS IDPUB FROM publicaciones";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>
<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: access");


if($_SERVER['REQUEST_METHOD']=='GET'){

        $query="SELECT * FROM publicaciones WHERE IDPUB=".$_GET['IDPUB'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));

    header("HTTP/1.1 200 OK");
    exit();
}


header("HTTP/1.1 400 Bad Request");


?>
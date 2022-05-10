<?php
$pdo=null;
$host="bw7puuwzqhjsk8npasa3-mysql.services.clever-cloud.com";
$user="uelajbin1aaej3i4";
$password="8nc160YzpZ1TkpC78tcF";
$bd="bw7puuwzqhjsk8npasa3";

function conectar(){
    try{
        $GLOBALS['pdo']=new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['bd']."", $GLOBALS['user'], $GLOBALS['password']);
        $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        print "Error!: No se pudo conectar a la bd ".$bd."<br/>";
        print "\nError!: ".$e."<br/>";
        die();
    }
}

function desconectar() {
    $GLOBALS['pdo']=null;
}

function acceder(){
    $servidor = "bw7puuwzqhjsk8npasa3-mysql.services.clever-cloud.com";
    $usuario = "uelajbin1aaej3i4";
    $password = "8nc160YzpZ1TkpC78tcF";
    $bd = "bw7puuwzqhjsk8npasa3";
  //$bd = "cajaherr_datos";
  

    $conexion = mysqli_connect($servidor, $usuario, $password,$bd);


    if($conexion){
        echo "";
    }else{
        echo 'Ha sucedido un error inesperado en la conexion de la base de datos
            ';
    }

return $conexion;
}

function metodoGet($query){
    try{
        conectar();
        $sentencia=$GLOBALS['pdo']->prepare($query);
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        desconectar();
        return $sentencia;
    }catch(Exception $e){
        die("Error: ".$e);
    }
}

?>
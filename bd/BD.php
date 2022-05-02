<?php
$pdo=null;
$host="us-cdbr-east-05.cleardb.net";
$user="b8906202f3a196";
$password="e91cbdf0";
$bd="heroku_0494613bdc93d34";

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
  $servidor = "us-cdbr-east-05.cleardb.net";
  $usuario = "b8906202f3a196";
  $password = "e91cbdf0";
  $bd = "heroku_0494613bdc93d34";
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
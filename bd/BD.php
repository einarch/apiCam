<?php
$pdo=null;
$host="bmlx3df4ma7r1yh4.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user="r437tl8qedcbzcd1";
$password="p803swh86g7fpsxh";
$bd="u3xy3m9pnoua2hbn";

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
  $servidor = "bmlx3df4ma7r1yh4.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  $usuario = "r437tl8qedcbzcd1";
  $password = "p803swh86g7fpsxh";
  $bd = "u3xy3m9pnoua2hbn";
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
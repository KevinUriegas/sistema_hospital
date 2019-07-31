<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$idArea   = $_POST["idArea"];
$nombre   = $_POST["nombre"];

$nombre   = trim($nombre);

mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_consultorio FROM consultorios WHERE id_area = '$idArea' AND nombre = '$nombre'",$conexion)or die(mysql_error());
$existe = mysql_num_rows($verificar);

if($existe == 0){
    $insertar = mysql_query("INSERT INTO consultorios 
                        ( 
                        id_area, 
                        nombre,
                        id_registro, 
                        fecha_registro, 
                        hora_registro,
                        activo
                        ) 
                        VALUES('$idArea', '$nombre', '$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());
                        echo "ok";
}else{
    echo "duplicado";
}


?>
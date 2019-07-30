<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$idArea   = $_POST["idArea"];
$nombre   = $_POST["nombre"];

$idArea   = trim($idArea);
$nombre   = trim($nombre);
// $contra    = trim($contra);

$fecha = date("Y-m-d"); 
$hora  = date ("H:i:s");

mysql_query("SET NAMES utf8");
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

?>
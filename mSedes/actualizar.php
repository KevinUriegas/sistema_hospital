<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre    = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono  = $_POST["telefono"];
$ide       = $_POST["ide"];

$nombre    =trim($nombre);
$direccion =trim($direccion);
$telefono  =trim($telefono);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE sedes SET
							nombre='$nombre',
							direccion='$direccion',
							telefono='$telefono',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='$id_usuario'
						WHERE id_sede='$ide'
							 ",$conexion)or die(mysql_error());

?>
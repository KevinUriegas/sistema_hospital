<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$nombre    = $_POST["nombre"];
$ide       = $_POST["ide"];

$nombre    =trim($nombre);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE tipo_trabajadores SET
							nombre='$nombre',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_tipo_trabajador='$ide'
							 ",$conexion)or die(mysql_error());

?>
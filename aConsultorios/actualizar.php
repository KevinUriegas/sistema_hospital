<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$nombre = $_POST["nombre"];
$id_area = $_POST['id_area'];
$ide     = $_POST["ide"];

$nombre = trim($nombre);

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE consultorios SET
							nombre='$nombre',
							id_area='$id_area',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_consultorio='$ide'
							 ",$conexion)or die(mysql_error());

?>
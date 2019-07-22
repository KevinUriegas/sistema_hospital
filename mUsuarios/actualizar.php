<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$usuario = $_POST["usuario"];
$ide     = $_POST["ide"];

$usuario = trim($usuario);

$fecha   = date("Y-m-d"); 
$hora    = date ("H: i: s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE usuarios SET
							usuario='$usuario',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_usuario='$ide'
							 ",$conexion)or die(mysql_error());

?>
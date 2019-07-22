<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario   = $_SESSION["idUsuario"];

$nombre_areaE = $_POST["nombre_areaE"];
$ide          = $_POST["ide"];

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE areas SET
							nombre='$nombre_areaE',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='$id_usuario'
						WHERE id_area='$ide'
							 ",$conexion)or die(mysql_error());

?>
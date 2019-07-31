<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$valor = $_POST["valor"];
$id    = $_POST["id"];

$valor =($valor==1)?0:1;

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE consultorios SET
							activo='$valor',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_consultorio='$id'
							 ",$conexion)or die(mysql_error());

?>
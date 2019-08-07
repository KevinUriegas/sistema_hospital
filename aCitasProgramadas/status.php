<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$valor = $_POST["valor"];
$id    = $_POST["id"];

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE citas SET
							activo='$valor',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='$id_usuario'
						WHERE id_cita='$id'
							 ",$conexion)or die(mysql_error());

?>
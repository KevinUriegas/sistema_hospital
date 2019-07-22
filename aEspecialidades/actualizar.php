<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario           = $_SESSION["idUsuario"];

$nombre_especialidadE = $_POST["nombre_especialidadE"];
$ide                  = $_POST["ide"];

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE especialidades SET
							nombre='$nombre_especialidadE',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='$id_usuario'
						WHERE id_especialidad='$ide'
							 ",$conexion)or die(mysql_error());

?>
<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre_especialidad = $_POST["nombre_especialidad"];

mysql_query("SET NAMES utf8");
$insertar = mysql_query("INSERT INTO especialidades ( nombre, id_registro, fecha_registro, hora_registro, activo)
 VALUES('$nombre_especialidad','$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());

?>
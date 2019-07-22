<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre_area = $_POST["nombre_area"];

mysql_query("SET NAMES utf8");
$insertar = mysql_query("INSERT INTO areas ( nombre, id_registro, fecha_registro, hora_registro, activo)
 VALUES('$nombre_area','$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());

?>
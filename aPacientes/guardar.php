<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre_especialidad = $_POST["nombre_especialidad"];

mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_especialidad FROM especialidades WHERE nombre = '$nombre_especialidad'",$conexion)or die(mysql_error());
$existe = mysql_num_rows($verificar);
if($existe == 0){
    $insertar = mysql_query("INSERT INTO especialidades ( nombre, id_registro, fecha_registro, hora_registro, activo)
 VALUES('$nombre_especialidad','$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());
 echo "ok";
}else{
    echo "duplicado";
}
?>
<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$id_cita        = $_POST["id_cita"];
$cantidad       = $_POST["cantidad"];
$comentario     = $_POST["comentario"];
$id_medicamento = $_POST["id_medicamento"];
$id_receta      = $_POST["id_receta"];


mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_detalle FROM detalle_receta WHERE id_receta = '$id_receta' AND id_medicamento = '$id_medicamento' AND activo = '1'",$conexion)or die(mysql_error());
$existe = mysql_num_rows($verificar);
if($existe == 0){
    $insertar = mysql_query("INSERT INTO detalle_receta ( id_receta, id_medicamento, cantidad, comentario,id_registro, fecha_registro, hora_registro,activo)
 VALUES('$id_receta','$id_medicamento','$cantidad','$comentario','$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());
 echo "ok";
}else{
    echo "duplicado";
}
?>
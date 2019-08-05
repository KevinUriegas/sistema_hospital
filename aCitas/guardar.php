<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$id_paciente    = $_POST["id_paciente"];
$id_consultorio = $_POST["id_consultorio"];
$fecha_consulta = $_POST["fecha"];
$hora_consulta  = $_POST["hora"];

$hora_mas = strtotime ( '+1 hour' , strtotime ($fecha_consulta.' '.$hora_consulta) ) ; 
$hora_mas = date ( 'Y-m-d H:i:s' , $hora_mas); 

$horaF = substr($hora_mas,10,9);

mysql_query("SET NAMES utf8");
// $vericar_disp = "SELECT id_cita FROM citas WHERE fecha = '$fecha_consulta' AND ";
$verificar_dupli = mysql_query("SELECT id_cita FROM citas WHERE id_paciente = '$id_paciente' AND fecha_cita = '$fecha_consulta'",$conexion)or die(mysql_error());
$ver_dupli = mysql_num_rows($verificar_dupli);
if($ver_dupli == 0){
    $insertar = mysql_query("INSERT INTO citas ( id_paciente, id_consultorio, fecha_cita, hora_cita, hora_cita_fin, id_registro, fecha_registro, hora_registro, activo)
 VALUES('$id_paciente','$id_consultorio','$fecha_consulta','$hora_consulta','$horaF','$id_usuario','$fecha', '$hora','1')",$conexion)or die(mysql_error());
    echo "ok";
}else{
    echo "duplicado";
}

?>
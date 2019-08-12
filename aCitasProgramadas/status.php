<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$valor = $_POST["valor"];
$id    = $_POST["id"];

mysql_query("SET NAMES utf8");

$verificar_hora = mysql_query("SELECT SEC_TO_TIME(TIME_TO_SEC(hora_cita) - TIME_TO_SEC(CURRENT_TIME())), (SELECT CONCAT(personas.nombre,' ', personas.ap_paterno,' ',personas.ap_materno) FROM pacientes INNER JOIN personas ON personas.id_persona = pacientes.id_persona WHERE pacientes.id_paciente = citas.id_paciente),citas.id_paciente FROM citas WHERE id_cita = '$id'",$conexion);
$row_verificar = mysql_fetch_array($verificar_hora);
$diferencia  = $row_verificar[0];
$nombre      = $row_verificar[1];
$id_paciente = $row_verificar[2];
if($diferencia >= '00:15:00'){
	$mensaje = "ok";
	$insertar = mysql_query("UPDATE citas SET
								activo='$valor',
								fecha_registro='$fecha',
								hora_registro='$hora',
								id_registro='$id_usuario'
							WHERE id_cita='$id'
								 ",$conexion)or die(mysql_error());
}else{
	$mensaje = "late";
}
$array = array($mensaje,$nombre,$id_paciente);
echo json_encode($array);

?>
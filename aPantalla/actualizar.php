<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario   = $_SESSION["idUsuario"];

$id_consultorioE = $_POST["id_consultorioE"];
$fechaE          = $_POST["fechaE"];
$horaE           = $_POST["horaE"];
$ide             = $_POST["ide"];

$hora_mas = strtotime ( '+1 hour' , strtotime ($fechaE.' '.$horaE) ) ; 
$hora_mas = date ( 'Y-m-d H:i:s' , $hora_mas); 

$horaF = substr($hora_mas,10,9);

mysql_query("SET NAMES utf8");
$insertar = mysql_query("UPDATE citas SET
							id_consultorio='$id_consultorioE',
							fecha_cita='$fechaE',
							hora_cita='$horaE',
							hora_cita_fin='$horaF',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='$id_usuario'
						WHERE id_cita='$ide'",$conexion)or die(mysql_error());
echo "ok";

?>
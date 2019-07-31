<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre    = $_POST["nombre"];

$nombre    =trim($nombre);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_tipo_trabajador FROM tipo_trabajadores 
				WHERE nombre = '$nombre'",$conexion);

//Verifica si el registro Existe
$existe = mysql_num_rows($verificar);
if($existe == 0){
				
	$insertar = mysql_query("INSERT INTO tipo_trabajadores 
		(
		nombre,
		id_registro,
		fecha_registro,
		hora_registro,
		activo
		)
	VALUES
	(
		'$nombre',
		'$id_usuario',
		'$fecha',
		'$hora',
		'1'
	)
	",$conexion)or die(mysql_error());
	echo "ok";
}else{
	echo "duplicado";
}
?>
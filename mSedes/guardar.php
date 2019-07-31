<?php
//se manda llamar la conexion
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

$nombre    = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono  = $_POST["telefono"];

$nombre    =trim($nombre);
$direccion =trim($direccion);
$telefono  =trim($telefono);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_sede FROM sedes 
				WHERE nombre = '$nombre'",$conexion);

//Verifica si el registro Existe
$existe = mysql_num_rows($verificar);
if($existe == 0){
				
	$insertar = mysql_query("INSERT INTO sedes 
		(
		nombre,
		direccion,
		telefono,
		id_registro,
		fecha_registro,
		hora_registro,
		activo
		)
	VALUES
	(
		'$nombre',
		'$direccion',
		'$telefono',
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
<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$nombre    = $_POST["nombre"];
$paterno   = $_POST["paterno"];
$materno   = $_POST["materno"];
$direccion = $_POST["direccion"];
$telefono  = $_POST["telefono"];
$correo    = $_POST["correo"];
$tipo      = $_POST["tipo"];
$sexo      = $_POST["sexo"];
$fecha_nac = $_POST["fecha_nac"];

$nombre    =trim($nombre);
$paterno   =trim($paterno);
$materno   =trim($materno);
$direccion =trim($direccion);
$telefono  =trim($telefono);
$correo    =trim($correo);
$tipo      =trim($tipo);
$sexo      =trim($sexo);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
$verificar = mysql_query("SELECT id_persona FROM personas 
				WHERE nombre = '$nombre' 
				AND ap_paterno = '$paterno'
				AND ap_materno = '$materno'",$conexion);

//Verifica si el registro Existe
$existe = mysql_num_rows($verificar);
if($existe == 0){
				
	$insertar = mysql_query("INSERT INTO personas 
		(
		nombre,
		ap_paterno,
		ap_materno,
		sexo,
		direccion,
		telefono,
		fecha_nacimiento,
		correo,
		tipo_persona,
		id_registro,
		fecha_registro,
		hora_registro,
		activo
		)
	VALUES
	(
		'$nombre',
		'$paterno',
		'$materno',
		'$sexo',
		'$direccion',
		'$telefono',
		'$fecha_nac',
		'$correo',
		'$tipo',
		'1',
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
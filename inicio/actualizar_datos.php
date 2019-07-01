<?php
	include '../sesiones/verificar_sesion.php';

	$id_persona = $_SESSION["idPersona"];

	$nombre    = $_POST['nombre'];
	$paterno   = $_POST['paterno'];
	$materno   = $_POST['materno'];
	$direccion = $_POST['direccion'];
	$sexo      = $_POST['sexo'];
	$telefono  = $_POST['telefono'];
	$fecha_nac = $_POST['fecha_nac'];
	$correo    = $_POST['correo'];
	$tipo      = $_POST['tipo'];

	$cadena = mysql_query("UPDATE personas SET nombre = '$nombre', ap_paterno = '$paterno', ap_materno = '$materno', sexo = '$sexo', direccion = '$direccion', telefono = '$telefono', fecha_nacimiento = '$fecha_nac', correo = '$correo', tipo_persona = '$tipo' WHERE id_persona = '$id_persona'",$conexion);
	echo "ok";

?>
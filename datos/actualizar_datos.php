<?php
	include '../sesiones/verificar_sesion.php';

	$id_persona = $_SESSION["idPersona"];
	$nombre    = $_POST['nombre'];
	$nombre = trim($nombre);
	$paterno   = $_POST['paterno'];
	$paterno = trim($paterno);
	$materno   = $_POST['materno'];
	$materno = trim($materno);
	$direccion = $_POST['direccion'];
	$direccion = trim($direccion);
	$sexo      = $_POST['sexo'];
	$telefono  = $_POST['telefono'];
	$telefono = trim($telefono);
	$fecha_nac = $_POST['fecha_nac'];
	$correo    = $_POST['correo'];
	$correo = trim($correo);
	$tipo      = $_POST['tipo'];
	$cantidad = strlen($telefono);
	
	if($cantidad != 10){
		echo "telefono";
		return false;
	}

	if($nombre != "" && $paterno != "" && $materno != "" && $direccion != "" && $sexo != "" && $telefono != "" && $fecha_nac != "" && $correo != "" && $tipo != ""){
		$cadena = mysql_query("UPDATE personas SET nombre = '$nombre', ap_paterno = '$paterno', ap_materno = '$materno', sexo = '$sexo', direccion = '$direccion', telefono = '$telefono', fecha_nacimiento = '$fecha_nac', correo = '$correo', tipo_persona = '$tipo' WHERE id_persona = '$id_persona'",$conexion);
		echo "ok";
	}else{
		echo "vacio";
	}
?>
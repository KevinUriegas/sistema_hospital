<?php
	include('../sesiones/verificar_sesion.php');

	$id_persona = $_SESSION["idPersona"];

	$consulta_datos = mysql_query("SELECT
					nombre,
					ap_paterno,
					ap_materno,
					direccion,
					sexo,
					telefono,
					fecha_nacimiento,
					correo,
					tipo_persona 
				FROM personas
				WHERE id_persona = '$id_persona'",$conexion)or die(mysql_error());
	$row = mysql_fetch_array($consulta_datos);
	$array = array($row[0], //nombre
					$row[1], //ap_paterno
					$row[2], //ap_materno
					$row[3], //direccion,
					$row[4], //sexo,
					$row[5], //telefono
					$row[6], //fecha_nac
					$row[7], //correo
					$row[8] //tipo_persona
					);
	echo json_encode($array);
?>
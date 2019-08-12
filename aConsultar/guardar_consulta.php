<?php
	include('../sesiones/verificar_sesion.php');

	$id_usuario  =  $_SESSION["idUsuario"];
	$id_cita     =  $_POST["id_cita"];
	$id_paciente =  $_POST["id_paciente"];

	$verificar = mysql_query("SELECT activo FROM citas WHERE id_cita = '$id_cita'",$conexion);
	$row_ver = mysql_fetch_array($verificar);

	if($row_ver[0] == 1){
		$cadena = mysql_query("INSERT INTO recetas (id_paciente, id_doctor, id_registro, fecha_registro, hora_registro, activo,id_cita) VALUES('$id_paciente','$id_usuario','$id_usuario','$fecha','$hora','1','$id_cita')",$conexion);

		$cadena2 = mysql_query("UPDATE citas SET activo = '2' WHERE id_cita = '$id_cita'",$conexion);

		$cadena_max = mysql_query("SELECT MAX(id_receta) FROM recetas",$conexion);
		$row_max = mysql_fetch_array($cadena_max);
		$mensaje = "ok";
		$receta = $row_max[0];
	}else if($row_ver[0] == 2){
		$cadena2 = mysql_query("SELECT id_receta FROM recetas WHERE id_cita = '$id_cita'",$conexion);
		$row2 = mysql_fetch_array($cadena2);
		$mensaje = "ok";
		$receta = $row2[0];
	}
	$cadena_paciente = mysql_query("SELECT (SELECT CONCAT(nombre, ' ', ap_paterno,' ', ap_materno) FROM personas WHERE personas.id_persona = pacientes.id_persona),numero_seguro FROM pacientes WHERE id_paciente = '$id_paciente'",$conexion);
	$row_paciente = mysql_fetch_array($cadena_paciente);
	$array = array($row_paciente[0],$receta,$row_paciente[1]);
	echo json_encode($array);
?>
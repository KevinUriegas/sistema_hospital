<?php
	include('../sesiones/verificar_sesion.php');

	$id_paciente = $_POST['id_paciente'];
	$cadena = mysql_query("SELECT CASE
		tipo_sangre 
		WHEN '1' THEN
		'A+' 
		WHEN '2' THEN
		'A-'
		WHEN '3' THEN
		'B+'
		WHEN '4' THEN
		'B-'
		WHEN '5' THEN
		'O+'
		WHEN '6' THEN
		'O-'
		WHEN '7' THEN
		'AB+' ELSE 'AB-' 
	END AS tipo_sangre,estatura,peso FROM pacientes WHERE id_paciente = '$id_paciente'",$conexion);
	$row = mysql_fetch_array($cadena);

	$array = array($row[0],$row[1],$row[2]);
	echo json_encode($array);
?>
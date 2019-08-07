<?php
	include('../sesiones/verificar_sesion.php');

	$id_cita = $_POST['id_cita'];

	$cadena = mysql_query("UPDATE citas SET activo = '3' WHERE id_cita = '$id_cita'",$conexion);
	echo "UPDATE citas SET activo = '3' WHERE id_cita = '$id_cita'";
	echo "ok";
?>
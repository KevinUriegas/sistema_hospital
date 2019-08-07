<?php
	include('../sesiones/verificar_sesion.php');

	$id_detalle = $_POST['id_detalle'];

	$cadena = mysql_query("UPDATE detalle_receta SET activo = '0' WHERE id_detalle = '$id_detalle'",$conexion);
	echo "ok";
?>
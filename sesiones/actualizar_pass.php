<?php

    include("/verificar_sesion.php");
	$id_usuario =  $_SESSION["idUsuario"];

	$pass    = $_POST['pass'];
	$pass    = md5($pass);

	$cadena = mysql_query("SELECT contra,id_usuario,pvez FROM usuarios WHERE id_usuario = '$id_usuario'",$conexion);
	$row_contra = mysql_fetch_array($cadena);

	if($row_contra[0] == $pass){
		echo "repetida";
	}else{
		$cadena_actualizar = mysql_query("UPDATE usuarios SET contra = '$pass' WHERE id_usuario = '$id_usuario'",$conexion);
		echo "ok";
	} 
?>
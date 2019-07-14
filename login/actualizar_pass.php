<?php

	include("../conexion/conexion.php");

	$usuario = $_POST['usuario'];
	$pass    = $_POST['vContra1'];
	$pass2   = $pass;
	$pass    = md5($pass);

	$cadena = mysql_query("SELECT pass,id_usuario,pvez FROM usuarios WHERE usuario = '$usuario'",$conexion);
	$row_contra = mysql_fetch_array($cadena);

	if($row_contra[0] == $pass){
		echo "repetida";
	}else{
		if($pass2 == "12345" && $row_contra[2] == 0){
			echo "Otra";
		}else{
			$cadena_actualizar = mysql_query("UPDATE usuarios SET pass = '$pass', pvez = '0' WHERE id_usuario = '$row_contra[1]'",$conexion);
			echo "ok";
		}
	} 
?>
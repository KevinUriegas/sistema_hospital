<?php 
	include('../sesiones/verificar_sesion.php');
    $nombre =  $_SESSION["nCompleto"];
    echo 'Bienvenido '.$nombre;
?>
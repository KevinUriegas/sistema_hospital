<?php

$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "kevinalexis";
$bd_base = "sistema_hospital";

$conexion = mysql_connect($bd_host,$bd_usuario,$bd_password) ;
mysql_select_db($bd_base,$conexion)or die (mysql_error());
date_default_timezone_set('America/Monterrey');
$fecha=date("Y-m-d"); 
$hora=date ("h:i:s");
?>
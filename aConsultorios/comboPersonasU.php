<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

$consulta = mysql_query("SELECT
							areas.id_area,
							CONCAT(
								areas.nombre
							) AS Area
							FROM
							areas
							LEFT JOIN consultorios ON areas.id_area = consultorios.id_area
							WHERE
							areas.activo = 1",$conexion)or die(mysql_error());
?>
    <option value="0">Seleccione...</option>
<?php

while($row = mysql_fetch_row($consulta))
{  
	?>
    	<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
	<?php
}

?>

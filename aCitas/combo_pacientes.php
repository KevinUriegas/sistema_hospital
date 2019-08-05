<?php
include "../conexion/conexion.php";

mysql_query("SET NAMES utf8");

$consulta = mysql_query("SELECT id_paciente, (SELECT CONCAT(nombre,' ',ap_paterno,' ',ap_materno) 
                        FROM personas WHERE personas.id_persona = pacientes.id_persona) 
                        FROM pacientes WHERE activo = '1'",$conexion)or die(mysql_error());
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
<script>
 $("#id_paciente").select2();
</script>
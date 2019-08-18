<?php 

include'../conexion/conexion.php'; 
include'../funcionesPHP/fechaEspanol.php'; 
include'../funcionesPHP/calcularEdad.php';

$id_receta=$_GET['id_receta'];
// $idDatos=$_GET['datos'];
        
mysql_query("SET NAMES utf8");
$consulta=mysql_query("SELECT (SELECT nombre FROM catalogo_medicamento WHERE catalogo_medicamento.id_medicamento = detalle_receta.id_medicamento),cantidad 
                        FROM detalle_receta WHERE id_receta = '$id_receta'",$conexion) or die (mysql_error());
$cadena = mysql_query("SELECT CONCAT(personas.nombre,' ',personas.ap_paterno,' ',personas.ap_materno),especialidades.nombre,(SELECT CONCAT(personas.nombre,' ',personas.ap_paterno,' ',personas.ap_materno) FROM pacientes INNER JOIN personas ON personas.id_persona = pacientes.id_persona  WHERE pacientes.id_paciente = recetas.id_paciente)
    FROM recetas 
    INNER JOIN doctores ON doctores.id_doctor = recetas.id_doctor
    INNER JOIN personas ON personas.id_persona = doctores.id_persona
    INNER JOIN especialidades ON especialidades.id_especialidad = doctores.id_especialidad
    WHERE id_receta = '$id_receta'",$conexion);
$row_doctor = mysql_fetch_array($cadena);

// $row_paciente = mysql_fetch_array($cadena);
   
//Descargamos el arreglo que arroja la consulta
$n=1;
// $row=mysql_fetch_row($consulta);

$fecha=date("Y-m-d"); 
$fechaEspanol=fechaCastellano($fecha);

 ?>

<!-- Inicio Estilo del reporte -->
<style type="text/css">

    table
    {
        width:  90%;
        margin:auto;
    }

    td.borde
    {
        text-align: center;
        border: solid 1px #D8D8D8;
        padding: 2px;
        text-align: center;
    }

    td.titular
    {
        text-align: center;
        border: solid 1px #34495e;
        background: #ecf0f1;
        color:#34495e;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 11px;
        font-size:12px;
    }

    p.parrafo
    {
        border: solid 1px #34495e;
        color:#34495e;
        font-size:12px;
        margin:5px;
        padding:0px 0px 5px 0px;  
    }

    td.encabezado
    {
        text-align: center;
        color:#34495e;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 11px;
        font-size:15px;
        border: solid 1px #D8D8D8;
    }

    td.fecha
    {
        text-align: right;
        border: solid 0px #34495e;
        background: #ffffff;
        color:#34495e;
        letter-spacing: 3px;
        padding: 18px;
    }

    img{
        width: 100%;
    }

</style>
<!-- Fin Estilo del reporte -->
    
<table border="0">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <!-- defino el ancho de la tabla -->
    <tr border="0">
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr >
        <td  colspan="10" class="encabezado">
            RECETA MEDICA
        </td>
    </tr> 
    <tr>
        <td colspan="10" class="titular">
            <?php echo 'Dr./Dra.'.$row_doctor[0].'<br>'; echo $row_doctor[1] ;?>
        </td>
    </tr>
    <tr >
        <td colspan="5" class="borde" align="left">
            Paciente: <strong><?php echo $row_doctor[2];?></strong>
        </td>
        <td colspan="5" class="borde" align="right">
            <strong><?php echo "$fechaEspanol"; ?></strong>
        </td>
    </tr>

    <?php
        $n=1;
        while($row=mysql_fetch_row($consulta)){
            $nombre  = $row[0];
            $cantidad  = $row[1];
    ?>
        <tr >
            <td  colspan="1" class="borde">
                <p class="parrafo">
                    <?php echo $n; ?>
                </p>
            </td>
            <td  colspan="7" class="borde">
                <p class="parrafo">
                    <?php echo $nombre; ?>
                </p>
            </td>
            <td  colspan="2" class="borde">
                <p class="parrafo">
                    <?php echo $cantidad; ?>
                </p>
            </td>
        </tr>
    <?php 
        $n++;
        }
    ?>
</table>
<br>
<table>
<col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <!-- defino el ancho de la tabla -->
    <tr border="0">
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr >
        <td  colspan="3" class="" align="center">
            <?php echo '<p><u>'.$row_doctor[0].'</u><br>'.'<strong>Nombre del Doctor</strong></p>';?>
        </td>
        <td  colspan="3" class="" align="center">
            <?php echo '<p>__________________________<br>'.'<strong>Sello</strong></p>';?>
        </td>
        <td  colspan="4" class="" align="center">
            <?php echo '<p>__________________________<br>'.'<strong>Firma</strong></p>';?>
        </td>
    </tr> 
    <tr>
        <td  colspan="10" align="center">
            <hr>
        </td>
    </tr>
</table>

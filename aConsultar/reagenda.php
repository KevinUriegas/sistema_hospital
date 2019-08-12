<?php
    include('../sesiones/verificar_sesion.php');
    $id_usuario =  $_SESSION["idUsuario"];

    $fecha_cita  = $_POST['fecha'];
    $hora_cita   = $_POST['hora'];
    $id_paciente = $_POST['id_paciente'];

    $hora_mas = strtotime ( '+1 hour' , strtotime ($fecha_cita.' '.$hora_cita) ) ; 
    $hora_mas = date ( 'Y-m-d H:i:s' , $hora_mas); 

    $horaF = substr($hora_mas,10,9);

    $verificar = mysql_query("SELECT id_cita FROM citas WHERE fecha_cita = '$fecha_cita' AND hora_cita = '$hora_cita'",$conexion);
    $existe = mysql_num_rows($verificar);
    if($existe == 0){
        $cadena_sel = mysql_query("SELECT id_cita, id_consultorio FROM citas WHERE fecha_cita = '$fecha' AND id_paciente = '$id_paciente' AND activo = '1'",$conexion);
        $row_sel = mysql_fetch_array($cadena_sel);
        $cadena_act = mysql_query("UPDATE citas SET activo = '0' WHERE id_cita = '$row_sel[0]'", $conexion);
        $cadena = mysql_query("INSERT INTO citas (id_paciente, fecha_cita, hora_cita, id_consultorio, id_registro, fecha_registro, hora_registro, activo, hora_cita_fin) VALUES ('$id_paciente','$fecha_cita','$hora_cita','$row_sel[1]','$id_usuario','$fecha','$hora','1','$hora_mas')",$conexion);
        echo "ok";
    }else{
        echo "duplicado";
    }
?>
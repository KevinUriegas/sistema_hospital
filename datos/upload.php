<?php
    include('../sesiones/verificar_sesion.php');

    $id_persona = $_SESSION["idPersona"];
    $id_persona = $id_persona.'.jpg';  
    if (is_array($_FILES) && count($_FILES) > 0) {
        if (($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/jpeg")) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], "../images/".$id_persona)) {
                //more code here...
                echo "../images/".$id_persona.'?'.$hora;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
?>
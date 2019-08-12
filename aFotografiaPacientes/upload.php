<?php
$id_paciente=trim($_POST["idp"]).'.jpg';
if (is_array($_FILES) && count($_FILES) > 0) {
    if (($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/jpeg")) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "../images_p/".$id_paciente)) {
            //more code here...
            echo "../images_p/".$id_paciente;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
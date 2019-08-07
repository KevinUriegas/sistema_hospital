<?php
$idPaciente=trim($_POST["nseg"]).'.jpg';
if (is_array($_FILES) && count($_FILES) > 0) {
    if (($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/jpeg")) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "../images/".$idPaciente)) {
            //more code here...
            echo "../images/".$idPaciente;
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
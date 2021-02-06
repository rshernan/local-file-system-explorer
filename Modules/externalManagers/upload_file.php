<?php
$destination_path = ROOT_PATH . "//local-file-system-explorer//root"; //$_POST['destination_path'];

print_r($_SERVER['DOCUMENT_ROOT']);

$received_file = $_FILES["uploader"];

if (move_uploaded_file($received_file['tmp_name'], $destination_path . $received_file['name'])) {
    echo '<script type="text/javascript">
        alert("Archivo Guardado");
        window.location.href="' . $_SERVER['DOCUMENT_ROOT'] . '//local-file-system-explorer//user_interface.php";
        </script>';
}

<?php
include_once('../Constants/Constants.php');

$destination_path = ROOT_PATH . $_GET['path'];

$received_file = $_FILES["uploader"];

print_r("print " . $destination_path . $received_file['name']);

if (move_uploaded_file($received_file['tmp_name'], $destination_path . "/" . $received_file['name'])) {
    echo '<script type="text/javascript">
        alert("Archivo Guardado");
        window.location.href="' . '../../index.php?path=' . $_GET['path'] . '";
        </script>';
}

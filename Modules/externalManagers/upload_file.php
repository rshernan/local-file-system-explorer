<?php
include_once('../Constants/Constants.php');

$destination_path = ROOT_PATH . (isset($_GET['path']) ? $_GET['path'] : "");

$received_file = $_FILES["uploader"];

if (!file_exists($destination_path . '/' . fileSystemName($received_file['name']))) {
    if (move_uploaded_file($received_file['tmp_name'], $destination_path . "/" . fileSystemName($received_file['name']))) {
        echo '<script type="text/javascript">
            alert("Archivo Guardado");
            window.location.href="' . '../../index.php?path=' . (isset($_GET['path']) ? $_GET['path'] : "") . '";
            </script>';
    }
} else {
    echo '<script type="text/javascript">
            alert("Ya hay un archivo con ese nombre en este directorio");
            window.location.href="' . '../../index.php?path=' . (isset($_GET['path']) ? $_GET['path'] : "") . '";
            </script>';
}





function fileSystemName($nombre, $separador = '')
{
    $search = array(
        chr(192), chr(193), chr(194), chr(195), chr(224), chr(225), chr(226), chr(227), // a
        chr(201), chr(202), chr(233), chr(234), // e
        chr(205), chr(237), // i
        chr(211), chr(212), chr(213), chr(243), chr(244), chr(245), // o
        chr(218), chr(220), chr(250), chr(252), // u
        chr(199), chr(231), // c
        chr(209), chr(241) // ñ
    );
    $replace = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'e', 'e', 'e', 'e',
        'i', 'i',
        'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u',
        'c', 'c',
        'n', 'n'
    );
    $aux = strtolower(str_replace($search, $replace, $nombre));
    $aux = preg_replace('/[^a-z0-9.]/', $separador, $aux);
    return $aux;
}

<?php

include_once('./Modules/Directory/Element.php');
include_once('./Modules/Directory/File.php');
include_once('./Modules/Directory/Folder.php');

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/PHPFileSystem/root');

if (isset($_GET['path'])) {
    $path = $_SERVER["DOCUMENT_ROOT"] . $_GET['path'];
    
    if(is_dir($path)) {
        echo "isDIR\n";
        $folder = new Folder($path);
        $folder->downloadAsZip();
    } else if (is_file($path)) {
        $file = new File($path);
        $file->download();
    }
}

/*
function downloadFile($filePath) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Pragma: public');

    ob_clean();
    flush();
    readfile($filePath);
    die();
}




*/
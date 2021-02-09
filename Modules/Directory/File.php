<?php

class File extends Element
{
    public function getSize()
    {
    }

    public function download()
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="' . basename($this->path) . '"');
        header('Content-Length: ' . filesize($this->path));
        header('Pragma: public');

        $realPath = realpath($this->path);
        echo $realPath;
        ob_clean();
        flush();
        readfile($realPath);
        die();
    }
}

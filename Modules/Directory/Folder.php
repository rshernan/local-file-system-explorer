<?php

class Folder extends Element
{
    public function __construct(
        string $path = '',
        bool $addFolders = true,
        bool $addFiles = true,
        bool $recursive = false
    ) {
        parent::__construct($path);
        $this->folders = array();
        $this->files = array();
        if ($addFolders) {
            $this->addContent($addFiles, $recursive);
        }
    }

    public function search(string $regex) {
        $array = array();
        foreach ($this->folders as $item) {
            $inner = $item->search($regex);
            if(preg_match($regex, $item->getName())) {
                array_push($array, $item);
            }
            $array = array_merge($array, $inner);
        }
        foreach ($this->files as $item) {
            if(preg_match($regex, $item->getName())) {
                array_push($array, $item);
            }
        }
        return $array;
    }

    public function setActiveFolder(string $path)
    {
        $isActivePath = false;
        foreach ($this->folders as $folder) {
            if ($path === $folder->path) {
                $folder->active = true;
                $isActivePath = true;
            } else {
                unset($folder->active);
            }
            if ($folder->setActiveFolder($path)) {
                $folder->active = true;
                $isActivePath = true;
            }
        }
        return $isActivePath;
    }

    public function downloadAsZip() {
        echo '<pre>';
        echo sys_get_temp_dir()."\n\n";
        $zipFile = $this->getName().".zip";
            
        $zip = new ZipArchive();
        $response = $zip->open($zipFile, ZipArchive::CREATE);
        echo $response;
        foreach ($this->files as $file)
        {
            echo realpath($file->path)."\n\n";
            $zip->addFile(realpath($file->path));
        }
        echo var_dump($zip);
        echo var_dump($zip->getStatusString());

        echo ($zip->close() ? 'succes' : 'fail') . "\n";

        echo var_dump($zip->getStatusString());
        
        /*
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zip_file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file);
        */
    }
    

    private function addContent(bool $addFiles, bool $recursive)
    {
        $scan = scandir($this->path);
        foreach ($scan as $item) {
            if (($item != '.' && $item != '..') && is_dir("$this->path/$item")) {
                array_push($this->folders, new Folder("$this->path/$item", $recursive, $addFiles, $recursive));
            } else if ($addFiles && is_file("$this->path/$item")) {
                array_push($this->files,  new File("$this->path/$item"));
            }
        }
    }
}

<?php

class Folder extends Element
{

    public function __construct(
        string $path = '',
        bool $addFiles = true,
        int $maxDepth = -1
    ) {
        parent::__construct($path);
        $this->folders = array();
        $this->files = array();

        $this->addContent($addFiles, $maxDepth);
    }

    public function search(string $regex, int $limit = 5) {
        $array = array();
        foreach ($this->files as $item) {
            if(preg_match($regex, $item->getName())) {
                if(array_push($array, $item) > $limit) {
                    break;
                }
            }
        }
        foreach ($this->folders as $item) {
            if(preg_match($regex, $item->getName())) {
                if(array_push($array, $item) > $limit) {
                    break;
                }
            }
        }
        foreach($this->folders as $folder) {
            if(count($array) > $limit) {
                break;
            }
            $inner = $folder->search($regex, $limit - count($array));
            $array = array_merge($array, $inner);
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
    

    private function addContent(bool $addFiles, int $maxDepth)
    {
        if($maxDepth == 0) {
            return;
        } else if($maxDepth > 0) {
            $maxDepth--;
        }
        $scan = scandir($this->path);
        foreach ($scan as $item) {
            if (($item != '.' && $item != '..') && is_dir("$this->path/$item")) {
                array_push($this->folders, new Folder("$this->path/$item", $addFiles, $maxDepth));
            } else if ($addFiles && is_file("$this->path/$item")) {
                array_push($this->files,  new File("$this->path/$item"));
            }
        }
    }
}

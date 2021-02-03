<?php

class Folder
{
    public function __construct($parentPath = '', $name = 'root', $addFolders = false, $addFiles = false, $recursive = false)
    {
        $this->parentPath = $parentPath;
        $this->name = $name;
        $this->path = "$parentPath/$name";
        if ($addFolders) {
            $this->addContent($addFiles, $recursive);
        }
    }

    public function setActiveFolder($path)
    {
        $activeSet = false;
        foreach ($this->folders as $folder) {
            if ($path == $folder->getPath()) {
                $folder->active = true;
                $folder->setChildrensInactive();
                $activeSet = true;
            } else if ($folder->setActiveFolder($path)) {
                $folder->active = true;
                return true;
            } else if (property_exists($folder, 'active')) {
                unset($folder->active);
            }
        }
        return $activeSet;
    }

    private function setChildrensInactive()
    {
        foreach ($this->folders as $folder) {
            unset($folder->active);
            $folder->setChildrensInactive();
        }
    }

    public function getFolders()
    {
        return $this->folders;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getFolder($path)
    {
        foreach ($this->folders as $folder) {
            if ($path == $folder->getPath()) {
                $folder->print();
                return 0;
            } else {
                if ($folder->getFolder($path) == 0) {
                    return 0;
                }
            }
        }
    }

    public function print()
    {
        static $indent = 0;
        if (isset($this->active)) {
            echo '<b>';
        }
        for ($i = 0; $i < $indent; $i++) {
            echo '-';
        }
        if (isset($this->active)) {
            echo '</b>';
        }
        echo "Folder <b>$this->name</b>" . ($this->active ? '(Active)' : '') . " that has <b>" . ($this->files ? count($this->files) : 0) . "</b> files and";
        if ($this->getFolders()) {
            echo " has <b>" . count($this->getFolders()) . "</b> folders:\n\n";
            $indent = $indent + 4;
            foreach ($this->getFolders() as $folder) {
                $folder->print();
            }
            $indent = $indent - 4;
        } else {
            echo " doest not have folders.\n\n";
        }
    }

    private function addContent($addFiles, $recursive)
    {
        $scan = scandir($this->path);
        $folders = array();
        $files = array();
        foreach ($scan as $item) {
            if (is_dir("$this->path/$item") && ($item != '.' && $item != '..')) {
                $folders[$item] = new Folder($this->path, $item, $recursive, $addFiles, $recursive);
            } else if (is_file("$this->path/$item") && $addFiles) {
                $files[$item] = "$this->path/$item";
            }
        }
        $this->folders = $folders;
        $this->files = $files;
    }
}

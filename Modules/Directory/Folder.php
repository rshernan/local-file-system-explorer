<?php

class Folder
{
    public function __construct(
        string $parentPath = '',
        string $name = 'root',
        bool $addFolders = false,
        bool $addFiles = false,
        bool $recursive = false
    ) {
        $this->parentPath = $parentPath;
        $this->name = $name;
        $this->path = "$parentPath/$name";
        if ($addFolders) {
            $this->addContent($addFiles, $recursive);
        }
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
        if ($this->folders) {
            echo " has <b>" . count($this->folders) . "</b> folders:\n\n";
            $indent = $indent + 4;
            foreach ($this->folders as $folder) {
                $folder->print();
            }
            $indent = $indent - 4;
        } else {
            echo " doest not have folders.\n\n";
        }
    }

    private function addContent(bool $addFiles, bool $recursive)
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

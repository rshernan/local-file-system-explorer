<?php

abstract class Element
{
    public function __construct(
        string $path = ''
    ) {
        $this->path = $path;
    }

    public function getName() {
        return basename($this->path);
    }

    public function getParentPath() {
        return dirname($this->path);
    }

    public function getRelativePath() {
        return str_replace(ROOT_PATH, "", $this->path);
    }

    public function getCreationTime()
    {
        return date('l jS \of F Y h:i:s A', filectime($this->path));
    }

    public function getType() {
        return filetype($this->path);
    }

    public function print() {
        echo "Element $this->name";
    }

    public function getImageElement() {
        switch($this->getType()) {
            case 'dir': {
                return "<img src='./images/folder.png' alt='folder' class='card__img'>";
            }
            default: {
                return "<img src='./images/file.png' alt='file' class='card__img'>";
            }
        }
    }
}

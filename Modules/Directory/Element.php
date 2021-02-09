<?php

abstract class Element
{
    public function __construct(
        string $path = ''
    ) {
        $this->path = $path;
    }

    public function getName()
    {
        return basename($this->path);
    }

    public function getParentPath()
    {
        return dirname($this->path);
    }

    public function getRelativePath()
    {
        return str_replace(ROOT_PATH, "", $this->path);
    }

    public function getServerPath()
    {
        return str_replace($_SERVER["DOCUMENT_ROOT"], "", $this->path);
    }

    public function getCreationTime()
    {
        return date('l jS \of F Y h:i:s A', filectime($this->path));
    }

    public function getType()
    {
        if (filetype($this->path) == "file") {
            switch (explode("/", mime_content_type($this->path))[0]) {
                case "image":
                    return "image";
                    break;
                case "video":
                    return "video";
                    break;
                case "audio":
                    return "audio";
                    break;
                default:
                    return "file";
                    break;
            }
        } else {
            return "dir";
        }
    }

    public function getMimeType()
    {
        return mime_content_type($this->path);
    }

    public function print()
    {
        echo "Element $this->name";
    }

    public function getImageElement()
    {
        switch ($this->getType()) {
            case 'dir': {
                    return "<img src='./images/folder.png' alt='folder' class='card__img'>";
                }
            default: {
                    return "<img src='./images/file.png' alt='file' class='card__img'>";
                }
        }
    }

    private function toArray()
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'path' => implode("%2F", array_splice(explode("%2F", urlencode($this->getServerPath())), 2)),
            'mimeType' => $this->getMimeType(),
        ];
    }

    public function toJson()
    {
        print_r($this->toArray());
        print_r(json_encode($this->toArray()));
        return json_encode($this->toArray());
    }
}

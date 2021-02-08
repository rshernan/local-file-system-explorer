<?php

class Finder
{
    public function __construct(
        string $path,
        string $regex = '//',
        int $maxDepth = -1,
        int $limit = 10
    ) {
        $this->path = $path;
        $this->regex = $regex;
        $this->maxDepth = $maxDepth;
        $this->limit = $limit;
    }

    public function search(string $regex, int $limit = 10, int $maxDepth = -1) {
        
        if($maxDepth == 0) {
            return;
        } else if($maxDepth > 0) {
            $maxDepth--;
        }

        $matchesArray = array();
        $folders = array();
        $scan = scandir($this->path);
        foreach ($scan as $item) {
            if (($item != '.' && $item != '..') && is_dir("$this->path/$item")) {
                $itemFolder = new Folder("$this->path/$item", false, 1);
                array_push($folders, $itemFolder);
                if(preg_match($regex, $item)) {
                    if(array_push($matchesArray, $itemFolder) >= $limit) {
                        break;
                    }
                }                    

            } else if (is_file("$this->path/$item")) {
                if(preg_match($regex, $item)) {
                    $file = new File("$this->path/$item");
                    if(array_push($matchesArray, $file) >= $limit) {
                        break;
                    }
                }            
            }
        }
        foreach($folders as $childDir) {
            if(count($matchesArray) >= $limit) {
                break;
            }
            $finder = new Finder($childDir->path, $regex);
            $inner = $finder->search($regex, $limit - count($matchesArray));
            $matchesArray = array_merge($matchesArray, $inner);
        }
        return $matchesArray;
    }
}

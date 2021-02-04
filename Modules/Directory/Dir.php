<?php

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/PHP-FileSystem/root');
session_start();
include_once('Folder.php');

class Dir
{

    public function __construct($currentPath = ROOT_PATH)
    {
        $this->currentPath = $_SESSION['currentPath'] ? $currentPath : ROOT_PATH;
        $_SESSION['currentPath'] = $currentPath;
    }

    public function createFolder($path)
    {
        mkdir($path);
    }

    public function getRoot(
        bool $addFolders = false,
        bool $addFiles = false,
        bool $recursive = false
    ) {
        return new Folder(dirname(ROOT_PATH), 'root', $addFolders, $addFiles, $recursive);
    }

    public function scanDir()
    {
        echo '<pre>';
        echo "<h3>ROOT FOLDER WITH FILES AND FOLDERS OF ITSELF</h3>";
        $rootFolder = new Folder(dirname(ROOT_PATH), 'root', true, true);
        $rootFolder->print();

        echo "<h3>ROOT FOLDER WITH FOLDERS AND RECURSIVE</h3>";
        $rootFolder2 = new Folder(dirname(ROOT_PATH), 'root', true, false, true);
        $rootFolder2->print();

        echo "<h3>ROOT FOLDER WITH FOLDERS AND FILES AND RECURSIVE WITH ACTIVES FOLDER</h3>";
        $rootFolder3 = new Folder(dirname(ROOT_PATH), 'root', true, true, true);
        $rootFolder3->setActiveFolder('/opt/lampp/htdocs/PHP-FileSystem/root/folder1/folder2/folder3/folder4');
        $rootFolder3->print();
        $rootFolder3->setActiveFolder('/opt/lampp/htdocs/PHP-FileSystem/root/folder1/folder2');
        $rootFolder3->print();
        $rootFolder3->setActiveFolder('/opt/lampp/htdocs/PHP-FileSystem/root/folder1/nuevacarp');
        $rootFolder3->print();
        $rootFolder3->setActiveFolder('/opt/lampp/htdocs/PHP-FileSystem/root/folder1/folder2.1');
        $rootFolder3->print();
        var_dump($rootFolder3);
    }

    /*
    public function folderSize ($dir)
    {
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : $this->folderSize($each);
        }
        return $size;
    }
    */
}

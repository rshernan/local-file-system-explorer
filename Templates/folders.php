<?php

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/PHPFileSystem/root_large');

include_once('../Modules/Directory/Element.php');
include_once('../Modules/Directory/File.php');
include_once('../Modules/Directory/Folder.php');

$currentFolder = new Folder(ROOT_PATH . $_GET['path'], false, 3);
$currentFolder->setActiveFolder(ROOT_PATH . $_GET['path']);

echo createNavItems($currentFolder->folders, false);

function createNavItems(array $folders, $hidden)
{
    $ul = "<ul class='folderList__ul" . ($hidden ? " hidden" : "") . "'>";
    foreach ($folders as $folder) {
        $ul .= createNavItem($folder);
    }
    $ul .= "</ul>";
    return $ul;
}

function createNavItem(Folder $folder)
{
    return "
        <li class='folderList__li"
        . (!$folder->folders ?
            " unfoldable" : "")
        . "'>
        <div class='folderList__li--selector'>
            <button class='folderList__button' data-path='".$folder->getRelativePath()."'></button>
            <a href='?path=" . urlencode($folder->getRelativePath()) . "' class='folderList--title'>" . $folder->getName() . "</a>
        </div>"
        . ($folder->folders ?
            createNavItems($folder->folders, !$folder->active || isset($_POST['search'])) : "")
        . "</li>";
}
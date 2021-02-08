<?php

require_once('./Modules/Constants/Constants.php');
require_once('./Modules/Directory/Element.php');
require_once('./Modules/Directory/File.php');
require_once('./Modules/Directory/Folder.php');

$currentFolder = new Folder(ROOT_PATH . (isset($_GET['path']) ? $_GET['path'] : ""), false, 3);

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
            <button class='folderList__button' data-path='" . $folder->getRelativePath() . "'></button>
            <a href='?path=" . urlencode($folder->getRelativePath()) . "' class='folderList--title'>" . $folder->getName() . "</a>
        </div>"
        .
        createNavItems($folder->folders, true)
        . "</li>";
}

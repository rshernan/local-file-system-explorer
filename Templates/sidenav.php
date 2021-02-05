<?php

function getNav()
{
    $rootFolder = new Folder(ROOT_PATH, true, false, true);
    $rootFolder->setActiveFolder(ROOT_PATH . $_GET['path']);

    return createNavItems($rootFolder->folders, false);
}

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
            <button class='folderList__button'></button>
            <a href='?path=" . urlencode($folder->getRelativePath()) . "' class='folderList--title'>" . $folder->getName() . "</a>
        </div>"
        . ($folder->folders ?
            createNavItems($folder->folders, !$folder->active || isset($_POST['search'])) : "")
        . "</li>";
}

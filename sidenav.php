<?php
include_once('./Modules/Directory/Dir.php');
include_once('./Modules/Directory/Folder.php');

function getNav()
{
    $dir = new Dir();
    $rootFolder = $dir->getRoot(true, false, true);
    return createNavItems($rootFolder->folders, false);
}

function createNavItems(array $folders, bool $hidden)
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
            <span class='folderList--title'>$folder->name</span>
        </div>"
        . ($folder->folders ?
            createNavItems($folder->folders, true) : "")
        . "</li>";
}

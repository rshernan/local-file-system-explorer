<?php

function getMainItems()
{
    $folder = new Folder(ROOT_PATH . $_GET['path']);
    return createMainItems($folder);
}

function createMainItems(Folder $folder)
{
    $mainItems = "";
    foreach ($folder->folders as $element) {
        $mainItems .= createElementCard($element);
    }
    foreach ($folder->files as $element) {
        $mainItems .= createElementCard($element);
    }
    return $mainItems;
}

function createElementCard(Element $element)
{
    return "<div class='card__div'>
        <a href='?path=" . $element->getRelativePath() . "' class='folderList--title'>
        " . $element->getImageElement() . "
        </a>
        <div class='cardInfo__div'>
            <p src='cardInfo__title'>" . $element->getName() . "</p>
            <p src='cardInfo__type'>" . $element->getType() . "</p>
            <p src='cardInfo__time'>" . $element->getCreationTime() . "</p>
        </div></div>";
}
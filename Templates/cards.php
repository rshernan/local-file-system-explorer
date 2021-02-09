<?php

require_once('./Modules/Constants/Constants.php');
require_once('./Modules/Directory/Element.php');
require_once('./Modules/Directory/File.php');
require_once('./Modules/Directory/Folder.php');

$folder = new Folder(ROOT_PATH . (isset($_GET['path']) ? $_GET['path'] : ""), true, 1);

$elements = array_merge($folder->folders, $folder->files);

echo createElementCards($elements);

function createElementCards(array $elements)
{
    $result = "";
    foreach ($elements as $element) {
        $result .= createElementCard($element);
    }
    return $result;
}

function createElementCard(Element $element)
{
    switch ($element->getType()) {
        case "dir": {
                return "<div class='card__div'>
            <p><a href='download.php?path=" . urlencode($element->getServerPath()) . "' target='_blank'>download</a></p>
            <a href='?path=" . $element->getRelativePath() . "' class='folderList--title'>
            " . $element->getImageElement() . "
            </a>
            <div class='cardInfo__div'>
                <p src='cardInfo__title'>" . $element->getName() . "</p>
                <p src='cardInfo__type'>" . $element->getType() . "</p>
                <p src='cardInfo__time'>" . $element->getCreationTime() . "</p>
            </div></div>";
                break;
            }
        case "file": {
                return createFileCard("showFileInfoModal('file', " . $element->toJson() . ")", $element);
                break;
            }
        case "video": {
                return createFileCard("showFileInfoModal('video',  " . $element->toJson() . ")", $element);
                break;
            }
        case "audio": {
                return createFileCard("showFileInfoModal('audio',  " . $element->toJson() . ")", $element);
                break;
            }
        case "image": {
                return createFileCard("showFileInfoModal('image',"  . $element->toJson() . ")", $element);
                break;
            }
    }
}

function createFileCard($jsFunction, $element)
{
    return "<div class='card__div'>
            <p><a href='download.php?path=" . urlencode($element->getServerPath()) . "' target='_blank'>download</a></p>
            <a href=javascript:" . $jsFunction . " class='folderList--title'>
            " . $element->getImageElement() . "
            </a>
            <div class='cardInfo__div'>
                <p src='cardInfo__title'>" . $element->getName() . "</p>
                <p src='cardInfo__type'>" . $element->getType() . "</p>
                <p src='cardInfo__time'>" . $element->getCreationTime() . "</p>
            </div></div>";
}

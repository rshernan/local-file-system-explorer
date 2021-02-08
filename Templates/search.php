<?php

require_once('../Modules/Constants/Constants.php');
require_once('../Modules/Directory/Element.php');
require_once('../Modules/Directory/File.php');
require_once('../Modules/Directory/Folder.php');
require_once('../Modules/Directory/Finder.php');

$finder = new Finder(ROOT_PATH . $_GET['path']);

echo createElementCards($finder->search("/" . $_POST['search'] . "/"));

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
}

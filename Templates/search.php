<?php

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/PHPFileSystem/root_large');

include_once('../Modules/Directory/Element.php');
include_once('../Modules/Directory/File.php');
include_once('../Modules/Directory/Folder.php');
include_once('../Modules/Directory/Finder.php');

//$folder = new Folder(ROOT_PATH . $_GET['path'], true, isset($_POST['search']) ? -1 : 1);

$finder = new Finder(ROOT_PATH . $_GET['path']);

echo count($finder->search("/".$_POST['search']."/"));

/*
$elements = isset($_POST['search']) ?
    $folder->search("/".$_POST['search']."/") :
    array_merge($folder->folders, $folder->files);
*/

//echo createElementCards($elements);


function createElementCards(array $elements)
{
    $result = "";
    foreach($elements as $element) {
        $result .= createElementCard($element);
    }
    return $result;
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
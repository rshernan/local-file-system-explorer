<?php

function getMainItems()
{
    $folder = new Folder(ROOT_PATH . $_GET['path'], true, true, isset($_POST['search']));

    $elements = isset($_POST['search']) ?
        $folder->search("/".$_POST['search']."/") :
        array_merge($folder->folders, $folder->files);

    return createElementCards($elements);
}

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
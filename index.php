<?php
error_reporting(E_ALL);

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/PHP-FileSystem/root');

include_once('./Modules/Directory/Dir.php');
include_once('./Modules/Directory/Element.php');
include_once('./Modules/Directory/File.php');
include_once('./Modules/Directory/Folder.php');
include_once('./Templates/sidenav.php');
include_once('./Templates/main.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/main.js"></script>
</head>

<body>
    <section class="modal__section">
        <form action="./modules/externalManagers/upload_file.php" method="POST">
            <input type="file" name="uploader" multiple>
            <input type="submit" value="Upload">
        </form>
    </section>
    <header class="menu__header">
        <button class="menu__folders">folders</button>
        <input type="text" name="searchBar" id="searchBar" class="menu__searchBar">
        <button class="menu__actions">actions</button>
    </header>
    <main>
        <section class="folderSideBar__section">
            <?php
            echo getNav();
            ?>
        </section>
        <section class="actionSideBar__section">
            <ul class="actionList__ul">
                <li class="actionList__li">New Folder</li>
                <li class="actionList__li">Trash</li>
                <li class="actionList__li">Upload File</li>
                <li class="actionList__li">Disk Space</li>
            </ul>
        </section>
        <section class="results__section">
            <?php
            echo getMainItems();
            ?>
        </section>
    </main>
</body>

</html>
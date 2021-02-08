<?php

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/PHPFileSystem/root_large');

include_once('./Modules/Directory/Element.php');
include_once('./Modules/Directory/File.php');
include_once('./Modules/Directory/Folder.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
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
        <form>
            <input value="<?php echo $_POST['search'] ?>" type="text" name="search" id="searchBar" class="menu__searchBar">
        </form>
        <button class="menu__actions">actions</button>
    </header>
    <main>
        <section class="folderSideBar__section">
            <?php
            include_once('./Templates/folders.php');
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
            include_once('./Templates/cards.php');
            ?>
        </section>
    </main>
</body>

</html>
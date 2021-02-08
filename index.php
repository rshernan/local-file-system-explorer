<?php

require_once('./Modules/Constants/Constants.php');
require_once('./Modules/Directory/Element.php');
require_once('./Modules/Directory/File.php');
require_once('./Modules/Directory/Folder.php');
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
    <?php
    if (isset($_POST['newFolder'])) {
        if (!file_exists(ROOT_PATH . $_GET['path'] . '/' . $_POST['newFolder'])) {
            mkdir(ROOT_PATH . $_GET['path'] . '/' . $_POST['newFolder']);
        } else {
            echo '<script type="text/javascript">
            alert("Ya existe esa carpeta en ese directorio");
            </script>';
        }
    }
    ?>
    <section class="modal__section hidden">
        <form action="./modules/externalManagers/upload_file.php?path=<?php echo (isset($_GET['path']) ? urlencode($_GET['path']) : "") ?>" method="post" class="modal__form upload hidden" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="300000">
            <input type="file" name="uploader" multiple>
            <input type="submit" value="Upload">
        </form>
        <form action="?path=<?php echo (isset($_GET['path']) ? urlencode($_GET['path']) : "") ?>" method="post" class="modal__form newFolder hidden" enctype="multipart/form-data">
            <input value="<?php echo isset($_POST['newFolder']) ? $_POST['newFolder'] : "" ?>" type="text" name="newFolder" class="modal__inputText">
            <input type="submit" value="Create">
        </form>
    </section>

    <header class="menu__header">
        <button class="menu__folders">folders</button>
        <form>
            <input value="<?php echo isset($_POST['search']) ? $_POST['search'] : "" ?>" type="text" name="search" id="searchBar" class="menu__searchBar">
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
                <li class="actionList__li" id="newFolder">New Folder</li>
                <li class="actionList__li">Trash</li>
                <li class="actionList__li" id="upload">Upload File</li>
                <li class="actionList__li">Disk Space</li>
            </ul>
        </section>
        <section class="results__section">
            <?php
            require_once('./Templates/cards.php');
            ?>
        </section>
    </main>
</body>

</html>
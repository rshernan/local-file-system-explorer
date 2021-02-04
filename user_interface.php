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
    <header class="menu__header">
        <button class="menu__folders">folders</button>
        <input type="text" name="searchBar" id="searchBar" class="menu__searchBar">
        <button class="menu__actions">actions</button>
    </header>
    <main>
        <section class="folderSideBar__section">
            <?php
            ?>
            <ul class="folderList__ul">
                <li class="folderList__li">
                    Lorem.
                    <li class="folderList__li folderList__li--hidden">Lorem.</li>
                </li>
                <li class="folderList__li">Lorem.</li>
                <li class="folderList__li">Lorem.</li>
                <li class="folderList__li">Lorem.</li>
            </ul>
        </section>
        <section class="actionSideBar__section">
            <ul class="actionList__ul">
                <li class="actionList__li">New Folder</li>
                <li class="actionList__li">Trash</li>
                <li class="actionList__li">Upload File</li>
                <li class="actionList__li">Disk Space</li>
            </ul>
        </section>
        <div class="card__div">
            <img src="./images/placeholder.jpg" alt="imagen" class="card__img">
            <div class="cardInfo__div">
                <p src="cardInfo__title">Title</p>
                <p src="cardInfo__type">Type</p>
                <p src="cardInfo__time">Time</p>
                <p src="cardInfo__size">size</p>
            </div>
        </div>
        <div class="card__div">
            <img src="./images/placeholder.jpg" alt="imagen" class="card__img">
            <div class="cardInfo__div">
                <p src="cardInfo__title">Title</p>
                <p src="cardInfo__type">Type</p>
                <p src="cardInfo__time">Time</p>
                <p src="cardInfo__size">size</p>
            </div>
        </div>
    <?php
    ?>
    </main>
</body>
</html>

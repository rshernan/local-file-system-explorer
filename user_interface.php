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
            <div class="folderListContainer__div">
                <div class="folderList__div" style="padding-left: 5px;">
                    Lorem.
                    <div class="folderList__div folderList__div--hidden">
                        Lorem.
                        <div class="folderList__div folderList__div--hidden">
                            Lorem.
                        </div>
                    </div>
                </div>
                <div class="folderList__div">Voluptates.</div>
                <div class="folderList__div">Quasi?</div>
                <div class="folderList__div">Nam?</div>
                <div class="folderList__div">Ullam.</div>
            </div>
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

<?php
// Начинаем или возобновляем сессию
session_start();

// Проверяем, есть ли в сессии информация о пользователе
if (!isset($_SESSION['userId'])) {
    // Если пользователя нет в сессии, перенаправляем на страницу входа
    header("Location: authorization.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <title>dsoSite</title>
</head>

<body>

    <!-- LOADER -->
    <div class="loaderWrapper">
        <div class="svg-loader">
            <svg class="svg-container" height="60" width="60" viewBox="0 0 100 100">
                <circle class="loader-svg bg" cx="50" cy="50" r="45"></circle>
                <circle class="loader-svg animate" cx="50" cy="50" r="45"></circle>
            </svg>
        </div>
    </div>
    <!-- LOADER -->
    <!-- HEADER -->
    <header class="header">
        <div class="wrapper">
            <a href="index.php">
                <img src="./img/logo.png" alt="logo" class="logo">
            </a>
        </div>
    </header>
    <!-- HEADER -->
    <!-- MAIN -->
    <main class="main">
        <div class="wrapper">
            <div class="tableCharacters">
                <form class="searchWrapper" method="GET">
                    <input type="search" name="search" id="search" class="search" placeholder="Искать по никнейму">
                </form>
                <div class="info">
                    <p class="info__Class">Класс</p>
                    <p class="info__Nickname">Никнейм</p>
                    <p class="info__Date">Дата получения &#8593;&#8595;</p>
                    <p class="info__Price">Цена &#8593;&#8595;</p>
                </div>

            </div>
        </div>
    </main>
    <!-- MAIN -->
    <!-- FOOTER -->
    <footer class="footer">
        <div class="wrapper">
            <a href="https://vk.com/devillived8" target="_blank" rel="author" class="author">
                <p>Создатель</p>
                <img class="vkIcon" src="./img/vkIcon.png" width="60px" alt="vkIcon">
            </a>
            <a href="https://vk.com/id229840958" target="_blank" rel="author" class="author">
                <p>Создатель</p>
                <img class="vkIcon" src="./img/vkIcon.png" width="60px" alt="vkIcon">
            </a>
        </div>
    </footer>
    <!-- FOOTER -->
    <!-- SCRIPTS -->
    <script src="./js/main.js"></script>
    <!-- SCRIPTS -->
</body>
</html>
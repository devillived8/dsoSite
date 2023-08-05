<?php

// Начинаем или возобновляем сессию
session_start();

// Проверяем, есть ли в сессии информация о пользователе
if (!isset($_SESSION['userId'])) {
    // Если пользователя нет в сессии, перенаправляем на страницу входа
    header("Location: authorization.php");
    exit();
}


// $nickname = $_GET['nickname'];


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/character.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <title>dsoSite</title>
</head>

<body>
    <!-- HEADER -->
    <header class="header">
        <div class="wrapper">
            <a href="#">
                <img src="./img/logo.png" alt="logo" class="logo">
            </a>
        </div>
    </header>
    <!-- HEADER -->
    <!-- MAIN -->
    <div class="imageViewing">
        <div class="exit">
            <img src="./img/exit.svg" alt="">
        </div>
        <div class="imageCharacter">

            <div class="prev">
                <img src="./img/prev.svg" alt="">
            </div>
            <div class="next">
                <img src="./img/next.svg" alt="">
            </div>
        </div>
    </div>
    <main class="main">
        <div class="wrapper">
            <div class="characterInfo">
                <div class="fotoCarousel">
                    <?php
                    $img = $_GET['img'];
                    $folderPath = "./img/".$img;
                    $imageExtensions = ["jpg", "jpeg", "png", "gif"]; // Расширения изображений
                    
                    $images = [];

                    foreach ($imageExtensions as $extension) {
                        $images = array_merge($images, glob($folderPath . "/*." . $extension));
                    }

                    foreach ($images as $image) {
                        echo "<img src='{$image}' alt=''>";
                    }


                    ?>
                </div>
                <div class="descriptionAccount">
                    <?php 
                    $idCharacter = $_GET['idCharacter'];
                    $class = $_GET['class'];
                    $date = $_GET['date'];
                    $description = $_GET['description'];
                    $price = $_GET['price'];
                    
                    
                    echo "
                    
                    <p class='id'>Id: {$idCharacter}</p>
                    <p class='class'>Класс: {$class}</p>
                    <p class='date'>Дата получения: {$date}</p>
                    <p class='description'>Описание: {$description}</p>
                    <div class='price'>Цена: {$price}</div>
                    "



                    ?>
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
    <script src="./js/character.js"></script>
    <!-- SCRIPTS -->
</body>

</html>
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
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <title>dsoSite</title>
</head>

<body>
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
            <div class="adminPanel">
                <!-- ДОБАВЛЕНИЯ ПЕРСОНАЖА -->
                <div class="addCharacterWrapper">
                    <form action="" method="POST" class="addCharacter" enctype="multipart/form-data">
                        <h1 class="addCharacterTitle">Добавить персонажа в бд</h1>
                        <input type="text" name="idCharacter" id="idCharacter" placeholder="Id персонажа">
                        <select name="class" id="class">
                            <option value="dwarf">Паромеханист</option>
                            <option value="archer">Следопыт</option>
                            <option value="warrior">Воин дракона</option>
                            <option value="mage">Маг круга</option>
                        </select>
                        <input type="date" name="date" id="date">
                        <input type="text" name="price" id="price" placeholder="Цена">
                        <input type="text" name="nickname" id="nickname" placeholder="Ник">
                        <input type="text" name="wayToGet" id="wayToGet" placeholder="Способ получения">
                        <textarea name="description" id="description" placeholder="Описание персонажа" cols="30"
                            rows="10"></textarea>
                        <input type="file" name="imageFile" id="imageFile" multiple>
                        <input type="submit" value="Добавить">
                    </form>
                </div>
                <!-- ДОБАВЛЕНИЯ ПЕРСОНАЖА -->
                <!-- УДАЛЕНИЕ ПЕРСОНАЖА -->
                <div class="deleteCharacterWrapper">
                    <form action="" method="POST" class="addCharacter" enctype="multipart/form-data">
                        <select name="deleteCharacterById" id="deleteCharacterById">
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>
                            <option value="id">id</option>

                        </select>
                        <input type="submit" value="Удалить">
                    </form>
                </div>
                <!-- УДАЛЕНИЕ ПЕРСОНАЖА -->
            </div>
        </div>
    </main>
    <!-- MAIN -->
    <!-- SCRIPTS -->

    <!-- SCRIPTS -->
</body>

</html>
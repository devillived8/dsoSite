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
                    <form action="adminScript.php" method="POST" class="addCharacter" enctype="multipart/form-data">
                        <h1 class="addCharacterTitle">Добавить персонажа</h1>
                        <input type="text" name="idCharacter" id="idCharacter" placeholder="Id персонажа">
                        <select name="server" id="server">
                            <option value="Grimmag">Grimmag</option>
                            <option value="Heredur">Heredur</option>
                            <option value="Werian">Werian</option>
                            <option value="Harold">Harold</option>
                            <option value="Agathon">Agathon</option>
                            <option value="Tegan">Tegan</option>
                        </select>
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
                        <input type="file" name="imageFile[]" id="imageFile" multiple>
                        <input type="submit" value="Добавить">
                    </form>
                </div>
                <!-- ДОБАВЛЕНИЯ ПЕРСОНАЖА -->
                <!-- УДАЛЕНИЕ ПЕРСОНАЖА -->
                <div class="deleteCharacterWrapper">
                    <h1 class="deleteCharacterTitle">Удалить персонажа</h1>
                    <div class="deleteCharacterListAccounts">
                        <div class="deleteCharacterHeader">
                            <div class="deleteCharacterIdCharacter">Id</div>
                            <div class="deleteCharacterServer">Сервер</div>
                            <div class="deleteCharacterClass">Класс</div>
                            <div class="deleteCharacterEmpty"></div>
                        </div>
                        <?php
                        $host = 'localhost'; // Хост базы данных
                        $dbname = 'dsosite'; // Имя базы данных
                        $username = 'root'; // Имя пользователя базы данных
                        $password = 'root'; // Пароль пользователя базы данных
                        
                        // Подключение к базе данных с помощью MySQLi
                        $mysqli = new mysqli($host, $username, $password, $dbname);

                        // Проверка соединения
                        if ($mysqli->connect_error) {
                            die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
                        }


                        $sql = "SELECT * FROM accounts";

                        $result = $mysqli->query($sql);

                        // Проверка наличия данных
                        if ($result->num_rows > 0) {
                            // Обработка данных
                            while ($row = $result->fetch_assoc()) {

                                echo "
                                
                                
                                
                                <div class='deleteCharacterRow'>
                                <div class='deleteCharacterIdCharacter'>{$row['idCharacter']}</div>
                                <div class='deleteCharacterServer'>{$row['server']}</div>
                                <div class='deleteCharacterClass'>{$row['class']}</div>
                                <a href='adminScript.php?id={$row['idCharacter']}&settings=2' class='deleteCharacterButton'>Удалить</a>
                            </div>
                                
                                
                                
                                
                                ";
                    
                            }
                        }

                        $mysqli->close();





                        ?>








                    </div>
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
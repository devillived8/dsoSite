<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>dsoSite</title>
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="wrapper">
            <a href="index.html">
                <img src="./img/logo.png" alt="logo" class="logo">
            </a>
        </div>
    </header>
    <!-- HEADER -->
    <main class="main">
        <div class="wrapper">
            <div class="tableCharacters">
                <div class="info">
                    <p class="info__Class">Класс</p>
                    <p class="info__Nickname">Никнейм</p>
                    <p class="info__Date">Дата получения</p>
                    <p class="info__Price">Цена</p>
                </div>
                <?php
                $host = 'localhost'; // Хост базы данных
                $dbname = 'dsosite'; // Имя базы данных
                $username = 'root'; // Имя пользователя базы данных
                $password = 'root'; // Пароль пользователя базы данных
                
                // Подключение к базе данных
                $mysqli = new mysqli($host, $username, $password, $dbname);

                // Проверка соединения
                if ($mysqli->connect_error) {
                    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
                }

                // Выполнение запроса на выборку всех данных из таблицы
                $sql = "SELECT * FROM accounts";

                $result = $mysqli->query($sql);

                // Проверка наличия данных
                if ($result->num_rows > 0) {
                    // Обработка данных
                    while ($row = $result->fetch_assoc()) {
                        // Вы можете использовать $row для доступа к полям таблицы
                        if ($row['class'] == "dwarf") {
                            $class = "dwarf.webp";
                        } else if ($row['class'] == "archer") {
                            $class = "archer.webp";
                        } else if ($row['class'] == "warrior") {
                            $class = "warrior.webp";
                        } else if ($row['class'] == "mage") {
                            $class = "mage.webp";
                        }
                        ;

                        echo "
                        <a href='#'>
                        <div class='character'>
                            <div class='character__wrapperClass'>
                                <img src='./img/{$class}' alt='dwarf' class='class'>
                            </div>
                            <p class='character__nickname'>{$row['nickname']}</p>
                            <p class='character__date'>{$row['date']}</p>
                            <p class='character__price'>{$row['price']}</p>
                        </div>
                    </a>
                        
                        
                        
                        ";
                    }
                } else {
                    echo "Нет данных в таблице.";
                }

                // Закрытие соединения
                $mysqli->close();


                ?>
            </div>
        </div>
    </main>
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
    <script src="./js/main.js"></script>
</body>

</html>
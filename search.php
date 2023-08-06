<?php
//Это параметр для поиска по имени и вывода всех аккаунтов
$settings = $_GET['settings'];

if ($settings == 1) {
    selectAllAcounts();
} elseif ($settings == 2) {
    selectAccountByNickname();
}
;


//Функция для вывода всех аккаунтов
function selectAllAcounts()
{
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
            // Тут идёт проверка на то какую картинку класса ставить
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
                            <a target='_blank' href='character.php?idCharacter=". urlencode($row['idCharacter']). "&class=" . urlencode($row['class']) . "&price=" . urlencode($row['price']) . "&date=" . urlencode($row['date']) . "&img=" . urlencode($row['img']) . "&description=" . urlencode($row['description']) ."' class='linkOnCharacter' data-date='{$row['date']}' data-price='{$row['price']}'>
                            <div class='character'>
                                <div class='character__wrapperClass'>
                                    <img src='./img/{$class}' alt='dwarf' class='class'>
                                </div>
                                <p class='character__idCharacter'>{$row['idCharacter']}</p>
                                <p class='character__date'>{$row['date']}</p>
                                <p class='character__price'>{$row['price']}</p>
                            </div>
                        </a>
                            ";
        }
    } else {
        echo "
        <a href='#'>
        <div class='characterNotFounds'>
            <h1>Таких аккаунтов никогда не было<h1>
        </div>
    </a>
        ";
    }

    $mysqli->close();
}

//Функция для вывода аккаунтов по имени (логину)
function selectAccountByNickname()
{
    $host = 'localhost'; // Хост базы данных
    $dbname = 'dsosite'; // Имя базы данных
    $username = 'root'; // Имя пользователя базы данных
    $password = 'root'; // Пароль пользователя базы данных
    $searchValue = $_GET['additionalParameter'];

    // Подключение к базе данных с помощью MySQLi
    $mysqli = new mysqli($host, $username, $password, $dbname);

    // Проверка соединения
    if ($mysqli->connect_error) {
        die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
    }

    // Эскейпим входящее значение для безопасности
    $escapedSearchValue = $mysqli->real_escape_string($searchValue);

    // Хэшируем введенный никнейм (на стороне сервера)
    $hashedNickname = hash('sha256', $escapedSearchValue);

    // Подготовленный SQL-запрос с использованием хэш никнейма
    $sql = "SELECT * FROM accounts WHERE nickname = '$hashedNickname'";

    // Выполняем запрос 
    $result = $mysqli->query($sql);

    // Проверяем наличие данных
    if ($result->num_rows > 0) {
        // Обработка данных - выводим все строки, которые содержат заданную подстроку
        while ($row = $result->fetch_assoc()) {
            // Тут идёт проверка на то какую картинку класса ставить
            if ($row['class'] == "dwarf") {
                $class = "dwarf.webp";
            } else if ($row['class'] == "archer") {
                $class = "archer.webp";
            } else if ($row['class'] == "warrior") {
                $class = "warrior.webp";
            } else if ($row['class'] == "mage") {
                $class = "mage.webp";
            }

            echo "
            <a target='_blank' href='character.php?idCharacter=". urlencode($row['idCharacter'])."&description=" . urlencode($row['description']) . "&class=" . urlencode($row['class']) . "&price=" . urlencode($row['price']) . "&date=" . urlencode($row['date']) . "&img=" . urlencode($row['img']) . "' class='linkOnCharacter' data-date='{$row['date']}' data-price='{$row['price']}'>
                <div class='character'>
                    <div class='character__wrapperClass'>
                        <img src='./img/{$class}' alt='{$row['class']}' class='class'>
                    </div>
                    <p class='character__idCharacter'>{$row['idCharacter']}</p> 
                    <p class='character__date'>{$row['date']}</p>
                    <p class='character__price'>{$row['price']}</p>
                </div>
            </a>
        ";
        }
    } else {
        echo "
            <a href='#'>
                <div class='characterNotFounds'>
                    <h1>Таких аккаунтов никогда не было</h1>
                </div>
            </a>
        ";
    }

    // Закрываем соединение
    $mysqli->close();
}


?>
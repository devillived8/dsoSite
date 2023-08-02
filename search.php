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

                $mysqli->close();

?>

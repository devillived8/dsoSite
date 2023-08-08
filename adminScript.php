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

$settings = $_GET['settings'];
if ($settings == 2) {
    deleteCharacter();

} else {
    addCharacter();
}




function addCharacter()
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


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получаем данные из формы
        $idCharacter = $_POST['idCharacter'];
        $server = $_POST['server'];
        $class = $_POST['class'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $nickname = $_POST['nickname'];
        $hashedNickname = hash('sha256', $nickname);
        $wayToGet = $_POST['wayToGet'];
        $description = $_POST['description'];
        // ...

        // Создаем уникальное имя папки на основе времени и id персонажа
        $folderName = "img/" . time() . "_" . $idCharacter;

        // Создаем директорию
        if (!mkdir($folderName, 0777, true)) {
            die('Failed to create folder...');
        }

        // Обработка загруженных изображений
        if (isset($_FILES['imageFile']) && is_array($_FILES['imageFile']['name'])) {
            $totalFiles = count($_FILES['imageFile']['name']);

            for ($i = 0; $i < $totalFiles; $i++) {
                $fileName = $_FILES['imageFile']['name'][$i];
                $fileTmp = $_FILES['imageFile']['tmp_name'][$i];

                // Полный путь к файлу
                $filePath = $folderName . '/' . $fileName;

                // Перемещаем файл в созданную папку
                move_uploaded_file($fileTmp, $filePath);
            }
        }

        // Далее можно выполнить запись данных в базу данных
        // Подготовленный запрос для вставки данных
        $stmt = $mysqli->prepare("INSERT INTO accounts (idCharacter, server, class, date, price, nickname, wayToGet, description, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Привязываем параметры
        $stmt->bind_param("isssissss", $idCharacter, $server, $class, $date, $price, $hashedNickname, $wayToGet, $description, $folderName);

        // Выполняем запрос
        if ($stmt->execute()) {
            header("Location: admin.php");
        } else {
            echo "Ошибка при добавлении данных в базу данных: " . $stmt->error;
        }

        // Закрываем соединение
        $stmt->close();
        $mysqli->close();
        // ...
        // ...
    }
}




function deleteCharacter()
{

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $accountId = $_GET['id'];

        // Подключение к базе данных
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

        $stmt = $mysqli->prepare("DELETE FROM accounts WHERE idCharacter = ?");
        $stmt->bind_param("i", $accountId);



        if ($stmt->execute()) {
            $targetDir = 'img/'; // Путь к директории, где хранятся папки для удаления
            $pattern = "_" . $accountId; // Шаблон для поиска

            // Получаем список директорий по шаблону
            $dirs = glob($targetDir . '*' . $pattern . '*', GLOB_ONLYDIR);

            // Проходимся по каждой найденной директории и удаляем её содержимое
            foreach ($dirs as $dir) {
                if (is_dir($dir)) {
                    // Получаем список файлов и поддиректорий в текущей директории
                    $items = glob($dir . '/*');

                    // Удаляем каждый файл и поддиректорию
                    foreach ($items as $item) {
                        if (is_file($item)) {
                            unlink($item); // Удаление файла
                        } elseif (is_dir($item)) {
                            deleteDirectory($item); // Удаление директории и её содержимого (используя предложенную ранее функцию)
                        }
                    }

                    // Удаляем текущую директорию
                    if (rmdir($dir)) {
                        echo "Директория $dir успешно удалена вместе со всем содержимым<br>";
                    } else {
                        echo "Не удалось удалить директорию $dir<br>";
                    }
                }
            }
            // ...
        } 



        function deleteDirectory($dir)
        {
            if (!is_dir($dir)) {
                return false;
            }

            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object)) {
                        deleteDirectory($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }

            return rmdir($dir);
        }





        header("Location: admin.php");


        $stmt->close();
        $mysqli->close();
    }


}




?>
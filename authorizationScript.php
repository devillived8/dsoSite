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

$nickname = $_POST["nickname"];
$userPassword = $_POST["password"];
$userLogin = $mysqli->real_escape_string($nickname);

// SQL-запрос с подготовленными параметрами
$sql = "SELECT * FROM admins WHERE nickname=?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Привязываем параметры
    $stmt->bind_param("s", $userLogin);
    // Выполняем запрос
    $stmt->execute();
    // Получаем результат
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Проверка хеша пароля
        if (password_verify($userPassword, $row['password'])) {
            // Логин и пароль совпадают
            // Устанавливаем время жизни сессии в секундах (например, 1 час)
            $sessionLifetime = 3600;

            // Устанавливаем время жизни куки сессии в браузере (также в секундах)
            $cookieLifetime = $sessionLifetime;

            // Устанавливаем параметры сессии
            session_set_cookie_params($cookieLifetime, "/", "localhost", false, true);

            // Устанавливаем время жизни сессии
            ini_set("session.gc_maxlifetime", $sessionLifetime);
            session_start();
            $_SESSION['userId'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            // Пароль неверный
            header("Location: authorization.php");
        }
    } else {
        // Пользователь с таким логином не найден
        header("Location: authorization.php");
    }

    // Закрываем подготовленное выражение
    $stmt->close();
} else {
    echo "Error in prepared statement!";
}

$mysqli->close();

?>
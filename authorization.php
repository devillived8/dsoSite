<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/authorization.css">
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
    <main class="main">
        <div class="wrapper">
            <div class="formWrapper">
                <form action="authorizationScript.php" method="POST" class="authorizationForm">
                    <h1>Login</h1>
                    <?php
                    // Проверяем наличие параметра ошибки в URL
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error === "error") {
                            echo "<p class='errorAuthorization'>Что-то пошло не так!</p>";
                        } 
                    }
                    ?>
                    <input type="text" name="nickname" id="nickname" placeholder="Логин">
                    <input type="password" name="password" id="password" placeholder="Пароль">
                    <input type="submit" value="Авторизоваться" id="enter">
                </form>
            </div>
        </div>
    </main>
    <!-- MAIN -->

    <!-- SCRIPTS -->
    <script src="./js/authorization.js"></script>
    <!-- SCRIPTS -->
</body>

</html>
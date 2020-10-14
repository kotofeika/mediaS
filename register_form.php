<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\SessionManager;
SessionManager::create();
?>
<!DOCTYPE html>
<html lang = "ru">
    <head>
        <meta charset = "utf-8"/>
        <title>Страница Регистрации</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <h3>Регистрация</h3>
<div>
    <span><?= SessionManager::create()->errors()['login']; ?></span><br>
    <span><?= SessionManager::create()->errors()['pass']; ?></span>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <p>Логин</p>
            <input name="login" type="text" required><br>
            <p>Пароль</p>
            <input name="password" type="password" required><br>
            <input name="submit" type="submit" value="Зарегистрироваться"><br>
        </form>
        <form action="authorization.php" target="_blank">
            <button>Авторизироваться</button>
        </form>
</div>
    </body>

</html>
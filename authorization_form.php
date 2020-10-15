<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset = "utf-8"/>
    <title>Страница авторизации</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<h3>Авторизация</h3>
<a href="index.php">
    <button>Главная</button>
</a>
<form action="Auth/authorization.php" id="autorize" method="POST">
    <p>Логин</p>
    <input name="login" type="text" required><br>
    <?php if (!empty($_SESSION['errors']['login'])) {?>
        <span style="color: #ff0000"><?php var_dump($_SESSION['errors']['login']);?></span>
    <?php } ?>
    <p>Пароль</p>
    <input name="password" type="password" required><br>
    <input form="autorize" name="submit" type="submit" value="Войти"><br>
</form>
</body>
<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\SessionManager;
use Localhost\AdminCheck;
use Localhost\imagesContorller;
$userData = \Localhost\SessionManager::create()->user();

if (SessionManager::create()->isAuthorized() && $_GET['id'] === null){
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8"/>
    <title>Личный кабинет</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
<h3>Личный кабинет</h3>
<table>
    <td>
        <?php echo SessionManager::create()->user('user_login'); ?>
    </td>

    <td>
        <div class="container">
            <a href="logout.php"><img src="images/logout.jpg" height="50" alt="error"></a>
        </div>
    </td>
</table>

<table>
    <td>
        <a href="index.php">
            <button>Главная</button>
        </a>
    </td>

    <td>
        <a href="load_form.php">
            <button>Загрузить</button>
        </a>
    </td>
</table>

<?php imagesContorller::ShowMy();
} if (SessionManager::create()->isAuthorized() && $_GET['id'] != SessionManager::create()->user('user_id') && AdminCheck::Check() === null ){ ?>

<?php imagesContorller::ShowUser();
}

if (SessionManager::create()->isAuthorized() && ( $_GET['id'] != SessionManager::create()->user('user_id') || $_GET['id'] !=null ) && AdminCheck::Check() != null ){ ?>

    <?php imagesContorller::AdmShowUser();
}

if (SessionManager::create()->isAuthorized() === false) {
    echo "Пожалуйста авторизируйтесь"; ?>
<table>
    <td>
        <a href="index.php">
            <button>Главная</button>
        </a>
    </td>
<?php
    imagesContorller::ShowMyNotAuth();
}
?>
</body>
</html>
<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\SessionManager;
use \Localhost\imagesContorller;
SessionManager::create();

$file = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Details</title>

</head>
<body>

    <div align="right">
        <a href="index.php"><img height="30" src="images/close.png "></a>
    </div>

<form method="post" enctype="multipart/form-data">
    <table cellpadding="5" border="2" align="center" bordercolor="blue">
        <thead>
            <td>
                <?= SessionManager::create()->user('user_login');?>
            </td>
        </thead>

        <tbody>
        <tr>
            <td>
                <?php imagesContorller::ShowOne($file); ?>
            </td>
        </tr>
        </tbody>
        <br>
    </table>
</form>

</body>

</html>


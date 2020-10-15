<?php
require_once __DIR__ . "/vendor/autoload.php";

use Localhost\Service\DB;

$pdo = new DB();
$sql = 'SELECT * FROM `users` WHERE user_id = :id';
$userData = $pdo->executeAll($sql, ['id' => $_COOKIE["id"]])
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
<?php
foreach ($userData as $rowUserData) {
    ?>
    <h3><?= $rowUserData['user_login'] ?></h3>
<?php } ?>
<form action="ImageLoading/load.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image[]" multiple> <br>
    <input type="submit">
    <ul>
        <li>Sent file: <?php echo $_FILES['image']['name']; ?></li>
        <li>File size: <?php echo $_FILES['image']['size']; ?></li>
        <li>File type: <?php echo $_FILES['image']['type']; ?></li>
    </ul>
</form>

</body>

</html>
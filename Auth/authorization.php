<?php
require_once "../vendor/autoload.php";

use Localhost\SessionClass\SessionManager;
use Localhost\Service\SendTo;
use Localhost\Service\DB;

$pdo = new DB();

$sql = 'SELECT `user_id`, `user_login`, `user_password` FROM `users` WHERE user_login = :id';
$options = [':id'=>$_POST['login']];
$user = $pdo->execute($sql, $options);
if ($_POST['password'] != $user['user_password']){
    $_SESSION['errors']['login'] = "Неверный пароль";
    SendTo::SendTo('authorization_form.php');
}else {
    SessionManager::create()->set('authorized', true);
    SessionManager::create()->set('user', $user);
    SendTo::SendTo('../index.php');
}
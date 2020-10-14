<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\SessionManager;
use Localhost\SendTo;

$pdo = new \PDO ('mysql:dbname=insta;host=localhost:3306', 'root','root');

$selectUsersLogin = 'SELECT `user_id`, `user_login`, `user_password` FROM `users` WHERE user_login = :id';
$selectUsersLoginBD = $pdo ->prepare($selectUsersLogin);
$selectUsersLoginBD->execute([':id'=>$_POST['login']]);
$user = $selectUsersLoginBD->fetch(\PDO::FETCH_ASSOC);

if ($_POST['password'] != $user['user_password']){
    $_SESSION['errors']['login'] = "Неверный пароль";
    SendTo::SendTo('authorization_form.php');
}else {
    SessionManager::create()->set('authorized', true);
    SessionManager::create()->set('user', $user);
    SendTo::SendTo('index.php');
}
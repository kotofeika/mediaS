<?php

namespace Localhost\Auth;

use Localhost\SessionClass\SessionManager;
use Localhost\Service\DB;

class Registration
{
    protected static string $query = 'SELECT `user_login` FROM `users`';
    protected static string $sql = 'INSERT INTO `users`(`user_login`,`user_password`) VALUES (?,?)';
    public static function Check($login, $pass)
    {
        $pdo = new DB();
        $selectUsersLoginBD = $pdo->select(self::$query);

        if (strlen($pass) > 32){
            SessionManager::create()->setErrors('pass','Пароль не должен превышать 32 символа.');
        }
        else if (strlen($login) > 20){
            SessionManager::create()->setErrors('login','Логин не должен превышать 20 символов.');
        }
        foreach($selectUsersLoginBD as $RowUserLogin)
        {
            if ($login === $RowUserLogin['user_login']){
                SessionManager::create()->setErrors('login','Данный логин уже занят.');
            }
        }
        if ( !empty($_SESSION['errors']) && $login !=null ) {
            return false;
        }
        $pdo->insert(self::$sql,[$login, $pass]);
        return true;
    }
}
<?php


namespace Localhost;


class AdminCheck
{
    protected static string $query = 'SELECT `Admin` FROM `users` WHERE `user_id` = :id';
    public static function Check()
    {
        $id = SessionManager::create()->user('user_id');
        $pdo = new DB();
        $options = [':id' => $id];
        $Admin = $pdo->selectOne(self::$query,$options);
        $Admin = $Admin['Admin'];
        return $Admin;
    }
}
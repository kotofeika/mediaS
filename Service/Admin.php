<?php
namespace Localhost\Service;

use Localhost\SessionClass\SessionManager;

class Admin
{
    protected static string $query = 'SELECT `Admin` FROM `users` WHERE `user_id` = :id';

    public static function Check()
    {
        $id = SessionManager::create()->user('user_id');
        $pdo = new DB();
        $options = [':id' => $id];
        $Admin = $pdo->selectOne(self::$query, $options);
        $Admin = $Admin['Admin'];
        return $Admin;
    }

    public static function DeleteProfile($options)
    {
        $pdo = new DB();
        $sql = 'DELETE FROM `users` WHERE `user_id` = (?)';
        $pdo->update($sql, [$options]);
        $sql = 'DELETE FROM `pictures` WHERE `user_id` = (?)';
        $pdo->update($sql, [$options]);
    }
}
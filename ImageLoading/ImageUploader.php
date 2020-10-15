<?php

namespace Localhost\ImageLoading;

use Localhost\Service\DB;
use Localhost\SessionClass\SessionManager;

class ImageUploader
{
    protected static string $dir = "../uploaded";

    public static function upload(string $image_name, $tmp_name): bool
    {
        $name = date_create_from_format('U.u', microtime(true))->format('Y-m-d_H-i-s_u');
        $full_path = self::getFullPath($image_name,$name);
        $status = move_uploaded_file($tmp_name, $full_path);
        if ($status === false) {
            return false;
        }
        $db = new DB();
        $db->executeAll('INSERT INTO `pictures`(`name`,`user_id`) VALUES (?,?)', [self::getName($image_name,$name), SessionManager::create()->user('user_id')]);
        return true;
    }

    public static function getFullPath($image_name, $name): string
    {
        $filename = explode('.', $image_name);
        $extension = end($filename);
        return self::$dir . DIRECTORY_SEPARATOR. $name . "." . $extension;
    }

    public static function getName($image_name, $name): string
    {
        $filename = explode('.', $image_name);
        $extension = end($filename);
        return $name . "." . $extension;
    }
}
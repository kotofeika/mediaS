<?php

namespace Localhost;

class ImageUploader
{
    protected static string $dir = "uploaded";

    public static function upload(string $name, $tmp_name): bool
    {
        $full_path = self::getFullPath($name);
        $status = move_uploaded_file($tmp_name, $full_path);
        if ($status === false) {
            return false;
        }
        $db = new DB();
        $db->executeAll('INSERT INTO `pictures`(`name`,`user_id`) VALUES (?,?)', [$full_path, SessionManager::create()->user('user_id')]);
        return true;
    }

    public static function getFullPath($image_name): string
    {
        $filename = explode('.', $image_name);
        $extension = end($filename);
        $name = date_create_from_format('U.u', microtime(true))->format('Y-m-d_H-i-s_u');
        return self::$dir . DIRECTORY_SEPARATOR . $name . "." . $extension;
    }
}
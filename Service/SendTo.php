<?php
namespace Localhost\Service;


class SendTo
{
    public static function SendTo(string $file)
    {
        header('Location: ' . $file);
        exit;
    }
}
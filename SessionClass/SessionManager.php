<?php
namespace Localhost\SessionClass;

class SessionManager
{
    protected static ?SessionManager $instance = null;

    private function __construct()
    {
        session_set_save_handler(new SessionHandler(), true);
        session_save_path(__DIR__ . DIRECTORY_SEPARATOR);
        session_start();
        $_SESSION['authorized'] ??= false;
    }

    public static function create()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function all()
    {
        return $_SESSION;
    }

    public function user(?string $field = null)
    {
        if (is_null($field)) {
            return $_SESSION['user'] ?? null;
        }
        return $_SESSION['user'][$field] ?? null;
    }

    public function isAuthorized()
    {
        return $_SESSION['authorized'];
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function errors()
    {
        return $_SESSION['errors'] ?? [];
    }

    public function setErrors($key, $value)
    {
        $_SESSION['errors'][$key] = $value;
    }
}
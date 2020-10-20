<?php
namespace Localhost\SessionClass;

class SessionHandler implements \SessionHandlerInterface
{
    private string $savePath;

    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        // TODO: Implement destroy() method.
        return true;
    }

    public function gc($maxlifetime)
    {
        // TODO: Implement gc() method.
        return true;
    }

    public function open($save_path, $name)
    {
        $this->savePath = $save_path;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, '0777', true);
        }

        return true;
    }

    public function read($session_id)
    {
        $file = $this->savePath . DIRECTORY_SEPARATOR . $session_id;
        if (!is_file($file)) {
            touch($file);
        }
        return file_get_contents($this->savePath . DIRECTORY_SEPARATOR . $session_id);

    }

    public function write($session_id, $session_data)
    {
        return (bool)file_put_contents($this->savePath . DIRECTORY_SEPARATOR . $session_id, $session_data);
    }
}
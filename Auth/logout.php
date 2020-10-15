<?php
require_once "../vendor/autoload.php";

use Localhost\SessionClass\SessionManager;
use Localhost\Service\SendTo;

    SessionManager::create()->set('authorized', false);
    SendTo::SendTo('../index.php');
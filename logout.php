<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\SessionManager;
use Localhost\SendTo;
    SessionManager::create()->set('authorized', false);
    SendTo::SendTo('index.php');
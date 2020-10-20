<?php
require_once __DIR__ . "/vendor/autoload.php";

use Localhost\Service\SendTo;
use Localhost\Service\Admin;

Admin::DeleteProfile($_GET['id']);
SendTo::SendTo('../index.php');
<?php
require_once "../vendor/autoload.php";

use Localhost\ImageLoading\imagesContorller;
use Localhost\Service\SendTo;

imagesContorller::delete($_GET['id']);
SendTo::SendTo('../index.php');
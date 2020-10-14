<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\imagesContorller;
use Localhost\SendTo;

imagesContorller::delete($_GET['id']);
SendTo::SendTo('index.php');
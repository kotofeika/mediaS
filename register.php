<?php
require_once __DIR__ . "/vendor/autoload.php";
use Localhost\SessionManager;
use Localhost\Registration;
use Localhost\SendTo;
SessionManager::create();

$registration = Registration::Check($_POST['login'], $_POST['password']);
if ($registration){
    SendTo::SendTo('authorization_form.php');
}else{
    SendTo::SendTo('register_form.php');
}
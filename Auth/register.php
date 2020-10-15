<?php
require_once "../vendor/autoload.php";

use Localhost\SessionClass\SessionManager;
use Localhost\Auth\Registration;
use Localhost\Service\SendTo;

SessionManager::create();

$registration = Registration::Check($_POST['login'], $_POST['password']);
if ($registration){
    SendTo::SendTo('../authorization_form.php');
}else{
    SendTo::SendTo('../register_form.php');
}
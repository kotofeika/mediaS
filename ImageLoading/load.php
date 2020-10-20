<?php
require_once "../vendor/autoload.php";

use Localhost\ImageLoading\ImageUploader;
use Localhost\Service\SendTo;

$total_files = count($_FILES['image']['name']);
for ($key = 0; $key < $total_files; $key++) {
    $success = ImageUploader::upload($_FILES['image']['name'][$key], $_FILES['image']['tmp_name'][$key]);
}
//    if (($success) === false) {
//        SessionManager::create()->set('errors', ['upload' => "Ошибка загрузки"]);
//    }
//    var_dump($_FILES['image']['name'][1]);
SendTo::SendTo('../lk_form.php');
<?php
session_start();
// Front Controller

// 1 Общие настройки, включение отображения ошибок
//ini_set('display_errors', 1); // Отображение ошибок
//error_reporting(E_ALL); // Отображение всех ошибок
ini_set('max_execution_time', 900);


// 2 Подключение файлов системы
define('ROOT', dirname(__FILE__));
include_once(ROOT.'/components/function.php');
include_once(ROOT.'/components/Autoload.php');



// 3 Вызов роутера
$router = new Router;

$router->run();

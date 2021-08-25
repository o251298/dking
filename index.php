<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


define('ROOT', dirname(__FILE__));
include_once(ROOT.'/components/Router.php');
include_once(ROOT.'/components/DB.php');


$router = new Router();
$router->run();
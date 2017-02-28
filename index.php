<?php

// FRONT CONTROLLER

// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
define("APP_ID",'5874138');
define("APP_SECRET",'o9jArDWaUn84oHb16zm0');
define("REDIRECT_URI",'http://lightit/');
define("URL_ACCESS_TOKEN",'https://oauth.vk.com/access_token');
define("URL_AUTH ",'http://oauth.vk.com/authorize');
define("URL_GET_USER",'https://api.vk.com/method/users.get');

require_once(ROOT.'/components/Autoload.php');


// Вызов Router
$router = new Router();
$router->run();


<?php

// FRONT CONTROLLER

// 1. Общие настройки для всего сайта
// отображение ошибок на время разработки, потом все выключить
ini_set('display_errors',1);
error_reporting(E_ALL);

// создаёт сессию (или продолжает текущую на основе session id, переданного через GET-переменную или куку).
session_start();

// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__)); // путь к базовой дирректории
/*
echo __FILE__ , '<br>';         // D:\MyDoc\Dropbox\htdocs\php\mvc.local\index.php
echo dirname(__FILE__), '<br>'; // D:\MyDoc\Dropbox\htdocs\php\mvc.local
echo __DIR__ ;                  // D:\MyDoc\Dropbox\htdocs\php\mvc.local*/


require_once(ROOT.'/components/Autoload.php'); 

// 3. Установка соединения с БД ??

// 4. Вызов Router
$router = new Router();
$router->run();
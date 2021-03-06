<?php
 // Включаем режим строгой типизации
 declare(strict_types=1);
session_start();
 // Подключаем файл реализующий автозагрузку
use system\App;
require_once __DIR__ . '/system/autoload.php';
 // Запускаем приложение
try
{
    App::run();
}
catch (ErrorException $e)
{
}
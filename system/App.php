<?php

namespace system;

/**
 * Class App
 * @package system
 */
class App
{
    /**
     * @throws \ErrorException
     */
    public static function run()
    {
        // Получаем URL запроса
        $path = $_SERVER['REQUEST_URI'];
        // Разбиваем URL на части
        $pathParts = explode('/', $path);
        // Получаем имя контроллера
        $controller = $pathParts[1];
        $controllerName = $controller;
        // Получаем имя действия
        $action = $pathParts[2];
        $action = explode('?', $action, 2);
        $action = ltrim($action[0]);
        // Формируем пространство имен для контроллера
        $controller = 'controllers\\' . ucfirst($controller) . 'Controller';
        // Формируем наименование действия
        $action = 'action' . ucfirst($action);

        // Если класса не существует, выбрасывем исключение
        if (!class_exists($controller))
        {
            throw new \ErrorException('Controller does not exist');
        }

        // Создаем экземпляр класса контроллера
        $objController = new $controller($controllerName);

        // Если действия у контроллера не существует, выбрасываем исключение
        if (!method_exists($objController, $action))
        {
            throw new \ErrorException('action does not exist');
        }


        $action = $objController->beforeAction($action);
        // Вызываем действие контроллера
        $result =  $objController->$action();
    }

    /**
     * @return bool|int
     */
    public static function getUserId()
    {
        if (isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser']))
            if (isset($_SESSION['loggedUser']['id']) && !empty($_SESSION['loggedUser']['id']))
                return intval($_SESSION['loggedUser']['id']);

        return false;
    }

    /**
     * @return array|mixed
     */
    public static function getUser()
    {
        if (isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser']))
            if (isset($_SESSION['loggedUser']['id']) && !empty($_SESSION['loggedUser']['id']))
                return $_SESSION['loggedUser'];

        return [];
    }

    /**
     * @return string
     */
    public static function getUserLogin()
    {
        if (isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser']))
            if (isset($_SESSION['loggedUser']['login']) && !empty($_SESSION['loggedUser']['login']))
                return $_SESSION['loggedUser']['login'];

        return '';
    }

}
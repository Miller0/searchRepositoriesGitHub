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

       //Перенаправляем на модуль
        if (isset($pathParts[1]) && $pathParts[1] == 'api')
        {
            $part = 2;
            $namespace = 'api';
        }
        else
        {
            $part = 1;
            $namespace = 'controllers';
        }

        // Получаем имя контроллера
        $controller = $pathParts[$part];
        $controllerName = $controller;

        // Получаем имя действия
        $action = $pathParts[$part+1] ?? '';
        $action = explode('?', $action, 2);
        $action = ltrim($action[0]);

        // Формируем пространство имен для контроллера
        $controller = $namespace.'\\' . ucfirst($controller) . 'Controller';

        // Формируем наименование действия
        $action = 'action' . ucfirst($action);

        // Если класса не существует, выбрасывем исключение
        if (!class_exists($controller))
        {
            header('Location: /site');
        }

        // Создаем экземпляр класса контроллера
        $objController = new $controller($controllerName);

        // Если действия у контроллера не существует, выбрасываем исключение
        if (!method_exists($objController, $action))
        {
            if($namespace == 'api')
                $action = 'action';
            else
                header('Location: /site');
        }

        $action = $objController->beforeAction($action);

        // Вызываем действие контроллера
        $result = $objController->$action();

        // TODO: To remake
        if (!empty($result))
            echo $result;
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

    /**
     * @return bool|int
     */
    public static function checkUserToken($token = '')
    {
        $db = new DB();
        $data = $db->getRow("SELECT * FROM `users` WHERE `token` like ?", [$token]);
        return $data;
    }

}
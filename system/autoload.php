<?php

/**
 * @param $className
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\'))
    {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) .
            DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if (file_exists($fileName))
    include $fileName;
}
//spl_autoload_register() позволяет задать несколько реализаций метода автозагрузки.
// Она создает очередь из функций автозагрузки в порядке их определения в скрипте,
// тогда как встроенная функция __autoload() может иметь только одну реализацию.
spl_autoload_register('autoload');
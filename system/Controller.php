<?php


namespace system;


class Controller
{

    public $name;

    /**
     * Controller constructor.
     * @param string $name
     */
    function __construct($name = 'site')
    {
        $this->name = $name;
    }


    /**
     * @param string $path
     * @param array $data
     * @throws \ErrorException
     */
    public function render(string $path, array $data = [])
    {
        // Получаем путь, где лежат все представления
        $fullPath = __DIR__ . '/../views/'. $this->name . '/' . $path . '.php';

        // Если представление не было найдено, выбрасываем исключение
        if (!file_exists($fullPath))
        {
            throw new \ErrorException('view cannot be found');
        }

        // Если данные были переданы, то из элементов массива
        // создаются переменные, которые будут доступны в представлении
        if (!empty($data))
        {
            foreach ($data as $key => $value)
            {
                $$key = $value;
            }
        }

        // Отображаем представление
        include($fullPath);
    }


}
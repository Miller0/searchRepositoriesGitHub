<?php


namespace system;


class Controller
{

    public $name;
    public $rules;

    /**
     * Controller constructor.
     * @param string $name
     */
    function __construct($name = 'site')
    {
        $this->name = $name;
    }

    /**
     * @param array $methods
     */
    function callMethodsAfterOne($methods = array())
    {
        foreach ($methods as $method => $arguments)
        {
            $arguments = $arguments ? $arguments : array(); //Check
            call_user_func_array(array($this, $method), $arguments);
        }
    }

    /**
     * @param string $path
     * @param array $data
     * @throws \ErrorException
     */
    public function render(string $path, array $data = [])
    {
        // Получаем путь, где лежат все представления
        $fullPath = __DIR__ . '/../views/' . $this->name . '/' . $path . '.php';

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

    /**
     * @param $action
     * @return string
     */
    public function beforeAction($action)
    {
        if (!empty($this->rules))
        {
            if (isset($this->rules['status']) && !empty($this->rules['status']))
                if ($this->rules['status'] == 'user')
                {
                    if (empty(App::getUserId()))
                        $action = 'action';
                }
                elseif($this->rules['status'] == 'guest')
                {
                    $test =1 ;
                }
        }
        else
            $action = 'action';

        return $action;
    }

    private function afterAction()
    {
    }

}
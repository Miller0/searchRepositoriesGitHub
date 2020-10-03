<?php


namespace models;

use system\Model;

class UserModel extends Model
{
    public $login;
    public $email;
    public $surName;
    public $lastName;
    public $password;
    public $passwordRepeat;


    public function validate()
    {
        $errors = array();

        if (trim($this->login) == '')
            $errors[] = "Введите логин!";

        if (trim($this->email) == '')
            $errors[] = "Введите Email";


        if (trim($this->surName) == '')
            $errors[] = "Введите Имя";

        if (trim($this->lastName) == '')
            $errors[] = "Введите фамилию";

        if ($this->password == '')
            $errors[] = "Введите пароль";

        if ($this->passwordRepeat != $this->password)
            $errors[] = "Повторный пароль введен не верно!";

        // Если логин будет меньше 5 символов и больше 90, то выйдет ошибка
        if (mb_strlen($this->login) < 5 || mb_strlen($this->login) > 20)
            $errors[] = "Недопустимая длина логина";

        if (mb_strlen($this->surName) < 3 || mb_strlen($this->surName) > 50)
            $errors[] = "Недопустимая длина имени";

        if (mb_strlen($this->lastName) < 5 || mb_strlen($this->lastName) > 50)
            $errors[] = "Недопустимая длина фамилии";

        if (mb_strlen($this->password) < 2 || mb_strlen($this->password) > 8)
            $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";

        // проверка на правильность написания Email
        if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $this->email))
            $errors[] = 'Неверно введен е-mail';

        // Проверка на уникальность логина
        if ($this->searchForLogin())
            $errors[] = "Пользователь с таким логином существует!";

        // Проверка на уникальность email
        if ($this->searchForEmail())
            $errors[] = "Пользователь с таким Email существует!";

        $this->errors = $errors;

        if (empty($this->errors))
            return true;

        return false;
    }


    public function searchForLogin()
    {
        $data = $this->db::getRow("SELECT * FROM `users` WHERE `login` like ?", [$this->login]);
        return $data;
    }

    public function searchForEmail()
    {
        $data = $this->db::getRow("SELECT * FROM `users` WHERE `email` like ?", [$this->email]);
        return $data;
    }

    public function create()
    {
        $query = "INSERT INTO `users` (
                  `login`,
                  `email`,
                  `surName`,
                  `lastName`,
                  `password`
                  )
                VALUES (
                  :login,
                  :email,
                  :surName,
                  :lastName,
                  :password
                )";

        $args = [
            'login' => $this->login,
            'email' => $this->email,
            'surName' => $this->surName,
            'lastName' => $this->login,
            'password' => self::passwordHash($this->password)
        ];

        $this->db::sql($query, $args);
    }

    public static function passwordHash($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);

    }


    public function signin()
    {

        $user = $this->searchForLogin();
        if (!empty($user))
        {
            if (password_verify($this->password, $user['password']))
            {
                $_SESSION['loggedUser'] = $user;
                return true;
            }
            else
                $errors[] = 'Пароль неверно введен!';
        }
        else
            $errors[] = 'Пользователь с таким логином не найден!';

        return false;
    }

}
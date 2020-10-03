<?php

namespace Controllers;

use DB;
use models\UserModel;
use system\Controller;

class SiteController extends Controller
{
    public $rules = ['status' => 'guest'];


    public function action()
    {
            $this->actionMain();

    }


    public function actionSignup()
    {
        try
        {
            $data = $_POST;
            $model = new UserModel();

            if (isset($data['doSignup']))
            {
                $model->login = $data['login'];
                $model->email = $data['email'];
                $model->surName = $data['surName'];
                $model->lastName = $data['lastName'];
                $model->password = $data['password'];
                $model->passwordRepeat = $data['passwordRepeat'];

                if ($model->validate())
                {
                    $model->create();
                }
            }


            $this->render('signup', ['errors' => $model->errors]);
        }
        catch (\ErrorException $e)
        {
        }

    }


    public function actionLogin()
    {
        try
        {
            $data = $_POST;
            $model = new UserModel();

            if (isset($data['do_login']))
            {
                $model->login = $data['login'];
                $model->password = $data['password'];
                unset($_SESSION['loggedUser']);

                if ($model->signin())
                    header('Location: /site/main');
            }
            $this->render('login', ['errors' => $model->errors]);
        }
        catch (\ErrorException $e)
        {
        }
    }

    public function actionMain()
    {
        try
        {

            $db = New DB();
            $id = 1;
            $data = $db::getRow("SELECT * FROM `users` WHERE `id` = ?", [$id]);


            $this->render('index', ['test' => 2]);
        }
        catch (\ErrorException $e)
        {
        }
    }

    public function actionLogout()
    {
        try
        {
            unset($_SESSION['loggedUser']);
            header('Location: /site/main');
        }
        catch (\ErrorException $e)
        {

        }
    }

}
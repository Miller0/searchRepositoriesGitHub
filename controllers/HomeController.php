<?php

namespace Controllers;

use system\App;
use system\Controller;
use system\view;


class HomeController extends Controller
{

    public $rules = ['status' => 'user'];

    public function action()
    {
        if (App::getUserId())
            $this->actionMain();
        else
            header('Location: /site/login');

    }

    public function actionGetRepositories()
    {
        try
        {
            $this->render('repositories');
        }
        catch (\ErrorException $e)
        {
        }
    }

}
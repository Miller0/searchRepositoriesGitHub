<?php

namespace Controllers;

use system\Controller;
use system\view;


class HomeController extends Controller
{

    public function actionMain()
    {
        try
        {
            $this->render('index');
        }
        catch (\ErrorException $e)
        {
        }
    }
}
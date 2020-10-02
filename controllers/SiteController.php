<?php

namespace Controllers;

use system\Controller;


class SiteController extends Controller
{

    public function actionMain()
    {
        try
        {
            $this->render('index',['test'=>2]);
        }
        catch (\ErrorException $e)
        {
        }
    }
}
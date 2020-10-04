<?php

namespace Controllers;

use models\RepositoriesModel;
use models\RepositoriesUsersModel;
use system\App;
use system\Controller;
use system\DB;


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
            $this->render('repositories',['q' => $_GET['q'] ?? '']);
        }
        catch (\ErrorException $e)
        {
        }
    }

    public function actionMySaves()
    {
        try
        {
            $this->render('saveRepositories');
        }
        catch (\ErrorException $e)
        {
        }
    }

    /**
     * @return string|null
     */
    public function actionSaveRepositories()
    {
        try
        {
            $model = new RepositoriesModel();
            $data = $_GET['data'];

            $model->fullName = $data['fullName'];
            $model->description = $data['description'];
            $model->language = $data['language'];
            $model->stargazersCount = $data['stargazersCount'];
            $model->created_at = $data['created_at'];
            $model->updated_at = $data['updated_at'];
            $model->htmlUrl = $data['htmlUrl'];

            $data = DB::getRow("SELECT `id` FROM `repositories` WHERE `fullName` like ?", [$model->fullName]);

            if(empty($data['id']))
                if ($model->validate())
                   $data = $model->create();

                    $modelUserRepositories = new RepositoriesUsersModel();
                    $modelUserRepositories->idRepositories = $data['id'];

                    if ($modelUserRepositories->validate())
                        if ($modelUserRepositories->create())
                            return 'ok';
        }
        catch (\ErrorException $e)
        {
        }
        return null;
    }
}
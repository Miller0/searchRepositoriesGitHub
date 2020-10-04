<?php


namespace Api;

use system\App;
use system\ControllerApi;

/**
 * Class UserController
 * @package Api
 */
class UserController extends ControllerApi
{

    public $apiName = 'user';

    public function action()
    {
        return $this->run();
    }

    /**
     * @return false|string
     */
    public function actionIndex()
    {
        return $this->response($this->user, 200);
    }

    /**
     * @return false|string
     */
    public function actionView()
    {
        try
        {
            $result = '';
            $type = array_shift($this->requestUri);
            if ($type == 'save')
            {
                $result = $this->db->getRows("SELECT r.id,fullName,description,languages,stargazersCount,htmlUrl,created_at,updated_at 
                              FROM repositories as r
                              LEFT JOIN repositoriesUsers as ru
                              ON r.id = ru.idRepositories
                              WHERE ru.idUser = ?", [$this->user['id']]);
            }

            $data['totalCount'] = count($result);
            $data['items'] = $result;

            return $this->response($data, 200);
        }
        catch (\ErrorException $e)
        {
        }
        return $this->response('', 404);
    }


    public function actionUpdate()
    {
        // TODO: Implement actionUpdate() method.
    }

    protected function actionCreate()
    {
        // TODO: Implement actionCreate() method.
    }

    /**
     * @return false|string
     */
    public function actionDelete()
    {
        try
        {
            $parse_url = parse_url($this->requestUri[1]);
            $id = $parse_url['path'] ?? null;
            $type = array_shift($this->requestUri);

            if ($type == 'save' && !empty($id))
            {
                $sql = "DELETE FROM `repositoriesUsers` WHERE `idUser` = :idUser and `idRepositories` = :idRepositories ";

                $this->db::sql($sql, ['idRepositories' => $id, 'idUser' => App::getUserId()]);

                return $this->response('ok', 200);
            }
        }
        catch (\ErrorException $e)
        {
        }
        return $this->response('', 404);
    }
}
<?php


namespace models;


use system\App;
use system\Model;

class RepositoriesUsersModel extends Model
{

    public $idRepositories;

    /**
     * @return bool
     */
    public function validate()
    {
        if (App::getUserId())
        {
            $data = $this->db::getRow("SELECT `id` FROM `repositoriesUsers` WHERE `idRepositories` like ?", [$this->idRepositories]);
            if(empty($data))
                return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function create()
    {
        try
        {
            $query = "INSERT INTO `repositoriesUsers` (
                  `idUser`,
                  `idRepositories`
                  )
                VALUES (
                  :idUser,
                  :idRepositories
                  )";

            $args = [
                'idUser' => App::getUserId(),
                'idRepositories' => $this->idRepositories,
            ];

            $this->db::sql($query, $args);
            return true;
        }
        catch (\ErrorException $e)
        {
        }
        return false;
    }


}
<?php


namespace models;


use system\Model;

class RepositoriesModel extends Model
{

    public $fullName;
    public $description;
    public $language;
    public $stargazersCount;
    public $created_at;
    public $updated_at;
    public $htmlUrl;

    /**
     * @return bool
     */
    public function validate()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function create()
    {
        try
        {
            $query = "INSERT INTO `repositories` (
                  `fullName`,
                  `description`,
                  `languages`,
                  `stargazersCount`,
                  `created_at`,
                  `updated_at`,
                  `htmlUrl`
                  )
                VALUES (
                  :fullName,
                  :description,
                  :languages,
                  :stargazersCount,
                  :created_at,
                  :updated_at,
                  :htmlUrl
                  )";

            $args = [
                'fullName' => $this->fullName,
                'description' => $this->description,
                'languages' => $this->language,
                'stargazersCount' => $this->stargazersCount,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'htmlUrl' => $this->htmlUrl
            ];

            $this->db::sql($query, $args);

            $data = $this->db::getRow("SELECT `id` FROM `repositories` WHERE `fullName` like ?", [$this->fullName]);
            return $data;
        }
        catch (\ErrorException $e)
        {
        }

        return false;
    }

}
<?php


namespace Controllers;


use system\DB;

class MigrationController
{

    public function action()
    {
        $db = new DB();

       $result[] =  $db::sql('create table users (
                        id int (10) AUTO_INCREMENT,
                        login varchar(20) NOT NULL,
                        email varchar(50) NOT NULL,
                        surName varchar(50),
                        lastName varchar(50),
                        password varchar(15) NOT NULL,
                        PRIMARY KEY (id)
                        )');

       return $result;

    }

}